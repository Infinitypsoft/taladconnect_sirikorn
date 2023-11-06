<?php

namespace App\Http\Controllers;

use App\Models\meter_electric;
use App\Models\meter_electric_history;
use App\Models\meter_electric_bill_site;
use App\Models\block;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class MeterElectricController extends Controller
{
    public function getList()
    {
        try {
            DB::beginTransaction();
            $page = request()->page ? request()->page : 1;
            $size = request()->size ? request()->size : 100;
            $search = request()->search ? request()->search : "";
            $type = request()->site_id;
            $offset = $this->calSkip($page, $size);

            $data = meter_electric::select(
                'meter_electrics.id',
                'meter_electrics.start_meter',
                'blocks.block_name',
                'blocks.site_id',
                'meter_electrics.block_id',
                'meter_electrics.updated_at as updated_date',
                'admins.username',
            )
                ->join('blocks', 'blocks.id', 'meter_electrics.block_id')
                ->leftJoin('admins', 'admins.id', 'meter_electrics.user_id')
                ->where('meter_electrics.is_delete', 0)
                ->where('blocks.site_id', $type)
                ->whereRaw('(blocks.block_name LIKE "%' . $search . '%" OR meter_electrics.start_meter LIKE "%' . $search . '%" )')
                ->offset($offset)
                ->limit($size)
                ->get();

            $count = meter_electric::select(
                'meter_electrics.id',
                'meter_electrics.start_meter',
                'blocks.block_name',
                'meter_electrics.block_id',
                'meter_electrics.updated_at as updated_date',
                'admins.username',
            )
                ->join('blocks', 'blocks.id', 'meter_electrics.block_id')
                ->leftJoin('admins', 'admins.id', 'meter_electrics.user_id')
                ->where('meter_electrics.is_delete', 0)
                ->where('blocks.site_id', $type)
                ->whereRaw('(blocks.block_name LIKE "%' . $search . '%" OR meter_electrics.start_meter LIKE "%' . $search . '%" )')
                ->get()
                ->count();

            DB::commit();
            return response()->json([
                'success' => true,
                'data' => $data,
                'current_page' => $page,
                'pages' => $this->calPage($count, $size),
            ], 200);
        } catch (\Throwable $th) {
            // throw $th;
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 200);
        }
    }

    public function getById($id)
    {
        try {
            DB::beginTransaction();
            $data = meter_electric::where('id', $id)->first();

            DB::commit();
            return response()->json([
                'success' => true,
                'data' => $data,
            ], 200);
        } catch (\Throwable $th) {
            // throw $th;
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 200);
        }
    }

    public function create(Request $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->all();

           $cost_electricity = block::select(
                'stalls.cost_electricity_unit_rate',
                'stalls.id',
            )
            ->join('stalls', 'stalls.id', 'blocks.stall_size_id')
            ->where('blocks.id', $request->block_id)
            ->first();
            $data['cost_electricity_unit_rate'] = $cost_electricity->cost_electricity_unit_rate;
            $data = meter_electric::create($data);

            DB::commit();
            return response()->json([
                'success' => true,
                'data' => $data,
                'message' => "create data success!"
            ], 200);
        } catch (\Throwable $th) {
            // throw $th;
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 200);
        }
    }

    public function update($id, Request $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->all();
            $bill_id = $data[0]['bill_id'];
            foreach($data as $value){
                unset($value['bill_id']);
                $value['user_id'] = auth()->user()->id;
                meter_electric_history::where('id', $value['id'])->update($value);
                $value['id'] = $value['meter_id'];
                unset($value['meter_id']);
                $value['start_meter'] = $value['current_meter'];
                meter_electric::where('id', $value['id'])->update($value);


            }
            $block_wait =
            meter_electric_history::select(
                'meter_electric_histories.id',
                'meter_electric_histories.block_id',
                'meter_electric_histories.meter_id',
                'meter_electric_histories.start_meter',
                'meter_electric_histories.current_meter',
                'meter_electric_histories.block_name',
                'meter_electric_histories.cost_electricity_unit_rate',
            )
                ->join('blocks', 'blocks.id', 'meter_electric_histories.block_id')
                ->join('meter_electric_bill_sites', 'blocks.site_id', 'meter_electric_bill_sites.site_id')
                ->where('meter_electric_histories.is_delete', 0)
                ->where('meter_electric_bill_sites.id', $id)
                ->where('meter_electric_histories.bill_id', $bill_id)
                ->where('meter_electric_histories.current_meter', '000000')
                ->count();
            if($block_wait == 0){
                $update['status'] = 1;
            }

            $block_save =  meter_electric_history::select(
                'meter_electric_histories.id',
                'meter_electric_histories.block_id',
                'meter_electric_histories.meter_id',
                'meter_electric_histories.start_meter',
                'meter_electric_histories.current_meter',
                'meter_electric_histories.block_name',
                'meter_electric_histories.cost_electricity_unit_rate',
            )
                ->join('blocks', 'blocks.id', 'meter_electric_histories.block_id')
                ->join('meter_electric_bill_sites', 'blocks.site_id', 'meter_electric_bill_sites.site_id')
                ->where('meter_electric_histories.is_delete', 0)
                ->where('meter_electric_bill_sites.id', $id)
                ->where('meter_electric_histories.bill_id', $bill_id)
                ->where('meter_electric_histories.current_meter', '!=', '000000')
                ->count();
            $update['block_save'] = $block_save;
            $update['block_wait'] = $block_wait;
            meter_electric_bill_site::where('id', $id)->update($update);

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => "update data success!"
            ], 200);

        } catch (\Throwable $th) {
            // throw $th;
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 200);
        }
    }
    public function updateStartDate(Request $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->all();
                $data['user_id'] = auth()->user()->id;
                meter_electric::where('id', $data['id'])->update($data);

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => "update data success!"
            ], 200);

        } catch (\Throwable $th) {
            // throw $th;
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 200);
        }
    }
    public function delete($id){
        try {
            DB::beginTransaction();
           meter_electric::where('id', $id)->update(['is_delete'=> 0]);
            DB::commit();
        return response()->json([
            'success' => true,
            'message' => "delete data success!"
        ], 200);
    } catch (\Throwable $th) {
        // throw $th;
        DB::rollBack();
        return response()->json([
            'success' => false,
            'message' => $th->getMessage()
        ], 200);
    }
    }
}

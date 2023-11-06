<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\meter_electric_bill;
use App\Models\site;
use App\Models\meter_electric;
use App\Models\meter_electric_history;
use App\Models\meter_electric_bill_site;
use Illuminate\Support\Facades\DB;

class MeterElectricBillController extends Controller
{
    public function getList()
    {
        try {
            DB::beginTransaction();
            $page = request()->page ? request()->page : 1;
            $size = request()->size ? request()->size : 100;
            $search = request()->search ? request()->search : "";
            $offset = $this->calSkip($page, $size);

            $data = meter_electric_bill::select(
                'meter_electric_bills.id',
                'meter_electric_bills.bill_code',
                'meter_electric_bills.bill_name',
                'meter_electric_bills.start_date',
                'meter_electric_bills.end_date',
                'meter_electric_bills.total',
                'meter_electric_bills.total_paid',
                'meter_electric_bills.status',
                'meter_electric_bills.total_overdue',
                'meter_electric_bills.updated_at as updated_date',
                'admins.username',
            )
                ->join('admins', 'admins.id', 'meter_electric_bills.user_id')
                ->where('meter_electric_bills.is_delete', 0)
                ->whereRaw('(meter_electric_bills.bill_name LIKE "%' . $search . '%" OR meter_electric_bills.bill_code LIKE "%' . $search . '%" )')
                ->offset($offset)
                ->limit($size)
                ->get();

            $count = meter_electric_bill::select(
                'meter_electric_bills.bill_code',
                'meter_electric_bills.bill_name',
                'meter_electric_bills.start_date',
                'meter_electric_bills.end_date',
                'meter_electric_bills.total',
                'meter_electric_bills.total_paid',
                'meter_electric_bills.total_overdue',
                'meter_electric_bills.updated_at as updated_date',
                'admins.username',
            )
                ->join('admins', 'admins.id', 'meter_electric_bills.user_id')
                ->where('meter_electric_bills.is_delete', 0)
                ->whereRaw('(meter_electric_bills.bill_name LIKE "%' . $search . '%" OR meter_electric_bills.bill_code LIKE "%' . $search . '%" )')
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
            $data = meter_electric_bill::where('id', $id)->first();

            DB::commit();
            return response()->json([
                'success' => true,
                'data' => $data
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

    public function checkBillCode(){
        try {
        $check = meter_electric_bill::orderBy('id', 'desc')->first();
        if($check == null){
            $check = 1;
        }else{
            $check = $check->id+1;
        }
        $data['bill_code'] = 'ive-' . str_pad($check, 4, '0', STR_PAD_LEFT);
        return response()->json([
            'success' => true,
            'data' => $data,
        ], 200);
    } catch (\Throwable $th) {
        // throw $th;
        return response()->json([
            'success' => false,
            'message' => $th->getMessage()
        ], 200);
    }
    }

    public function getDetailSaveMeterById($id)
    {
        try {
            DB::beginTransaction();
            $data = meter_electric_history::select(
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
                ->where('meter_electric_histories.bill_id', request()->bill_id)
                ->get();

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

    public function getDetailById($id)
    {
        try {
            DB::beginTransaction();
            $data = meter_electric_bill::where('id', $id)->first();
            $data['list'] = meter_electric_bill_site::where('bill_id', $id)->get();

            DB::commit();
            return response()->json([
                'success' => true,
                'data' => $data
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

            $check = meter_electric_bill::orderBy('id', 'desc')->first();
            if($check == null){
                $check = 1;
            }else{
                $check = $check->id+1;
            }
            $data = $request->all();
            $data['user_id'] = auth()->user()->id;
            $data['bill_code'] = 'ive-' . str_pad($check, 4, '0', STR_PAD_LEFT);
            meter_electric_bill::create($data);
            $bill_data = meter_electric_bill::orderBy('id', 'desc')->first();
            $site = site::select(
                'sites.site_name',
                'sites.id as site_id',
                DB::raw('(SELECT COUNT(id) FROM blocks where blocks.site_id = sites.id GROUP BY blocks.site_id) as total'),
            )
            ->where('is_delete', 0)
            ->get();

            foreach($site as $value){
                meter_electric_bill_site::create([
                    'site_name'=> $value['site_name'],
                    'site_id'=> $value['site_id'],
                    'bill_id'=> $bill_data['id'],
                    'block_total'=> $value['total'],
                    'block_save'=> 0,
                    'block_wait'=> 0,
                    'status'=> 0
                ]);
            }

            $meter_electric = meter_electric::select(
                'meter_electrics.id as meter_id',
                'meter_electrics.block_id',
                'blocks.site_id',
                'meter_electrics.start_meter',
                'meter_electrics.current_meter',
                'meter_electrics.block_name',
                'meter_electrics.cost_electricity_unit_rate',
               )
               ->join('blocks', 'blocks.id', 'meter_electrics.block_id')
               ->get();

               $aar_meter_electric = $meter_electric->toArray();
               foreach($aar_meter_electric as $value){
                $value['bill_id'] = $bill_data['id'];
                   meter_electric_history::create($value);
               }

            DB::commit();
            return response()->json([
                'success' => true,
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

    public function update(Request $request)
    {
        try {

            DB::beginTransaction();
            $data = $request->all();
            $data['user_id'] = auth()->user()->id;
            $data = meter_electric_bill::where('id', $data['id'])->update($data);

            DB::commit();
            return response()->json([
                'success' => true,
                'data' => $data,
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

    public function delete($id)
    {
        try {
            DB::beginTransaction();
            meter_electric_bill::where('id', $id)->update(['status' => 3]);
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

    public function updateStatus($id){
        try {
            DB::beginTransaction();
        meter_electric_bill::where('id', $id)->update(['status' => 1]);

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
}

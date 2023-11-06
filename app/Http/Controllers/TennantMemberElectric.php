<?php

namespace App\Http\Controllers;

use App\Models\meter_electric_bill;
use App\Models\site;
use App\Models\block;
use App\Models\meter_electric;
use App\Models\meter_electric_history;
use App\Models\tennant_member;
use App\Models\tennant_member_electric;
use App\Models\meter_electric_bill_site;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class TennantMemberElectric extends Controller
{
    public function getList($id)
    {
        try {
            DB::beginTransaction();
            $page = request()->page ? request()->page : 1;
            $size = request()->size ? request()->size : 100;
            $search = request()->search ? request()->search : "";
            $offset = $this->calSkip($page, $size);

            $offset = $this->calSkip($page, $size);

            $data = tennant_member_electric::select(
                'tennant_member_electrics.*',
            )
                ->where('tennant_member_electrics.bill_id', $id)
                ->whereRaw('(tennant_member_electrics.member_name LIKE "%' . $search . '%" OR tennant_member_electrics.bill_code LIKE "%' . $search . '%" )')
                ->offset($offset)
                ->limit($size)
                ->get();

            $count = tennant_member_electric::select(
                'tennant_member_electrics.*',
            )
                ->where('tennant_member_electrics.bill_id', $id)
                ->whereRaw('(tennant_member_electrics.member_name LIKE "%' . $search . '%" OR tennant_member_electrics.bill_code LIKE "%' . $search . '%" )')
                ->offset($offset)
                ->limit($size)
                ->get()
                ->count();

            DB::commit();
            return response()->json([
                'success' => true,
                'data' => $data,
                'current_page' => $page,
                'pages' => $this->calPage($count, $size),
                'message' => "get data success!"
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
            $data = tennant_member_electric::select(
                'tennant_member_electrics.*',
            )
                ->where('tennant_member_electrics.id', $id)
                ->first();

            $arr_block = explode(',', $data->block_list);
            $data['list'] = meter_electric_history::select(
                'meter_electric_histories.*',
            )
                ->whereIn('meter_electric_histories.block_name', $arr_block)
                ->where('meter_electric_histories.bill_id', $data->bill_id)
                ->get();


            DB::commit();
            return response()->json([
                'success' => true,
                'data' => $data,
                'message' => "get data success!"
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

    public function updateStatus($id)
    {
        try {
            DB::beginTransaction();

            tennant_member_electric::where('id', $id)->update([
                'status' => 1,
                'pay_status' => 1,
            ]);
            $member = tennant_member_electric::where('id', $id)->first();
            $data = meter_electric_bill::where('id',$member->bill_id);
            $data->decrement('total_overdue', $member->total );
            $data->increment('total_paid', $member->total );

            $data = tennant_member_electric::where('id', $id)->first();
            $count = tennant_member_electric::select()
                ->where('status', 0)
                ->where('bill_id', $data->bill_id)
                ->get()
                ->count();

            if ($count == 0) {
                meter_electric_bill::where('id', $data->bill_id)->update(['status' => 2]);
            }

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => "update data success!",
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

    public function create($id)
    {

        $check = meter_electric_bill::where('id', $id)->first();
        // dd($check->bill_code);
        $data = tennant_member::select(
            'tennant_members.name as member_name',
            'tennant_members.id as user_id',
            'blocks.site_id',
            DB::raw('(0) as status'),
            DB::raw('(' . $id . ') as bill_id'),
            DB::raw('SUM((meter_electric_histories.current_meter - meter_electric_histories.start_meter) * meter_electric_histories.cost_electricity_unit_rate) as total'),
            DB::raw('SUM(meter_electric_histories.current_meter - meter_electric_histories.start_meter) as unit_total'),
            DB::raw("(SELECT GROUP_CONCAT(blocks.block_name SEPARATOR ',') FROM blocks WHERE blocks.tennant_member_id = tennant_members.id) as block_list")
        )
            ->join('blocks', 'tennant_members.id', 'blocks.tennant_member_id')
            ->join('meter_electric_histories', 'meter_electric_histories.block_id', 'blocks.id')
            ->groupBy('tennant_members.id', 'blocks.site_id')
            ->get();


            $total = 0;
        foreach ($data as $value) {
            $total += $value['total'];
            $member = tennant_member_electric::orderBy('id', 'desc')->first();
            if ($member == null) {
                $member = 1;
            } else {
                $member = $member->id + 1;
            }
            $ch = $check->bill_code . str_pad($member, 4, '0', STR_PAD_LEFT);
            $valueArray = $value->toArray();
            $valueArray['bill_code'] = $ch;

            tennant_member_electric::create($valueArray);
        }
        meter_electric_bill::where('id', $id)->update([
            'total' => $total,
            'total_overdue' => $total,
        ]);

        return response()->json([
            'success' => true,
            'data' => $data,
            'message' => "create data success!"
        ], 200);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\meter_water_bill;
use App\Models\site;
use App\Models\block;
use App\Models\meter_water;
use App\Models\meter_water_history;
use App\Models\tennant_member;
use App\Models\tennant_member_water;
use App\Models\meter_water_bill_site;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class TennantMemberwater extends Controller
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

            $data = tennant_member_water::select(
                'tennant_member_waters.*',
            )
                ->where('tennant_member_waters.bill_id', $id)
                ->whereRaw('(tennant_member_waters.member_name LIKE "%' . $search . '%" OR tennant_member_waters.bill_code LIKE "%' . $search . '%" )')
                ->offset($offset)
                ->limit($size)
                ->get();

            $count = tennant_member_water::select(
                'tennant_member_waters.*',
            )
                ->where('tennant_member_waters.bill_id', $id)
                ->whereRaw('(tennant_member_waters.member_name LIKE "%' . $search . '%" OR tennant_member_waters.bill_code LIKE "%' . $search . '%" )')
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
            $data = tennant_member_water::select(
                'tennant_member_waters.*',
            )
                ->where('tennant_member_waters.id', $id)
                ->first();

            $arr_block = explode(',', $data->block_list);
            $data['list'] = meter_water_history::select(
                'meter_water_histories.*',
            )
                ->whereIn('meter_water_histories.block_name', $arr_block)
                ->where('meter_water_histories.bill_id', $data->bill_id)
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

            tennant_member_water::where('id', $id)->update([
                'status' => 1,
                'pay_status' => 1,
            ]);
            $member = tennant_member_water::where('id', $id)->first();
            $data = meter_water_bill::where('id',$member->bill_id);
            $data->decrement('total_overdue', $member->total );
            $data->increment('total_paid', $member->total );

            $data = tennant_member_water::where('id', $id)->first();
            $count = tennant_member_water::select()
                ->where('status', 0)
                ->where('bill_id', $data->bill_id)
                ->get()
                ->count();

            if ($count == 0) {
                meter_water_bill::where('id', $data->bill_id)->update(['status' => 2]);
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

        $check = meter_water_bill::where('id', $id)->first();
        // dd($check->bill_code);
        $data = tennant_member::select(
            'tennant_members.name as member_name',
            'tennant_members.id as user_id',
            'blocks.site_id',
            DB::raw('(0) as status'),
            DB::raw('(' . $id . ') as bill_id'),
            DB::raw('SUM((meter_water_histories.current_meter - meter_water_histories.start_meter) * meter_water_histories.cost_electricity_unit_rate) as total'),
            DB::raw('SUM(meter_water_histories.current_meter - meter_water_histories.start_meter) as unit_total'),
            DB::raw("(SELECT GROUP_CONCAT(blocks.block_name SEPARATOR ',') FROM blocks WHERE blocks.tennant_member_id = tennant_members.id) as block_list")
        )
            ->join('blocks', 'tennant_members.id', 'blocks.tennant_member_id')
            ->join('meter_water_histories', 'meter_water_histories.block_id', 'blocks.id')
            ->groupBy('tennant_members.id', 'blocks.site_id')
            ->get();


            $total = 0;
        foreach ($data as $value) {
            $total += $value['total'];
            $member = tennant_member_water::orderBy('id', 'desc')->first();
            if ($member == null) {
                $member = 1;
            } else {
                $member = $member->id + 1;
            }
            $ch = $check->bill_code . str_pad($member, 4, '0', STR_PAD_LEFT);
            $valueArray = $value->toArray();
            $valueArray['bill_code'] = $ch;

            tennant_member_water::create($valueArray);
        }
        meter_water_bill::where('id', $id)->update([
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

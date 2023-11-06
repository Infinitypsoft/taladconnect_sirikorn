<?php

namespace App\Http\Controllers;

use App\Models\block;
use App\Models\contract_setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContractSettingController extends Controller
{
    //

    public function getById(){
        try{
            // $date = Carbon::parse('2023-10-28');
            // dd($date->dayOfWeek);

            $data = contract_setting::select(
                '*'
            )
            ->where([
                ['id',1]
            ])
            ->first();

            return response()->json([
                'success' => true,
                'message' => "get data success!",
                'data' => $data
            ], 200);

        } catch (\Throwable $th) {
            // throw $th;
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function update(Request $request){
        try{
            DB::beginTransaction();

                $data = $request->all();
                // $data['user_edit'] = auth()->user()->id;


                $create = contract_setting::where('id',$request->id)->update($data);
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => "update data success!"
            ], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}

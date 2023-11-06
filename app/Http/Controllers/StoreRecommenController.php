<?php

namespace App\Http\Controllers;

use App\Models\store_recommen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StoreRecommenController extends Controller
{
    //

    public function getList(){
        try{

            // dd("sadsad");
            $data = store_recommen::select(
                'store_recommens.id',
                'store_recommens.store_id',
                'stores.store_name',
                'stores.pic_path'
            )
            ->leftjoin('stores','stores.id','store_recommens.store_id')
            ->get();

            return response()->json([
                'success' => true,
                'data' => $data,
                'message' => "get data success!"
            ], 200);

        } catch (\Throwable $th) {
            // throw $th;
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 200);
        }
    }

    public function update(Request $request){
        try{
            DB::beginTransaction();

                foreach($request->list as $item){
                    $data = $item;
                    store_recommen::where([['id',$data['id']]])->update($data);
                }


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
            ], 500);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\setting_seo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class SettingSeoController extends Controller
{
    //

    public function getFirst(){
        try{

            $data = setting_seo::select(
                'setting_seos.*',
                'setting_seos.updated_at as updated_date',
                'admins.name as user_edit_name'
            )->leftJoin('admins','admins.id','setting_seos.user_edit')
            ->first();

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

                // dd(auth()->user());
                $data = $request->all();
                $data['user_edit'] = auth()->user()->id;
                $update = setting_seo::where('id',$request->id)->update($data);
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

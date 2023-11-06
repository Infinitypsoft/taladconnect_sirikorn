<?php

namespace App\Http\Controllers;

use App\Models\store;
use App\Models\store_block_list;
use App\Models\store_pic_list;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class StoreController extends Controller
{
    //

    public function getListStoreByTenantId($tennant_id){
        try{
            DB::beginTransaction();

            $data = store::select(
                'stores.id',
                DB::raw('(
                    SELECT GROUP_CONCAT(blocks.block_name)
                    FROM store_block_lists
                    JOIN blocks ON blocks.id = store_block_lists.block_id
                    WHERE store_block_lists.store_id = stores.id
                    AND store_block_lists.is_delete = 0
                ) as block_list'),
                'stores.pic_path',
                'stores.store_name',
                'stores.description_short',
                'stores.store_type',
                'stores.product_type',
                'stores.price_min',
                'stores.price_max',
                'stores.location',
                'stores.facebook_link',
                'stores.line_link',
                'stores.instagram_link',
                'stores.tiktok_link',
                'stores.time_open',
                'stores.time_close',
                'stores.tel',
                'admins.name as user_edit_name',
                'stores.updated_at as updated_date'
            )
            ->join('admins','admins.id','stores.user_edit')
            ->where([
                ['stores.is_delete',0],
                ['stores.tennant_member_id',$tennant_id]
            ])
            ->get();

            foreach($data as $item){
                $item->pic_list = store_pic_list::select('pic_path')->where('store_id',$item->id)->get();
            }

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => "get data success!",
                'data' =>$data
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

    public function create(Request $request){
        try{
            DB::beginTransaction();


                $data = $request->all();
                unset($data['block_list']);
                unset($data['pic_list']);

                unset($data['pic']);
                if ($request->hasFile('pic')) {
                    $pic_from_request = $request->file('pic');
                    $picture = time() . $pic_from_request->getClientOriginalName();
                    $path = 'upload/images/store/' . $picture;

                    $directory = public_path('upload/images/store');
                    if (!File::exists($directory)) {
                        File::makeDirectory($directory, 0775, true);
                    }

                    Image::make($pic_from_request)->save(public_path($path));

                    $data['pic'] = $picture;
                    $data['pic_path'] = $path;
                }
                unset($data['product_1_pic']);
                if ($request->hasFile('product_1_pic')) {
                    $pic_from_request = $request->file('product_1_pic');
                    $picture = time() . $pic_from_request->getClientOriginalName();
                    $path = 'upload/images/store/product/' . $picture;

                    $directory = public_path('upload/images/store/product');
                    if (!File::exists($directory)) {
                        File::makeDirectory($directory, 0775, true);
                    }

                    Image::make($pic_from_request)->save(public_path($path));

                    $data['product_1_pic'] = $picture;
                    $data['product_1_pic_path'] = $path;
                }
                unset($data['product_2_pic']);
                if ($request->hasFile('product_2_pic')) {
                    $pic_from_request = $request->file('product_2_pic');
                    $picture = time() . $pic_from_request->getClientOriginalName();
                    $path = 'upload/images/store/product/' . $picture;

                    $directory = public_path('upload/images/store/product');
                    if (!File::exists($directory)) {
                        File::makeDirectory($directory, 0775, true);
                    }

                    Image::make($pic_from_request)->save(public_path($path));

                    $data['product_2_pic'] = $picture;
                    $data['product_2_pic_path'] = $path;
                }
                unset($data['product_3_pic']);
                if ($request->hasFile('product_3_pic')) {
                    $pic_from_request = $request->file('product_3_pic');
                    $picture = time() . $pic_from_request->getClientOriginalName();
                    $path = 'upload/images/store/product/' . $picture;

                    $directory = public_path('upload/images/store/product');
                    if (!File::exists($directory)) {
                        File::makeDirectory($directory, 0775, true);
                    }

                    Image::make($pic_from_request)->save(public_path($path));

                    $data['product_3_pic'] = $picture;
                    $data['product_3_pic_path'] = $path;
                }
                unset($data['product_4_pic']);
                if ($request->hasFile('product_4_pic')) {
                    $pic_from_request = $request->file('product_4_pic');
                    $picture = time() . $pic_from_request->getClientOriginalName();
                    $path = 'upload/images/store/product/' . $picture;

                    $directory = public_path('upload/images/store/product');
                    if (!File::exists($directory)) {
                        File::makeDirectory($directory, 0775, true);
                    }

                    Image::make($pic_from_request)->save(public_path($path));

                    $data['product_4_pic'] = $picture;
                    $data['product_4_pic_path'] = $path;
                }

                $data['user_edit'] = auth()->user()->id;
                // $data['product_type'] = json_decode($data['product_type']);
                // dd(json_decode($data['product_type']), $data);
                $create = store::create($data);

                if($request->block_list){
                    foreach($request->block_list as $block_list){
                        store_block_list::create([
                            'store_id' => $create->id,
                            'block_id' => $block_list,
                        ]);
                    }
                }

                if($request->pic_list){
                    foreach($request->pic_list as $key => $pic_list){
                        $pic_from_request = $pic_list;
                        $picture = time() . $pic_from_request->getClientOriginalName();
                        $path = 'upload/images/store/pic/' . $picture;

                        $directory = public_path('upload/images/store/pic');
                        if (!File::exists($directory)) {
                            File::makeDirectory($directory, 0775, true);
                        }

                        Image::make($pic_from_request)->save(public_path($path));

                        store_pic_list::create([
                            'store_id' => $create->id,
                            'pic' => $picture,
                            'pic_path' => $path
                        ]);
                    }
                }



            DB::commit();
            return response()->json([
                'success' => true,
                'message' => "create data success!",
                "id" =>  $create->id
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

    public function getById($store_id){
        try {

            $data = store::select(
                'stores.*',
            )
            ->where([
                ['stores.is_delete', 0],
                ['stores.id', $store_id]
            ])
            ->first();
            $data['product_type'] = $data['product_type'] == NULL ? [] : explode(',',$data->product_type);
            $data['product_type_eng'] = $data['product_type_eng'] == NULL ? [] : explode(',',$data->product_type_eng);
            $data['pic_list'] = store_pic_list::select(
                'id',
                'pic',
                'pic_path',
            )->where('store_id',$store_id)
            ->get();
            $data['block_list'] = store_block_list::select('store_block_lists.id','store_block_lists.block_id','blocks.block_name')->join('blocks','blocks.id','store_block_lists.block_id')->where([['store_block_lists.store_id',$store_id],['store_block_lists.is_delete',0]])->get();

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
                unset($data['block_list']);
                unset($data['pic_list']);
                unset($data['arr_del_pic']);

                if($request->pic_list){
                    $pic_list = json_decode($request->pic_list);

                    foreach( $pic_list as $key => $item){
                        $pic = (array)$item;
                        unset($pic['pic']);
                        if($request->hasFile($key)){
                            $pic_from_request =  $request->file($key);
                            $picture = time() . $pic_from_request->getClientOriginalName();
                            $path = 'upload/images/store/pic/' . $picture;
                            $directory = public_path('upload/images/store/pic');
                            if (!File::exists($directory)) {
                                File::makeDirectory($directory, 0775, true);
                            }
                            Image::make($pic_from_request)->save(public_path($path));
                            $pic['pic'] = $picture;
                            $pic['pic_path'] = $path;

                            if($pic['id'] == NULL){
                                $pic['store_id'] = $data['id'];
                                store_pic_list::create($pic);
                            }
                        }
                        if($pic['id']!= NULL){
                            if(isset($pic['is_delete'])){
                                store_pic_list::where('id',$pic['id'])->delete();
                            }else{
                                store_pic_list::where('id',$pic['id'])->update($pic);
                            }
                        }
                        unset($data[$key]);
                    }
                }

                unset($data['pic']);
                if ($request->hasFile('pic')) {
                    $pic_from_request = $request->file('pic');
                    $picture = time() . $pic_from_request->getClientOriginalName();
                    $path = 'upload/images/store/' . $picture;

                    $directory = public_path('upload/images/store');
                    if (!File::exists($directory)) {
                        File::makeDirectory($directory, 0775, true);
                    }

                    Image::make($pic_from_request)->save(public_path($path));

                    $data['pic'] = $picture;
                    $data['pic_path'] = $path;
                }
                unset($data['product_1_pic']);
                if ($request->hasFile('product_1_pic')) {
                    $pic_from_request = $request->file('product_1_pic');
                    $picture = time() . $pic_from_request->getClientOriginalName();
                    $path = 'upload/images/store/product/' . $picture;

                    $directory = public_path('upload/images/store/product');
                    if (!File::exists($directory)) {
                        File::makeDirectory($directory, 0775, true);
                    }

                    Image::make($pic_from_request)->save(public_path($path));

                    $data['product_1_pic'] = $picture;
                    $data['product_1_pic_path'] = $path;
                }
                unset($data['product_2_pic']);
                if ($request->hasFile('product_2_pic')) {
                    $pic_from_request = $request->file('product_2_pic');
                    $picture = time() . $pic_from_request->getClientOriginalName();
                    $path = 'upload/images/store/product/' . $picture;

                    $directory = public_path('upload/images/store/product');
                    if (!File::exists($directory)) {
                        File::makeDirectory($directory, 0775, true);
                    }

                    Image::make($pic_from_request)->save(public_path($path));

                    $data['product_2_pic'] = $picture;
                    $data['product_2_pic_path'] = $path;
                }
                unset($data['product_3_pic']);
                if ($request->hasFile('product_3_pic')) {
                    $pic_from_request = $request->file('product_3_pic');
                    $picture = time() . $pic_from_request->getClientOriginalName();
                    $path = 'upload/images/store/product/' . $picture;

                    $directory = public_path('upload/images/store/product');
                    if (!File::exists($directory)) {
                        File::makeDirectory($directory, 0775, true);
                    }

                    Image::make($pic_from_request)->save(public_path($path));

                    $data['product_3_pic'] = $picture;
                    $data['product_3_pic_path'] = $path;
                }
                unset($data['product_4_pic']);
                if ($request->hasFile('product_4_pic')) {
                    $pic_from_request = $request->file('product_4_pic');
                    $picture = time() . $pic_from_request->getClientOriginalName();
                    $path = 'upload/images/store/product/' . $picture;

                    $directory = public_path('upload/images/store/product');
                    if (!File::exists($directory)) {
                        File::makeDirectory($directory, 0775, true);
                    }

                    Image::make($pic_from_request)->save(public_path($path));

                    $data['product_4_pic'] = $picture;
                    $data['product_4_pic_path'] = $path;
                }
                $data['user_edit'] = auth()->user()->id;
                store::where('id',$data['id'])->update($data);

                if($request->block_list){
                    $block_list = json_decode($request->block_list,true);

                    store_block_list::where('store_id',$request->id)->delete();
                    foreach($block_list as $item){
                        store_block_list::create([
                            'store_id'=> $request->id,
                            'block_id' => $item
                        ]);
                    }

                }


                // if(isset($request->arr_del_pic)){
                    // store_pic_list::whereNOTIn('id',$request->arr_del_pic)->delete();
                // }




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


    public function getListToselectBox(){
        try {

            $data = store::select(
                'stores.id',
                'stores.store_name',
                'stores.pic_path'
            )
            ->where([
                ['stores.is_delete', 0],
            ])
            ->get();

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
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\awards;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;

class AwardsController extends Controller
{
    //
    // $order_code = IdGenerator::generate([
    //     'table' => 'order_admins',
    //     'field' => 'order_code',
    //     'prefix' => 'A-' . date('Ymd'),
    //     'reset_on_prefix_change' => 'false',
    //     'length' => 17,
    // ]);


    // $pr_code = IdGenerator::generate(
    //     [
    //         'table' => 'order_admins',
    //         'field' => 'pr_code',
    //         'prefix' => 'A-' . date('Y'),
    //         'reset_on_prefix_change' => 'false',
    //         'length' => 15,
    //     ]
    // );

    public function getList(){
        try{

            $page = request()->page ? request()->page : 1;
            $size = request()->size ? request()->size : 5;
            $search = request()->search ? request()->search : "";

            $offset = $this->calSkip($page,$size);

            $data = awards::select(
                'awards.id',
                'awards.pic_path',
                'awards.name_thai',
                'awards.name_eng',
                'awards.status',
                'awards.updated_at as updated_date',
                'admins.name as user_edit_name'
            )
            ->join('admins','admins.id','awards.user_edit')
            ->where([
                ['awards.is_delete',0],
            ])
            ->offset($offset)
            ->limit($size)
            ->get();

            $count = awards::select('*')
            ->where([
                ['is_delete',0]
            ])
            ->get()
            ->count();

            return response()->json([
                'success' => true,
                'data' => $data,
                'current_page'=> $page,
                'pages'=> $this->calPage($count, $size),
                'count_all' => $count,
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

    public function create(Request $request){
        try{
            DB::beginTransaction();
                $validator = Validator::make($request->all(), [
                    // 'pic' => 'required|image|mimes:jpg,jpeg,png|max:2048',
                    'name_thai' => 'string|max:255',
                    'name_eng' => 'string|max:255',
                ]);

                if ($validator->fails()) {
                    return response()->json([
                        'success' => false,
                        'message' => $validator->errors()
                    ]);
                }

                $data = $request->all();
                unset($data['pic']);
                if ($request->hasFile('pic')) {
                    $pic_from_request = $request->file('pic');
                    $picture = time() . $pic_from_request->getClientOriginalName();
                    $path = 'upload/images/award/' . $picture;

                    $directory = public_path('upload/images/award');
                    if (!File::exists($directory)) {
                        File::makeDirectory($directory, 0775, true);
                    }

                    Image::make($pic_from_request)->save(public_path($path));

                    $data['pic'] = $picture;
                    $data['pic_path'] = $path;
                }
                $data['user_edit'] = auth()->user()->id;
                // dd($data);
                $create = awards::create($data);

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
            ], 500);
        }
    }

    public function getById($id){
        try{
            $admin = awards::select(
                '*'
            )
            ->where([
                ['is_delete',0],
                ['id',$id]
            ])
            ->first();

            return response()->json([
                'success' => true,
                'message' => "get data success!",
                'data' => $admin
            ], 200);

        } catch (\Throwable $th) {
            // throw $th;
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function getDetail($id){
        try{

            $admin = awards::select(
                '*'
            )
            ->where([
                ['is_delete',0],
                ['id',$id]
            ])
            ->first();

            return response()->json([
                'success' => true,
                'message' => "get data success!",
                'data' => $admin
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

                $validator = Validator::make($request->all(), [
                    // 'pic' => 'image|mimes:jpg,jpeg,png|max:2048',
                    'name_thai' => 'string|max:255',
                    'name_eng' => 'string|max:255',
                ]);
                if ($validator->fails()) {
                    return response()->json([
                        'success' => false,
                        'message' => $validator->errors()
                    ]);
                }

                $data = $request->all();
                unset($data['pic']);
                if ($request->hasFile('pic')) {
                    $pic_from_request = $request->file('pic');
                    $picture = time() . $pic_from_request->getClientOriginalName();
                    $path = 'upload/images/award/' . $picture;

                    $directory = public_path('upload/images/award');
                    if (!File::exists($directory)) {
                        File::makeDirectory($directory, 0775, true);
                    }

                    Image::make($pic_from_request)->save(public_path($path));

                    $data['pic'] = $picture;
                    $data['pic_path'] = $path;
                }

                $data['user_edit'] = auth()->user()->id;
                $create = awards::where('id',$request->id)->update($data);


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

    public function updateStatus($id){
        try{
            DB::beginTransaction();

            $update = awards::where('id',$id)->update(['status'=>request()->status,'user_edit'=>auth()->user()->id]);

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => "update status success!"
            ], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function delete($id){
        try{
            DB::beginTransaction();
            $update = awards::where('id',$id)->update(['is_delete'=> 1,'user_edit'=>auth()->user()->id ]);
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => "delete success!"
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

<?php

namespace App\Http\Controllers;

use App\Models\requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;

class RequestsController extends Controller
{
    //
    public function getList(){
        try{

            $page = request()->page ? request()->page : 1;
            $size = request()->size ? request()->size : 8;
            $search = request()->search ? request()->search : "";

            $offset = $this->calSkip($page,$size);

            $data = requests::select(
                'requests.*',
                'requests.updated_at as updated_date',
                'requests.created_at as created_date',
            )
            // ->where([
            //     ['requests.is_delete',0],
            // ])
            ->whereRaw('(id LIKE "%' . $search . '%" OR name LIKE "%' . $search . '%" )')
            ->offset($offset)
            ->limit($size)
            ->get();

            $count = requests::select('*')
            // ->where([
            //     ['is_delete',0]
            // ])
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
                ]);
                if ($validator->fails()) {
                    return response()->json([
                        'success' => false,
                        'message' => $validator->errors()
                    ]);
                }

                $data = $request->all();

                // if ($request->hasFile('pic')) {
                //     $pic_from_request = $request->file('pic');
                //     $picture = time() . $pic_from_request->getClientOriginalName();
                //     $path = 'upload/images/requests/' . $picture;

                //     $directory = public_path('upload/images/requests');
                //     if (!File::exists($directory)) {
                //         File::makeDirectory($directory, 0775, true);
                //     }

                //     Image::make($pic_from_request)->save(public_path($path));

                //     $data['pic'] = $picture;
                //     $data['pic_path'] = $path;
                // }

                $data['user_edit'] = auth()->user()->id;
                $create = requests::create($data);

            DB::commit();
            return response()->json([
                'success' => true,
                'id' => $create->id,
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

            $admin = requests::select(
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

            $admin = requests::select(
                'requests.*',
                'requests.updated_at as updated_date',
                'admins.name as user_edit_name'
            )
            ->join('admins','admins.id','requests.user_edit')
            ->where([
                ['requests.is_delete',0],
                ['requests.id',$id]
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
                    // 'title_thai' => 'string|max:255',
                    // 'title_eng' => 'string|max:255',
                    // 'description_thai' => 'string',
                    // 'description_eng' => 'string',
                ]);
                if ($validator->fails()) {
                    return response()->json([
                        'success' => false,
                        'message' => $validator->errors()
                    ]);
                }

                $data = $request->all();
                // if ($request->hasFile('pic')) {
                //     $pic_from_request = $request->file('pic');
                //     $picture = time() . $pic_from_request->getClientOriginalName();
                //     $path = 'upload/images/requests/' . $picture;

                //     $directory = public_path('upload/images/requests');
                //     if (!File::exists($directory)) {
                //         File::makeDirectory($directory, 0775, true);
                //     }

                //     Image::make($pic_from_request)->save(public_path($path));

                //     $data['pic'] = $picture;
                //     $data['pic_path'] = $path;
                // }

                $data['user_edit'] = auth()->user()->id;
                $create = requests::where('id',$request->id)->update($data);

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

            $update = requests::where('id',$id)->update(['status'=>request()->status,'user_edit'=>auth()->user()->id]);

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
            $update = requests::where('id',$id)->update(['is_delete'=> 1,'user_edit'=>auth()->user()->id ]);
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

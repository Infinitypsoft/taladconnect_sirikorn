<?php

namespace App\Http\Controllers;

use App\Models\stall;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;

class StallController extends Controller
{
    //

    public function getList(){
        try{

            $page = request()->page ? request()->page : 1;
            $size = request()->size ? request()->size : 100;
            $search = request()->search ? request()->search : "";

            $offset = $this->calSkip($page,$size);

            $data = stall::select(
                'stalls.*',
            )
            ->join('admins','admins.id','stalls.user_edit')
            ->where([
                ['stalls.is_delete',0],
            ])
            ->offset($offset)
            ->limit($size)
            ->get();

            $count = stall::select('*')
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
                    $path = 'upload/images/stall/' . $picture;

                    $directory = public_path('upload/images/stall');
                    if (!File::exists($directory)) {
                        File::makeDirectory($directory, 0775, true);
                    }

                    Image::make($pic_from_request)->save(public_path($path));

                    $data['pic'] = $picture;
                    $data['pic_path'] = $path;
                }
                $data['user_edit'] = auth()->user()->id;
                $create = stall::create($data);

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

            $admin = stall::select(
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

            $admin = stall::select(
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
                unset($data['pic']);
                if ($request->hasFile('pic')) {
                    $pic_from_request = $request->file('pic');
                    $picture = time() . $pic_from_request->getClientOriginalName();
                    $path = 'upload/images/stall/' . $picture;

                    $directory = public_path('upload/images/stall');
                    if (!File::exists($directory)) {
                        File::makeDirectory($directory, 0775, true);
                    }

                    Image::make($pic_from_request)->save(public_path($path));

                    $data['pic'] = $picture;
                    $data['pic_path'] = $path;
                }

                $data['user_edit'] = auth()->user()->id;
                $create = stall::where('id',$request->id)->update($data);


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

            $update = stall::where('id',$id)->update(['status'=>request()->status,'user_edit'=>auth()->user()->id]);

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
            $update = stall::where('id',$id)->update(['is_delete'=> 1,'user_edit'=>auth()->user()->id ]);
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

    public function getListSelectBox(){
        try{

            $data = stall::select(
                'stalls.id',
                'stalls.name',
                'stalls.size_w',
                'stalls.size_h',
                'stalls.color_stall',
                'stalls.color_table',
            )
            ->join('admins','admins.id','stalls.user_edit')
            ->where([
                ['stalls.is_delete',0],
            ])
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

}

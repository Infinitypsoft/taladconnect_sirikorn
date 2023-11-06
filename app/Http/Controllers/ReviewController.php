<?php

namespace App\Http\Controllers;

use App\Models\review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
// use Validator;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{
    //
    public function getList(){
        try{

            $page = request()->page ? request()->page : 1;
            $size = request()->size ? request()->size : 8;
            $review_type = request()->review_type ? request()->review_type : 0;
            $search = request()->search ? request()->search : "";

            $offset = $this->calSkip($page,$size);

            $data = review::select(
                'reviews.*',
                'reviews.updated_at as updated_date',
            )
            ->where([
                ['reviews.is_delete',0],
                ['reviews.review_type', $review_type],
            ])
            ->offset($offset)
            ->limit($size)
            ->get();

            $count = review::select('*')
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
                    'name' => 'string|max:255',
                    'rating' => ['required', 'numeric', 'in:0.5, 1, 1.5, 2, 2.5, 3, 3.5, 4, 4.5, 5'],
                    'comment' => 'string',
                    'review_type' => 'required|integer|in:0,1',

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
                    $path = 'upload/images/review/' . $picture;

                    $directory = public_path('upload/images/review');
                    if (!File::exists($directory)) {
                        File::makeDirectory($directory, 0775, true);
                    }

                    Image::make($pic_from_request)->save(public_path($path));

                    $data['pic'] = $picture;
                    $data['pic_path'] = $path;
                }

                $data['user_edit'] = auth()->user()->id;
                $create = review::create($data);

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

            $admin = review::select(
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

            $admin = review::select(
                'reviews.*',
                'reviews.updated_at as updated_date',
                'admins.name as user_edit_name'
            )
            ->join('admins','admins.id','reviews.user_edit')
            ->where([
                ['reviews.is_delete',0],
                ['reviews.id',$id]
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
                    'review_approval' => 'required|integer|in:0,1,2',
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
                    $path = 'upload/images/review/' . $picture;

                    $directory = public_path('upload/images/review');
                    if (!File::exists($directory)) {
                        File::makeDirectory($directory, 0775, true);
                    }

                    Image::make($pic_from_request)->save(public_path($path));

                    $data['pic'] = $picture;
                    $data['pic_path'] = $path;
                }

                $data['user_edit'] = auth()->user()->id;
                $create = review::where('id',$request->id)->update($data);


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

            $update = review::where('id',$id)->update(['status'=>request()->status,'user_edit'=>auth()->user()->id]);

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
            $update = review::where('id',$id)->update(['is_delete'=> 1,'user_edit'=>auth()->user()->id ]);
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

<?php

namespace App\Http\Controllers;

use App\Models\tennant_member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class TennantMemberController extends Controller
{
    //

    public function getList(){
        try{

            $page = request()->page ? request()->page : 1;
            $size = request()->size ? request()->size : 10;
            $search = request()->search ? request()->search : "";

            $offset = $this->calSkip($page,$size);

            $data = tennant_member::select(
                'tennant_members.*',

                DB::raw('(
                    SELECT GROUP_CONCAT(stores.store_name)
                    FROM stores
                    WHERE stores.tennant_member_id = tennant_members.id
                    AND stores.is_delete = 0
                ) as store_list'),

            )
            ->join('admins','admins.id','tennant_members.user_edit')
            ->where([
                ['tennant_members.is_delete',0],
            ])
            ->whereRaw('(
                tennant_members.title_name LIKE "%' . $search . '%"
                OR tennant_members.name LIKE "%' . $search . '%"
                OR tennant_members.tel LIKE "%' . $search . '%"
                OR (
                    SELECT GROUP_CONCAT(stores.store_name)
                    FROM stores
                    WHERE stores.tennant_member_id = tennant_members.id
                    AND stores.is_delete = 0
                ) LIKE "%' . $search . '%"
                OR tennant_members.tennant_code LIKE "%' . $search . '%"

            )')
            ->offset($offset)
            ->limit($size)
            ->get();

            $count = tennant_member::select('*')
            ->whereRaw('(
                tennant_members.title_name LIKE "%' . $search . '%"
                OR tennant_members.name LIKE "%' . $search . '%"
                OR tennant_members.tel LIKE "%' . $search . '%"
                OR (
                    SELECT GROUP_CONCAT(stores.store_name)
                    FROM stores
                    WHERE stores.tennant_member_id = tennant_members.id
                    AND stores.is_delete = 0
                ) LIKE "%' . $search . '%"
                OR tennant_members.tennant_code LIKE "%' . $search . '%"
            )')
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

                $data = $request->all();

                $code = IdGenerator::generate(
                    [
                        'table' => 'tennant_members',
                        'field' => 'tennant_code',
                        'prefix' => 'R-',
                        'reset_on_prefix_change' => 'false',
                        'length' => 6,
                    ]
                );

                $data['tennant_code'] = $code;
                $data['user_edit'] = auth()->user()->id;
                $create = tennant_member::create($data);

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


            $data = tennant_member::select(
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

    public function getDetail($id){
        try{

            $data = tennant_member::select(
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
                $data['user_edit'] = auth()->user()->id;
                $create = tennant_member::where('id',$request->id)->update($data);

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

            $update = tennant_member::where('id',$id)->update(['status'=>request()->status,'user_edit'=>auth()->user()->id]);

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
            $update = tennant_member::where('id',$id)->update(['is_delete'=> 1,'user_edit'=>auth()->user()->id ]);
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


    public function getListToSelectBox(){
        try{
            $data = tennant_member::select(
                'tennant_members.id',
                'tennant_members.title_name',
                'tennant_members.name',
                'tennant_members.personal_id',
                'tennant_members.tel',
                'tennant_members.address',
            )
            ->join('admins','admins.id','tennant_members.user_edit')
            ->where([
                ['tennant_members.is_delete',0],
                ['tennant_members.status',1],
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

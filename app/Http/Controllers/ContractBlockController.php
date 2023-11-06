<?php

namespace App\Http\Controllers;

use App\Models\block;
use App\Models\contract_block;
use App\Models\contract_block_list;
use App\Models\contract_block_list_delete;
use App\Models\contract_block_slip_list;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;


class ContractBlockController extends Controller
{
    //

    public function getList(){
        try{

            $page = request()->page ? request()->page : 1;
            $size = request()->size ? request()->size : 100;
            $search = request()->search ? request()->search : "";
            $offset = $this->calSkip($page,$size);

            if(request()->type == 0){
                $status =  [0];
                $count_quatation = contract_block::where([['is_delete',0],['doc_type',0]])->count();
                $count_renting = contract_block::where([['is_delete',0],['doc_type',1],['status',0]])->count();
                $count_pay = contract_block::where([['is_delete',0],['doc_type',2]])->count();
            }else{
                $status =  [1,2];
                $count_quatation = 0;
                $count_renting = 0;
                $count_pay = 0;
            }

            $data = contract_block::select(
                'contract_blocks.id',
                'contract_blocks.doc_code',
                'contract_blocks.tennant_name as name',
                'contract_blocks.tel',
                // DB::raw('SUBSTRING(block_list_id, 2, LENGTH(block_list_id) - 2) AS block_list_id'),
                DB::raw('(
                    SELECT GROUP_CONCAT(contract_block_lists.block_name)
                    FROM contract_block_lists
                    WHERE contract_block_lists.contract_block_id = contract_blocks.id
                    AND contract_block_lists.is_delete = 0
                ) as block_list_id'),
                // 'contract_blocks.block_list_id',
                'contract_blocks.date_start',
                'contract_blocks.date_end',
                'contract_blocks.doc_type',
                'contract_blocks.date_confirm',
                'contract_blocks.status',
                'contract_blocks.is_delete',
                'contract_blocks.total'

            )
            ->leftjoin('tennant_members','tennant_members.id','contract_blocks.tennant_member_id')
            ->whereIn('contract_blocks.status',$status)
            ->whereRaw('(
                CASE
                    WHEN contract_blocks.doc_type = 0 THEN
                        contract_blocks.is_delete = 0 AND
                        (
                            contract_blocks.doc_code LIKE "%' . $search . '%"
                            OR tennant_members.name LIKE "%' . $search . '%"
                            OR contract_blocks.tel LIKE "%' . $search . '%"
                            OR (
                                SELECT GROUP_CONCAT(contract_block_lists.block_name)
                                FROM contract_block_lists
                                WHERE contract_block_lists.contract_block_id = contract_blocks.id
                                AND contract_block_lists.is_delete = 0
                            ) LIKE "%' . $search . '%"
                        )
                    ELSE
                        (
                            contract_blocks.doc_code LIKE "%' . $search . '%"
                            OR tennant_members.name LIKE "%' . $search . '%"
                            OR contract_blocks.tel LIKE "%' . $search . '%"
                            OR (
                                SELECT GROUP_CONCAT(contract_block_lists.block_name)
                                FROM contract_block_lists
                                WHERE contract_block_lists.contract_block_id = contract_blocks.id
                                AND contract_block_lists.is_delete = 0
                            ) LIKE "%' . $search . '%"
                        )
                END
            )')
            ->offset($offset)
            ->limit($size)
            ->get();

            $count = contract_block::select('*')
            ->leftjoin('tennant_members','tennant_members.id','contract_blocks.tennant_member_id')
            ->whereIn('contract_blocks.status',$status)
            ->whereRaw('(
                CASE
                    WHEN contract_blocks.doc_type = 0 THEN
                        contract_blocks.is_delete = 0 AND
                        (
                            contract_blocks.doc_code LIKE "%' . $search . '%"
                            OR tennant_members.name LIKE "%' . $search . '%"
                            OR contract_blocks.tel LIKE "%' . $search . '%"
                            OR (
                                SELECT GROUP_CONCAT(contract_block_lists.block_name)
                                FROM contract_block_lists
                                WHERE contract_block_lists.contract_block_id = contract_blocks.id
                                AND contract_block_lists.is_delete = 0
                            ) LIKE "%' . $search . '%"
                        )
                    ELSE
                        (
                            contract_blocks.doc_code LIKE "%' . $search . '%"
                            OR tennant_members.name LIKE "%' . $search . '%"
                            OR contract_blocks.tel LIKE "%' . $search . '%"
                            OR (
                                SELECT GROUP_CONCAT(contract_block_lists.block_name)
                                FROM contract_block_lists
                                WHERE contract_block_lists.contract_block_id = contract_blocks.id
                                AND contract_block_lists.is_delete = 0
                            ) LIKE "%' . $search . '%"
                        )
                END
            )')
            ->get()
            ->count();

            return response()->json([
                'success' => true,
                'data' => $data,
                'current_page'=> $page,
                'pages'=> $this->calPage($count, $size),
                'count_all' => $count,
                'count_quatation' => $count_quatation,
                'count_renting' => $count_renting,
                'count_pay' => $count_pay,
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

                $data = $request->contract_data;

                $code = IdGenerator::generate(
                    [
                        'table' => 'contract_blocks',
                        'field' => 'doc_code',
                        'prefix' => 'CT-',
                        'reset_on_prefix_change' => 'false',
                        'length' => 7,
                    ]
                );
                $data['user_edit'] = auth()->user()->id;
                $data['doc_code'] = $code;
                $create = contract_block::create($data);
                foreach($request->block_list as $block_list){
                    $block_list['contract_block_id'] = $create->id;
                    contract_block_list::create($block_list);
                }
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
            // $date = Carbon::parse('2023-10-28');
            // dd($date->dayOfWeek);

            $data = contract_block::select(
                '*'
            )
            ->where([
                ['id',$id]
            ])
            ->first();

            $data['block_list'] = contract_block_list::select(
                'contract_block_lists.*',
                DB::raw('
                    (CASE
                        WHEN contract_blocks.doc_type = 0 THEN
                            blocks.block_name
                        ELSE
                            contract_block_lists.block_name
                    END)
                as block_name'),
                DB::raw('
                    (CASE
                        WHEN contract_blocks.doc_type = 0 THEN
                            stalls.name
                        ELSE
                            contract_block_lists.stall_size_name
                    END)
                as stall_size_name'),
                DB::raw('
                    (CASE
                        WHEN contract_blocks.doc_type = 0 THEN
                            stalls.annual_fee
                        ELSE
                            contract_block_lists.annual_fee
                    END)
                as annual_fee'),
                DB::raw('
                    (CASE
                        WHEN contract_blocks.doc_type = 0 THEN
                            stalls.guarantee_service_rate
                        ELSE
                            contract_block_lists.insurance_cost
                    END)
                as insurance_cost'),
                DB::raw('
                    (CASE
                        WHEN contract_blocks.doc_type = 0 THEN
                            stalls.guarantee_water_rate
                        ELSE
                            contract_block_lists.guarantee_water_rate
                    END)
                as guarantee_water_rate'),
                DB::raw('
                    (CASE
                        WHEN contract_blocks.doc_type = 0 THEN
                            stalls.guarantee_electricity_rate
                        ELSE
                            contract_block_lists.guarantee_electricity_rate
                    END)
                as guarantee_electricity_rate'),
                DB::raw('
                    (CASE
                        WHEN contract_blocks.doc_type = 0 THEN
                            stalls.guarantee_hood_rate
                        ELSE
                            contract_block_lists.guarantee_hood_rate
                    END)
                as guarantee_hood_rate'),
                DB::raw('
                    (CASE
                        WHEN contract_blocks.doc_type = 0 THEN
                            stalls.cost_rental_rate
                        ELSE
                            contract_block_lists.rent_cost
                    END)
                as rent_cost'),
                DB::raw('
                    (CASE
                        WHEN contract_blocks.doc_type = 0 THEN
                            stalls.cost_common_rate
                        ELSE
                            contract_block_lists.common_fee
                    END)
                as common_fee'),
            )
            ->join('contract_blocks','contract_blocks.id','contract_block_lists.contract_block_id')
            ->leftjoin('blocks','blocks.id','contract_block_lists.block_id')
            ->leftjoin('stalls','stalls.id','contract_block_lists.stall_size_id')
            ->where([
                ['contract_block_lists.is_delete',0],
                ['contract_block_lists.contract_block_id',$id]
            ])
            ->get();


            $data['slip_list'] = contract_block_slip_list::select(
                'id',
                'slip_path',
                'created_at'
            )
            ->where('contract_block_id',$id)
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

    public function confirmContract($id){
        try{
            DB::beginTransaction();
                $contract = contract_block::select('tennant_member_id','old_contract_id')->where('id',$id)->first();

                //กรณีเป็นการต่อสัญญาจากฉบับเก่า ต้องล้าง แผงที่เช่าทั้งหมดก่อน แล้ว ค่อยเช่าแผงใหม่
                    if($contract->old_contract_id){
                        $block_lists = contract_block_list::select('block_id')->where([['contract_block_id',$contract->old_contract_id],['is_delete',0]])->get();
                        foreach($block_lists as $block_list){
                            block::where('id',$block_list->block_id)->update(['tennant_member_id'=>NULL,'status'=>0]);
                        }
                        contract_block::where('id',$contract->old_contract_id)->update(['status'=>2]);
                    }
                //

                $block_lists = contract_block_list::select('block_id')->where([['contract_block_id',$id],['is_delete',0]])->get();
                foreach($block_lists as $block_list){
                    block::where('id',$block_list->block_id)->update(['tennant_member_id'=>$contract->tennant_member_id,'status'=>1]);
                }
                contract_block::where('id',$id)->update(['doc_type'=>'1','date_confirm'=>Carbon::now()]);

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

    public function update(Request $request){
        try{
            DB::beginTransaction();

                $data = $request->contract_data;
                $data['user_edit'] = auth()->user()->id;
                unset($data['pic']);
                if ($request->hasFile('slip')) {
                    $pic_from_request = $request->file('product_3_pic');
                    $picture = time() . $pic_from_request->getClientOriginalName();
                    $path = 'upload/images/contract/block/slip/' . $picture;

                    $directory = public_path('upload/images/contract/block/slip');
                    if (!File::exists($directory)) {
                        File::makeDirectory($directory, 0775, true);
                    }

                    Image::make($pic_from_request)->save(public_path($path));

                    $data['slip'] = $picture;
                    $data['slip_path'] = $path;
                }
                contract_block::where('id',$data['id'])->update($data);
                foreach($request->block_list as $block_list){
                    // dd($block_list,isset($block_list['id']));
                    if(isset($block_list['id'])){
                        if(isset($block_list['is_delete'])) {
                            if($block_list['is_delete'] ==1){
                                contract_block_list::where('id',$block_list['id'])->delete();
                                unset($block_list['is_delete']);
                                $block_list['contract_block_id'] = $data['id'];
                                contract_block_list_delete::create($block_list);
                            }
                            contract_block_list::where('id',$block_list['id'])->update($block_list);
                        }else{
                            contract_block_list::where('id',$block_list['id'])->update($block_list);
                        }
                    }else{
                        $block_list['contract_block_id'] = $data['id'];
                        contract_block_list::create($block_list);
                    }
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

    public function uploadSlip(Request $request){
        try{
            DB::beginTransaction();

            if($request->slip_list){
                foreach($request->slip_list as $key => $pic){
                    $pic_from_request = $pic;
                    $picture = time() . $pic_from_request->getClientOriginalName();
                    $path = 'upload/images/contract/block/slip/' . $picture;

                    $directory = public_path('upload/images/contract/block/slip');
                    if (!File::exists($directory)) {
                        File::makeDirectory($directory, 0775, true);
                    }

                    Image::make($pic_from_request)->save(public_path($path));

                    contract_block_slip_list::create([
                        'contract_block_id' => $request->id,
                        'slip' => $picture,
                        'slip_path' => $path
                    ]);
                }
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

    public function checkBlockGotBuyed($id){
        try{


            DB::beginTransaction();

                $contract_block_list = contract_block_list::select()->where([
                    ['is_delete',0],
                    ['contract_block_id',$id]
                ])->get();

                $arr = [];
                foreach($contract_block_list as $item){
                    $block = block::select(
                        '*',
                        DB::raw('(
                            CASE
                                    WHEN (
                                            SELECT contract_blocks.tennant_member_id
                                            FROM contract_block_lists
                                            JOIN contract_blocks ON contract_blocks.id = contract_block_lists.contract_block_id
                                            WHERE contract_block_lists.block_id = blocks.id
                                            AND contract_block_lists.is_delete = 0
                                            AND contract_blocks.doc_type = 2
                                            AND contract_blocks.is_delete = 0
                                            LIMIT 1
                                    ) IS NOT NULL THEN
                                        (
                                            SELECT contract_blocks.tennant_member_id FROM `contract_block_lists`
                                            JOIN contract_blocks ON contract_blocks.id = contract_block_lists.contract_block_id
                                            WHERE contract_block_lists.block_id = blocks.id
                                            AND contract_block_lists.is_delete = 0
                                            AND contract_blocks.doc_type = 2
                                            AND contract_blocks.is_delete = 0
                                            LIMIT 1
                                        )
                                    ELSE
                                            blocks.tennant_member_id
                            END
                        ) as tennant_member_id'),
                    )->where([
                        ['id',$item->block_id]
                    ])->first();

                    if($block->tennant_member_id != null){
                        array_push($arr, $block->block_name);
                        // contract_block_list::where('id',$item->id)->delete();

                        // $create = contract_block_list_delete::create([
                        //     "contract_block_id" => $item->contract_block_id,
                        //     "block_id" => $item->block_id,
                        //     "block_name" => $item->block_name,
                        //     "stall_size_id" => $item->stall_size_id,
                        //     "stall_size_name" => $item->stall_size_name,
                        //     "annual_fee" => $item->annual_fee,
                        //     "insurance_cost" => $item->insurance_cost,
                        //     "guarantee_water_rate" => $item->guarantee_water_rate,
                        //     "guarantee_electricity_rate" => $item->guarantee_electricity_rate,
                        //     "guarantee_hood_rate" => $item->guarantee_hood_rate,
                        //     "rent_cost" => $item->rent_cost,
                        //     "common_fee" => $item->common_fee,
                        // ]);

                        // dd($create);
                    }
                }

                $success = count($arr) > 0 ? false : true;
                // $status = count($arr) > 0 ? false : 200;

            DB::commit();
            return response()->json([
                'success' => $success,
                'message' => "get data success!",
                "data" => $arr
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

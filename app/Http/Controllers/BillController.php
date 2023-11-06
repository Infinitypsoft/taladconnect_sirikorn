<?php

namespace App\Http\Controllers;

use App\Models\bill;
use App\Models\bill_list;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;


class BillController extends Controller
{
    //
    public function getList()
    {
        try {

            $page = request()->page ? request()->page : 1;
            $size = request()->size ? request()->size : 10;
            $search = request()->search ? request()->search : "";

            $offset = $this->calSkip($page, $size);

            $data = bill::select(
                'bills.*',
                'admins.name as user_create_name'
            )
                ->join('admins', 'admins.id', 'bills.user_create')
                ->offset($offset)
                ->limit($size)
                ->get();

            $count = bill::select('*')
                ->get()
                ->count();

            return response()->json([
                'success' => true,
                'data' => $data,
                'current_page' => $page,
                'pages' => $this->calPage($count, $size),
                'count' => $count,
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

    public function getIdBill()
    {
        $currentYear = date('y'); // ดึงปีปัจจุบัน
        $currentMonth = date('m'); // ดึงเดือนปัจจุบัน

        // ดึงเลขลำดับของบิลสูงสุดในเดือนปัจจุบัน
        $lastBill = bill::where('bill_id', 'LIKE', "Bill-$currentYear$currentMonth%")
            ->orderBy('bill_id', 'desc')
            ->first();

        if ($lastBill) {
            // ถ้ามีบิลในเดือนปัจจุบันแล้ว
            $lastBillId = $lastBill->bill_id;
            $lastBillNumber = (int) substr($lastBillId, -3); // ดึงเลขลำดับของบิล
            $newBillNumber = $lastBillNumber + 1;

            // สร้างรหัสบิลใหม่
            $newBillId = "Bill-$currentYear" . "$currentMonth" . str_pad($newBillNumber, 3, '0', STR_PAD_LEFT);
        } else {
            // ถ้ายังไม่มีบิลในเดือนปัจจุบัน
            $newBillId = "Bill-$currentYear" . "$currentMonth" . "001";
        }
        return response()->json([
            'success' => true,
            'bill_id' => $newBillId,
            'message' => "get data success!"
        ], 200);
    }


    public function create(Request $request)
    {
        try {
            DB::beginTransaction();

            $validator = Validator::make($request->all(), [
                'date_receipt_money' => 'required|date|date_format:Y-m-d',
                'customer_name' => 'string|max:255',
                // 'tel' => 'string|max:10',
                // 'address' => 'string',
                'payee_name' => 'string|max:255',
                'total_price' => 'numeric|min:0',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validator->errors()
                ]);
            }

            $currentYear = date('y'); // ดึงปีปัจจุบัน
            $currentMonth = date('m'); // ดึงเดือนปัจจุบัน

            // ดึงเลขลำดับของบิลสูงสุดในเดือนปัจจุบัน
            $lastBill = bill::where('bill_id', 'LIKE', "Bill-$currentYear$currentMonth%")
                ->orderBy('bill_id', 'desc')
                ->first();

            if ($lastBill) {
                // ถ้ามีบิลในเดือนปัจจุบันแล้ว
                $lastBillId = $lastBill->bill_id;
                $lastBillNumber = (int) substr($lastBillId, -3); // ดึงเลขลำดับของบิล
                $newBillNumber = $lastBillNumber + 1;

                // สร้างรหัสบิลใหม่
                $newBillId = "Bill-$currentYear" . "$currentMonth" . str_pad($newBillNumber, 3, '0', STR_PAD_LEFT);
            } else {
                // ถ้ายังไม่มีบิลในเดือนปัจจุบัน
                $newBillId = "Bill-$currentYear" . "$currentMonth" . "001";
            }

            // dd($newBillId);

            $data = $request->all();

            $bill['bill_id'] = $newBillId;
            $bill['date_receipt_money'] = $data['date_receipt_money'];
            $bill['customer_name'] = $data['customer_name'];
            // $bill['tel'] = $data['tel'];
            // $bill['address'] = $data['address'];
            $bill['payee_name'] = $data['payee_name'];
            $bill['total_price'] = $data['total_price'];

            $bill['tax_status'] = $data['tax_status'];
            $bill['tax_cost'] = $data['tax_cost'];
            $bill['vat_cost'] = $data['vat_cost'];

            $bill['user_edit'] = auth()->user()->id;
            $create = bill::create($bill);

            $billLists = json_decode($data['bill_lists'], true);
            // dd($billLists);
            foreach ($billLists as $billListData) {
                if ($billListData['list_name'] !== null && $billListData['price_unit'] !== null && $billListData['num'] !== null) {
                    $billListData['bill_id'] = $create->id;
                    bill_list::create($billListData);
                }
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

    public function getById($id)
    {
        try {

            $data = bill::select(
                'bills.*',
            )
                ->join('bill_lists', 'bill_lists.bill_id', 'bills.id')
                ->where([
                    ['bills.id', $id]
                ])
                ->first();

            $data_bill_list = bill_list::select(
                'bill_lists.*',
            )
                ->where([
                    ['bill_lists.bill_id', $id]
                ])
                ->get();

            return response()->json([
                'success' => true,
                'message' => "get data success!",
                'data' => $data,
                'data_bill_list' => $data_bill_list
            ], 200);
        } catch (\Throwable $th) {
            // throw $th;
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function getDetail($id)
    {
        try {

            $admin = bill::select(
                '*'
            )
                ->where([
                    ['id', $id]
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

    public function update(Request $request)
    {
        try {
            DB::beginTransaction();

            $validator = Validator::make($request->all(), [
                'date_receipt_money' => 'required|date|date_format:Y-m-d',
                'customer_name' => 'string|max:255',
                // 'tel' => 'string|max:10',
                // 'address' => 'string',
                'payee_name' => 'string|max:255',
                'total_price' => 'numeric|min:0',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validator->errors()
                ]);
            }

            $data = $request->all();

            $bill['date_receipt_money'] = $data['date_receipt_money'];
            $bill['customer_name'] = $data['customer_name'];
            $bill['tel'] = $data['tel'];
            $bill['address'] = $data['address'];
            $bill['payee_name'] = $data['payee_name'];
            $bill['total_price'] = $data['total_price'];

            $bill['user_edit'] = auth()->user()->id;
            $create = bill::where('id', $request->id)->update($bill);

            $billLists = json_decode($data['bill_lists'], true);
            foreach ($billLists as $billListData) {
                $billListId = $billListData['id'];
                if($billListId === null){
                    $billListData['bill_id'] = $request->id;
                    bill_list::create($billListData);
                }else{
                    unset($billListData['id']);
                    bill_list::where('id', $billListId)->update($billListData);
                }
            }

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

    public function updateStatus($id)
    {
        try {
            DB::beginTransaction();

            $update = bill::where('id', $id)->update(['status' => request()->status, 'user_edit' => auth()->user()->id]);

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

    public function delete($id)
    {
        try {
            DB::beginTransaction();
            $update = bill::where('id', $id)->update(['is_delete' => 1, 'user_edit' => auth()->user()->id]);
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

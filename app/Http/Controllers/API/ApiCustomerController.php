<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiCustomerController extends Controller
{
    //create
    public function create(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'contact' => 'required|numeric|digits_between:9,15',
            'email' => 'required|string|max:255|email',
            'username' => 'required|max:255',
            'gender' => 'required|max:255',
            'nationality' => 'required|max:255',
        ]);

        if($validator->fails()){
            return response()->json([
                'message' => 'Validation Errors',
                'errors' => $validator->messages()
            ], 422);
        }

        $customer = Customer::create([

            'user_id' => $request->user()->id,
            'name' => $request->name,
            'contact' => $request->contact,
            'email' => $request->email,
            'username' => $request->username,
            'gender' => $request->gender,
            'nationality' => $request->nationality

        ]);

        $customer->load('user');        
        return response()->json([
            'message' => 'Customer successfully created!',
            'data' => $customer
        ], 200);
    }

    //API Get list
    public function list(Request $request)
    {
        $customer_query = Customer::with('user');

        if($request->keyword){
            $customer_query->where('name', 'LIKE', '%'.$request->keyword.'%')
                ->orWhere('contact', 'LIKE', '%'.$request->keyword.'%')
                ->orWhere('email', 'LIKE', '%'.$request->keyword.'%')
                ->orWhere('username', 'LIKE', '%'.$request->keyword.'%')
                ->orWhere('gender', 'LIKE', '%'.$request->keyword.'%')
                ->orWhere('nationality', 'LIKE', '%'.$request->keyword.'%');
            
        }

        if($request->user_id){
            $customer_query->where('user_id', $request->user_id);
        }

        if($request->sortBy && in_array($request->sortBy, ['id', 'created_at'])){
            $sortBy = $request -> sortBy;
        }else{
            $sortBy = 'id';
        }

        if($request->sortOrder && in_array($request->sortOrder, ['asc', 'desc'])){
            $sortOrder = $request -> sortOrder;
        }else{
            $sortOrder = 'desc';
        }
        if($request->perPage){
            $perPage = $request -> perPage;
        }else{
            $perPage = 5;
        }

        if($request->paginate){
            $customer_list = $customer_query->orderBY($sortBy, $sortOrder)->paginate($perPage);
        }else{
            $customer_list = $customer_query->orderBY($sortBy, $sortOrder)->get();
        }
        
        return response()->json([
            'message' => 'Customer successfully fetched!',
            'data' => $customer_list
        ], 200);
    }

    //Get Detail
    public function detail($id)
    {
        $customer = Customer::with(['user'])->where('id', $id)->first();

        if($customer){
            return response()->json([
                'message' => 'Customer successfully fetched!',
                'data' => $customer
            ], 200);
        } else {
            return response()->json([
                'message' => 'No Data found',

            ], 404);
        }
    }
}

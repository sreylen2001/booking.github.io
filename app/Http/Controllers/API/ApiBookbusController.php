<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\Validator;

class ApiBookbusController extends Controller
{
    //create
    public function create(Request $request){
        $validator = Validator::make($request->all(), [
            'schedule_id' => 'required|max:255',
            'number_of_seats' => 'required|max:255',
            'fare_amount' => 'required|max:255',
            'total_amount' => 'required|max:255'
            
        ]);

        if($validator->fails()){
            return response()->json([
                'message' => 'Validation Errors',
                'errors' => $validator->messages()
            ], 422);
        }

        $booking = Booking::create([

            'user_id' => $request->user()->id,
            'schedule_id' => $request->schedule_id,
            'customer_id' => $request->user()->id,
            'number_of_seats' => $request->number_of_seats,
            'fare_amount' => $request->fare_amount,
            'total_amount' => $request->total_amount

        ]);

        $booking->load('user');        
        return response()->json([
            'message' => 'Booking successfully created!',
            'data' => $booking
        ], 200);
    }

    //API Get list
    public function list(Request $request)
    {
        $booking_query = Booking::with('user');

        if($request->keyword){
            $booking_query->where('schedule_id', 'LIKE', '%'.$request->keyword.'%')
            ->orWhere('customer_id', 'LIKE', '%'.$request->keyword.'%')
            ->orWhere('number_of_seats', 'LIKE', '%'.$request->keyword.'%')
            ->orWhere('fare_amount', 'LIKE', '%'.$request->keyword.'%')
            ->orWhere('total_amount', 'LIKE', '%'.$request->keyword.'%');
            
        }
        
        if($request->user_id){
            $booking_query->where('user_id', $request->user_id);
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
            $bus_list = $booking_query->orderBY($sortBy, $sortOrder)->paginate($perPage);
        }else{
            $bus_list = $booking_query->orderBY($sortBy, $sortOrder)->get();
        }
        
        return response()->json([
            'message' => 'Booking successfully fetched!',
            'data' => $bus_list
        ], 200);
    }

    //Get Detail
    public function detail($id)
    {
        $bus = Booking::with(['user'])->where('id', $id)->first();

        if($bus){
            return response()->json([
                'message' => 'Booking successfully fetched!',
                'data' => $bus
            ], 200);
        } else {
            return response()->json([
                'message' => 'No Data found',

            ], 404);
        }
    }
}

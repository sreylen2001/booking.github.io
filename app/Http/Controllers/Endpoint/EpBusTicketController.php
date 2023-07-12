<?php

namespace App\Http\Controllers\Endpoint;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Models\BusTicket;
use Illuminate\Support\Facades\Validator;

class EpBusTicketController extends Controller
{
     //create
     public function create(Request $request){
        $validator = Validator::make($request->all(), [
            'bus_id' => 'required',
            'from' => 'required|string|max:255',
            'to' => 'required|string|max:255',
            'fare_amount' => 'required|int|max:255',
            'departure_time' => 'required',
            'estimated_arrival_time' => 'max:255'
        ]);

        if($validator->fails()){
            return response()->json([
                'message' => 'Validation Errors',
                'errors' => $validator->messages()
            ], 422);
        }
        
        $busticket = BusTicket::create([
            'bus_id' => $request->bus_id,
            'from' => $request->from,
            'to' => $request->to,
            'fare_amount' => $request->fare_amount,
            'departure_time' => $request->departure_time,
            'estimated_arrival_time' => $request->estimated_arrival_time
        ]);

        return response()->json([
            'message' => 'Bus Ticket successfully created!',
            'data' => $busticket
        ], 200);
    }

    //API Get list
    public function list(Request $request)
    {
        $bus_query = BusTicket::with('bus');

        if($request->keyword){
            $bus_query->where('from', 'LIKE', '%'.$request->keyword.'%')
            ->orWhere('to', 'LIKE', '%'.$request->keyword.'%')
            ->orWhere('	fare_amount', 'LIKE', '%'.$request->keyword.'%')
            ->orWhere('departure_time', 'LIKE', '%'.$request->keyword.'%')
            ->orWhere('estimated_arrival_time', 'LIKE', '%'.$request->keyword.'%');
            
        }
        
        if($request->bus_id){
            $bus_query->where('bus_id', $request->bus_id);
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
            $bus_list = $bus_query->orderBY($sortBy, $sortOrder)->paginate($perPage);
        }else{
            $bus_list = $bus_query->orderBY($sortBy, $sortOrder)->get();
        }
        
        return response()->json([
            'message' => 'Bus Ticket successfully fetched!',
            'data' => $bus_list
        ], 200);
    }

    //Get Detail
    public function detail($id)
    {
        $data['new_bus_tickets'] = DB::table('new_bus_tickets')->where('id', $id)->first();
        if($data){
            return response()->json([
                'message' => 'Bus Ticket successfully fetched!',
                'data' => $data
            ], 200);
        } else {
            return response()->json([
                'message' => 'No Data found',

            ], 404);
        }
    }
}

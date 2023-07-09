<?php

namespace App\Http\Controllers\Endpoint;

use App\Http\Controllers\Controller;
use App\Models\Models\Booking;
use App\Models\Models\Bus;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class EpBusController extends Controller
{
    //create
    public function create(Request $request){
        $validator = Validator::make($request->all(), [
            'plate_number' => 'required|string|max:255',
            'bus_type' => 'required|string|max:255',
            'capacity' => 'required|int|max:255',
            'status' => 'boolean'
            
        ]);

        if($validator->fails()){
            return response()->json([
                'message' => 'Validation Errors',
                'errors' => $validator->messages()
            ], 422);
        }

        $bus = Bus::create([
            'user_id' => auth()->id(),
            //'user_id' => $request->users()->id,
            'plate_number' => $request->plate_number,
            'bus_type' => $request->bus_type,
            'capacity' => $request->capacity,
            'book_seat'=> $request->book_seat,
            'status' => $request->status,
        ]);

        $bus->load('user');        
        return response()->json([
            'message' => 'Bus successfully created!',
            'data' => $bus
        ], 200);
    }

    //API Get list
    public function list(Request $request)
    {
        $bus_query = Bus::with('user');

        if($request->keyword){
            $bus_query->where('plate_number', 'LIKE', '%'.$request->keyword.'%')
            ->orWhere('bus_type', 'LIKE', '%'.$request->keyword.'%')
            ->orWhere('capacity', 'LIKE', '%'.$request->keyword.'%')
            ->orWhere('bus_status', 'LIKE', '%'.$request->keyword.'%');
            
        }
        
        if($request->user_id){
            $bus_query->where('user_id', $request->user_id);
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
            'message' => 'Bus successfully fetched!',
            'data' => $bus_list
        ], 200);
    }

    //Get Detail
    public function detail($id)
    {
        $data = Bus::query()->findOrFail($id);
        $data['book_seat'] = $this->generateBusSeat($id);
        if($data){
            return response()->json([
                'message' => 'Bus successfully fetched!',
                'data' => $data
            ], 200);
        } else {
            return response()->json([
                'message' => 'No Data found',

            ], 404);
        }
    }

    public function busAllAvailable(): JsonResponse
    {
        $today = now()->setTime(0,0,0,0);
        $buses = Bus::query()->where('created_at', '>=', $today)->get();
        $busAvailable = collect();
        foreach ($buses as $bus) {
            $booking = Booking::query()->where('bus_id', $bus['id'])->where('created_at', '>=', $today)->get()->toArray();
            if(count($booking) < $bus['capacity']) {
                $busAvailable->push($bus);
            }
        }
        return $this->success($busAvailable, 'Get Bus Available');
    }

    public function generateBusSeat($busID): Collection
    {
        $bus = Bus::query()->findOrFail($busID)->first();
        $today = now()->setTime(0,0,0,0);
        $bus_seats = collect();
        $booking = Booking::query()->where('bus_id', $busID)->where('created_at', '>=', $today)->get()->toArray();
        $test = count($booking);
        if($bus['capacity'] > 0) {
            for($i = 0; $i < $bus['capacity']; $i++) {

                if(count($booking) > 0) {
                    $is_true = false;
                    foreach ($booking as $book) {
                        if($book['number_of_seats'] === ($i + 1)) {
                            $bus_seats->push([
                                'bus_seat' => $i + 1,
                                'status' => true
                            ]);
                            $is_true = true;
                            break;
                        }
                    }

                    if(!$is_true) {
                        $bus_seats->push([
                            'bus_seat' => $i + 1,
                            'status' => false
                        ]);
                    }

                } else {
                    $bus_seats->push([
                        'bus_seat' => $i + 1,
                        'status' => false
                    ]);
                }
            }
        }

        return $bus_seats;
    }
}

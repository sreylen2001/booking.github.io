<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Models\Bus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Models\User;
use App\Models\Models\Booking;
use Illuminate\Support\Facades\Validator;

class BookticketController extends Controller
{
    public function index(){

        $data['new_buses'] = DB::table('new_buses')->get();
        // $data['new_payments'] = DB::table('new_payments')
        // ->where('payment_amount')
        // ->orWhere('payment_by')
        // ->get()->toArray();
        //dd($data['new_payments']);
        $data['new_bookings'] = DB::table('new_bookings')->paginate(5);
        return view('admins.user_bookings.index', $data);
        
    }
     /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

     public function validate_create(array $data){
        return Validator::make($data, [
            'number_of_seats' => 'required',
            'bus_id' => 'required',
            'total_amount' => 'required',
            'payment_amount' => 'required',
            'payment_by' => 'required',
        ]);
    }


    public function create(){
        $data['new_buses'] = DB::table('new_buses')->get();
        $data['new_bus_tickets'] = DB::table('new_bus_tickets')->get();

        $data['new_bookings'] = DB::table('new_bookings')->get();
        return view('admins.user_bookings.create', $data);
    }

    public function save(Request $request){

        $select = DB::table('new_bus_tickets')
        ->select('fare_amount')->get();

        //dd($select);

        $data['id'] = $request->id;
        $data['user_id'] = auth()->id();
        $data['bus_id'] = $request->bus_id;
        $data['number_of_seats'] = $request->number_of_seats;
        $number = $data['number_of_seats'];
        $data['total_amount'] = $number * $select;
        
        $data['status'] = 1;
        $i = DB::table('new_bookings')->insert($data);

        if($i){
            return redirect()->route('user_booking.create');
        }else{
            return redirect()->route('admin.user_bookinge');
        }
    }

   /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\Models\Booking
     */
    public function booking(array $data)
    {
        $amount = $data['total_amount'] / count($data['number_of_seats']);
        foreach ($data['number_of_seats'] as $item) {
            Booking::create([
                'user_id' => Auth::id(),
                'bus_id' => $data['bus_id'],
                'number_of_seats' => $item,
                'total_amount' => $data['total_amount'],
                'payment_amount'=> $data['payment_amount'],
                'payment_by' => $data['payment_by'],
                'status' => true,
            ]);
        }
        $bus = Bus::query()->findOrFail($data['bus_id']);
        $bus->update([
            'book_seat' => $bus['book_seat'] + count($data['number_of_seats'])
        ]);
        $booking = Booking::query()->where('user_id', Auth::id())->where('bus_id', $data['bus_id'])->get();

        if ($booking->save()){

        }
        
    }
   
   
    public function booking_save(array $data){
    
        

    }
}

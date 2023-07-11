<?php

namespace App\Http\Controllers\Endpoint;

use App\Http\Controllers\Controller;
use App\Models\Models\Booking;
use App\Models\Models\Bus;
use App\Models\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EpBookingController extends Controller
{
    /*
     * get booking using Token
     */
    public function getBookingHistory(): JsonResponse
    {
        $today = now();
        $userID = Auth::id();
        $booking = Booking::query()->where('user_id', $userID)->get();

        $bookings = collect();
        foreach ($booking as $book) {
            $bookings->push($this->bookingDetail($book));
        }
//        dd($booking);

        return $this->success($bookings, 'Get Booking history');
    }

    private function bookingDetail(Booking $booking): array
    {
        $user = User::query()->findOrFail($booking['user_id'])->toArray();
        $bus = Bus::query()->findOrFail($booking['bus_id']);
        if($bus) {
            $buses = (new EpBusController())->busFormat($bus);
        } else {
            $buses = [];
        }

        return [
            'id' => $booking['id'],
            'user_id' => $user,
            'bus_id' => $buses,
            'number_of_seats' => $booking['number_of_seats'],
            'total_amount' => $booking['total_amount'],
            'payment_amount' => $booking['payment_amount'],
            'payment_by' => $booking['payment_by'],
            'status' => $booking['status'],
            'created_at' => $booking['created_at'],
            'update_at' => $booking['update_at']
        ];

    }

    public function getAllUserBookingHistory(): JsonResponse
    {

        $booking = Booking::query()->get();

        return $this->success($booking, 'Get Booking history');
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function booking(Request $request): JsonResponse
    {
        $data = $request->validate([
            'number_of_seats' => 'required',
            'bus_id' => 'required',
            'total_amount' => 'required',
            'payment_amount' => 'required',
            'payment_by' => 'required',
        ]);
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
        return $this->success($booking, 'Booking successfully');
    }
}

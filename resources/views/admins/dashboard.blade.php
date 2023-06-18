@extends('layouts.master')

@section('content')
<div class="content-body">
    <!-- row -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                <div class="row">
                    <div class="col-xl-6">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card tryal-gradient">
                                    <div class="card-body tryal row">
                                        <div class="col-xl-7 col-sm-6">
                                            <h2>iBooking</h2>
                                            <span>The world is a book and those who do not travel read only one page.</span>
                                        </div>
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="col-xl-6">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="row">
                                    <div class="col-xl-6 col-sm-6">
                                        <div class="card">
                                            <div class="card-body d-flex px-4 pb-0 justify-content-between">
                                                <div>
                                            
                                                    <h4 class="fs-18 font-w600 mb-4 text-nowrap">Total Customers</h4>
                                                    <div class="d-flex align-items-center">
                                                        <h2 class="fs-32 font-w700 mb-0" style="color:#886CC0">{{ $customers }}</h2>
                                                        {{-- <span class="d-block ms-4">
                                                            <i class="fas fa-user-clock"></i>
                                                        </span> --}}
                                                    </div>
                                                   
                                                </div>
                                                <div><i class="fas fa-user-clock"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-xl-6 col-sm-6">
                                        <div class="card">
                                            <div class="card-body d-flex px-4 pb-0 justify-content-between">
                                                <div>
                                                    <h4 class="fs-18 font-w600 mb-4 text-nowrap">Total Booking</h4>
                                                    <div class="d-flex align-items-center">
                                                        <h2 class="fs-32 font-w700 mb-0" style="color:#FF86B1">{{ $booking_cars }}</h2>
                                                    </div>
                                                </div>
                                                <div><i class="fas fa-address-book"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

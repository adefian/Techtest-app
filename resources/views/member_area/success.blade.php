@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center"> 
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3>Success!</h3>
                </div>

                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h5>Order no. </h5>
                        <h5>{{$order->no_order}} </h5>
                    </div>
                    <div class="d-flex justify-content-between mb-4">
                        <h5>Total</h5>
                        <h5>Rp. {{$total}} </h5>
                    </div>

                    @if(session('action'))
                        <p>
                            {{session('action')}}
                        </p>
                    @endif

                    <div class="form-group row mt-4">
                        <div class="col-md-12 ">
                            <a href="{{ route('payment') }}">
                                <button type="submit" class="btn btn-primary btn-block">
                                    Pay now
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
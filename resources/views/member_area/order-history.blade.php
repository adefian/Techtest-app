@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center"> 
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3>Order History</h3>
                </div>

                <div class="card-body">
                <form method="POST" action="">
                        @csrf

                        <div class="form-group row">
                            <label for="order" class="col-md-4 col-form-label text-md-right">Order no.</label>

                            <div class="col-md-6">
                                <input id="order" type="text" class="form-control @error('order') is-invalid @enderror" name="order" value="{{ old('order') }}"  autocomplete="order" placeholder="Order no." autofocus>
                                @error('order')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>  
                        </div>

                    </form>

                    @foreach($data as $datas)
                        <div class="d-flex justify-content-between">
                            
                            <div class="d-flex justify-content-between">
                                <h5>{{$datas->id}}</h5>
                            </div>
                            <div class="d-flex justify-content-between">
                                @if($datas->product_id)
                                    <h5>Rp. {{$datas->product->price}}</h5>
                                @else
                                    <h5>Rp. {{$datas->balance->value}}</h5>
                                @endif
                            </div>
                            <div class="d-flex justify-content-between">
                                @if($datas->status == 0 )
                                <a href="{{route('payment')}}">
                                    <button type="submit" class="btn btn-primary">Pay</button>
                                </a>
                                @elseif($datas->status == 1)
                                <h5 class="text-success">Success</h5>
                                @elseif($datas->status == 2)
                                <h5 class="text-warning">Failed</h5>
                                @elseif($datas->status == 3)
                                <h5 class="text-danger">Canceled</h5>
                                @elseif($datas->status == 4)
                                <h5>Shipping Code <br> {{$datas->product->code}}</h5>
                                @endif
                            </div>
                        </div>
                        <div class="border-bottom mb-2">
                            @if($datas->product_id)
                                <p>{{$datas->product->product}} that costs {{$datas->product->price}} </p>
                            @else
                                <p>{{$datas->balance->value}} for {{$datas->balance->mobile_number}}</p>
                            @endif
                        </div>
                    @endforeach


                </div>
                    {{ $data->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

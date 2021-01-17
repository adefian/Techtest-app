@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center"> 
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3>Pay your Order</h3>
                </div>

                <div class="card-body">
                <form method="POST" action="{{ route('payment.pay') }}">
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

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary btn-block">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </form>

                    @if(session('action'))
                        <p class="text-danger">
                            {{session('action')}}
                        </p>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

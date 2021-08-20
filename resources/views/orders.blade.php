@extends('layouts.app')

@section('header')
<title>{{ __('Orders Page') }}</title>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <ul class="checkout-box">
                        @foreach ($infoCheckout as $product)
                            <li>
                                <div class="checkout-i">
                                    <div>Date: {{ $product->create_data }}</div>
                                    <div>Customer: {{ $product->customer_name }}</div>
                                    <div>Adress: {{ $product->customer_adress }}</div>
                                    <div>Comments: {{ $product->customer_comment }}</div>
                                    <div>Total order:  $</div>
                                </div>
                                <div class="checkout-j">
                                    <a href="#" name='view'>{{ __('View') }}</a>
                                </div>
                            </li>
                        @endforeach  
                    </ul>    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
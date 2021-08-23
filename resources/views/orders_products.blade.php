@extends('layouts.app')

@section('header')
<title>{{ __('Products Order Page') }}</title>
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
                    <div class="full-section">
                        <div class="section-i">
                            <ul>
                                <li class="checkout-box">
                                    <div class="checkout-i">
                                        <div>{{ __('Date') }}: {{ $orderDetail->create_data }}</div>
                                        <div>{{ __('Customer') }}: {{ $orderDetail->customer_name }}</div>
                                        <div>{{ __('Adress') }}: {{ $orderDetail->customer_adress }}</div>
                                        <div>{{ __('Commnets') }}: {{ $orderDetail->customer_comment }}</div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="section-i">
                            @foreach ($orderProductInfo->flatMap->product as $product)
                            <div class="section-i-info">
                                <div class="section-x-info">
                                    <img src="http://localhost/cms2/public/image/{{ $product->image }}" alt="{{ __('image') }}">
                                </div>
                                <div class="section-x-info">
                                    <ul>
                                        <li>{{ __('Title') }}: {{ $product->title }}</li>
                                        <li>{{ __('Description') }}: {{ $product->description }}</li>
                                        <li>{{ __('Price') }}: {{ $product->pivot->price }}</li>
                                    </ul>
                                </div>
                            </div>
                            @endforeach
                        </div>    
                        <div class="section-i"><a href="{{ route('orders.index') }}">{{ __('Back') }}</a></div>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
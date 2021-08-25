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
                                    <div>{{ __('Date') }}: {{ $product['create_date'] }}</div>
                                    <div>{{ __('Customer') }}: {{ $product['customer_name'] }}</div>
                                    <div>{{ __('Adress') }}: {{ $product['customer_address'] }}</div>
                                    <div>{{ __('Comments') }}: {{ $product['customer_comment'] }}</div>
                                    <div>{{ __('Total order') }}: {{ array_sum(array_column($product['order_product'], 'price')) }} $</div>
                                </div>
                                <div class="checkout-j">
                                    <a href="{{ route('order.show', $product['id']) }}" name='view'>{{ __('View') }}</a>
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
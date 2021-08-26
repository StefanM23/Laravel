@extends('layouts.app')

@section('header')
<title>{{ __('Tag Page') }}</title>
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

                    @if($type == 'product')
                        <h1>{{ __('Product') }} {{ $productOrOrder->id }}</h1>
                        <div class="full-section-products" >
                            <div class="info-section">
                                <img src="http://localhost/cms2/public/image/{{ $productOrOrder->image }}" alt="{{ __('image') }}">
                            </div>
                            <div class="info-section">
                                <ul>
                                    <li>{{ $productOrOrder->title }}</li>
                                    <li>{{ $productOrOrder->description }}</li>
                                    <li>{{ $productOrOrder->price }}</li>
                                </ul>
                            </div>
                            <div class="info-section">
                                <center>
                                    <h4>{{ __('Tags') }}</h4>
                                    <ul>
                                        @foreach ($productOrOrder->tags as $tag)  
                                            <li class="tags">
                                            # {{ $tag->name }}
                                            </li> 
                                        @endforeach   
                                    </ul>
                                </center>
                            </div>
                        </div>
                        <a href="{{ url('products') }}">{{ __('Back') }}</a>
                    @else
                        <h1>{{ __('Order') }} {{ $productOrOrder->id }}</h1>
                        <ul class="checkout-box">
                            <li>
                                <div class="checkout-i">
                                    <div>{{ __('Date') }}: {{ $productOrOrder->create_date }}</div>
                                    <div>{{ __('Customer') }}: {{ $productOrOrder->customer_name }}</div>
                                    <div>{{ __('Address') }}: {{ $productOrOrder->customer_address }}</div>
                                    <div>{{ __('Comments') }}: {{ $productOrOrder->customer_comment }}</div>
                                    <div>
                                        {{ __('Tags') }}: 
                                        @foreach ($productOrOrder->tags as $tag)
                                            <span class="tags"> # {{ $tag->name }}</span>
                                        @endforeach
                                    </div>
                                </div>
                            </li> 
                        </ul>    
                        <a href="{{ url('orders') }}">{{ __('Back') }}</a>  
                    @endif

                    <p>{{ __('This page is for add tags to products or orders.') }}</p>
                    <form action="{{ route('tag', ['id' => $productOrOrder->id, 'type' => $type ]) }}" method="POST">
                        @csrf
                        <input type="text" name="tag" placeholder="{{ __('Please insert a tag') }}">
                        <input  type="hidden" name="id" value="{{ $productOrOrder->id }}" hide>   
                        <input  type="hidden" name="type" value="{{ $type }}">
                        <button type="submit" name='add'>{{ __('Add tag') }}</button>
                    </form>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layout')

@section('header')
    <title>{{ __('Index Page') }}</title>
@endsection

@section('content')
    <form action="index" method="POST">
        @csrf
        @foreach ($products as $product)
            <div class="full-section">
                <div class="info-section">
                    <img src="image/{{ $product->image }}" alt="{{ __('image') }}">
                </div>
                <div class="info-section">
                    <ul>
                        <li>{{ $product->title }}</li>
                        <li>{{ $product->description }}</li>
                        <li>{{ $product->price }}</li>
                    </ul>
                </div>
                <div class="info-section">
                    <button type="submit" name="id" value="{{ $product->id }}">{{ __('Add') }}</button>
                </div>
            </div>
        @endforeach
    </form>
    <div class="cart-section">
        <a href="{{ url('/cart') }}">{{ __('Go to cart') }}</a>
    </div>
@endsection

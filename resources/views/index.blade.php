@extends('layout')

@section('content')
    <form action="index" method="POST">
        @csrf
        @foreach ($products as $product)
            <div class="full-section">
                <div class="info-section">
                    <img src="{{ $product->image }}" alt="image">
                </div>
                <div class="info-section">
                    <ul>
                        <li>{{ $product->title }}</li>
                        <li>{{ $product->description }}</li>
                        <li>{{ $product->price }}</li>
                    </ul>
                </div>
                <div class="info-section">
                    <button type="submit" name="id" value="{{ $product->id }}">Add</button>
                </div>
            </div>
        @endforeach
    </form>
    <div class="cart-section">
        <a href="{{ url('/cart') }}">Go to cart</a>
    </div>
@endsection

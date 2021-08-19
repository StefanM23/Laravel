@extends('layout')

@section('header')
    <title>{{ __('Cart Page') }}</title>
@endsection

@section('content')
    <form action="cart/{cartID}" method="POST">
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
                    @method('DELETE')
                    <button type="submit" name="id" value="{{ $product->id }}">{{ __('Remove') }}</button>
                </div>
            </div>
        @endforeach
    </form>
    <form action="cart" method="POST">
        @csrf
        <input type="text" name="name" placeholder="{{ __('Name') }}" value="{{ old('name') }}"><br>
        <textarea name="contacts" style="resize: none;"  cols="30" rows="2" placeholder="{{ __('Contact details') }}" value="{{ old('contacts') }}"></textarea><br>
        <textarea name="comments" style="resize: none;" cols="30" rows="4" placeholder="{{ __('Comments') }}" value="{{ old('comments') }}"></textarea><br>
        <a href="{{ url('/index') }}">{{ __('Go to Index') }}</a>
        <button type="submit" name="checkout" value>{{ __('Checkout') }}</button>
    </form>
@endsection

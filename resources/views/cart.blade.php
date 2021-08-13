@extends('layout')

@section('content')
    <form action="cart" method="POST">
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
                    @method('DELETE')
                    <button type="submit" name="id" value="{{ $product->id }}">Remove</button>
                </div>
            </div>
        @endforeach
    </form>
    <form action="cart" method="post"></form>
        <input type="text" name="name" placeholder="Name" ><br>
        <textarea name="contacts" style="resize: none;"  cols="30" rows="2" placeholder="Contact details" ></textarea><br>
        <textarea name="comments" style="resize: none;" cols="30" rows="4" placeholder="Comments"></textarea><br>
        <a href="{{ url('/index') }}">Go to Index</a>
        <button type="submit" name="checkout" value>Checkout</button>
    </form>
@endsection
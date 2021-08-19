@extends('layouts.app')

@section('header')
<title>{{ __('Products Page') }}</title>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Tableau de bord') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{-- Body Page with products --}}
                    @foreach ($products as $product)
                        <div class="full-section-products" >
                            <div class="info-section">
                                <img src="image/{{ $product['image'] }}" alt="{{ __('image') }}">
                            </div>
                            <div class="info-section">
                                <ul>
                                    <li>{{ $product['title'] }}</li>
                                    <li>{{ $product['description'] }}</li>
                                    <li>{{ $product['price'] }}</li>
                                </ul>
                            </div>
                            <div class="info-section">
                                <a href="{{ route('product.edit', $product['id']) }}" name='edit'>{{ __('Edit') }}</a>
                            </div>
                            <form action="{{ url('products', ['id' => $product->id]) }}" method="POST">
                                @csrf
                                <div class="info-section">
                                    @method('DELETE')
                                    <button type="submit" name="id" >{{ __('Delete') }}</button>
                                </div>
                            </form>
                        </div>
                    @endforeach
                    <div class="cart-section-products">
                        <a href="{{ route('product.create') }}" name='add'>{{ __('Add') }}</a>
                    </div>
                    <div class="cart-section-products">
                        <a href="{{ route('logout') }}" name='logout'  onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                    </div>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

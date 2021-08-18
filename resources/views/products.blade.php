@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

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
                                <img src="<?= $product['image']; ?>" alt="image">
                            </div>
                            <div class="info-section">
                                <ul>
                                    <li><?= $product['title']; ?></li>
                                    <li><?= $product['description']; ?></li>
                                    <li><?= $product['price']; ?></li>
                                </ul>
                            </div>
                            <div class="info-section">
                                <a href="products/{{ $product['id'] }}/edit" name='edit'>Edit</a>
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
                        <a href="#" name='add'>Add</a>
                    </div>
                    <div class="cart-section-products">
                        <a href="{{ route('logout') }}" name='logout'  onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">Logout</a>
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

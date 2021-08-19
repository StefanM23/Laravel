@extends('layouts.app')

@section('header')
<title>{{ __('Product Page') }}</title>
@endsection

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
                    <h1>Product </h1> 
                        @if(isset($product))
                            <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="myProductFrom">
                            @method('PUT')
                        @else
                            <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data" class="myProductFrom">
                        @endif
                        @csrf
                        <input class="item-i" type="text" name="title"  placeholder="{{  __('Title') }}" value="{{ isset($product) ? $product->title : '' }}"><br>
                        <input class="item-i" type="text" name="description"  placeholder="{{ __('Description') }}" value="{{ isset($product) ? $product->description : '' }}"><br>
                        <input class="item-i" type="text" name="price"  placeholder="{{ __('Price') }}" value="{{ isset($product) ? $product->price : '' }}"><br>
                        <input class="item-j" type="text" name="image"  placeholder="{{ __('Image') }}" value="{{ isset($product) ? $product->image : '' }}">
                        <input class="item-j" type="file" name="file"><br>
                        <a class="item-j-y" href="{{ route('products') }}">{{ __('Products') }}</a>
            
                        <button class="item-j-y" type="submit" name="submit"  >{{ __('Save') }}</button>
                    </form>    
            </div>
        </div>
    </div>
</div>
@endsection
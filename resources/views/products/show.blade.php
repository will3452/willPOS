@extends('adminlte::page')

@section('title', 'Product | {{ $product->name }}')

@section('content_header')
    <div class="d-flex justify-content-end">
        <div>
            {!! DNS1D::getBarCodeHTML($product->code, "C128", 1.4, 22) !!}
        </div>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <img src="{{ $product->public_image }}" alt="imageo of {{ $product->name }}" style="width:100%">
                </div>
                <div class="col-md-6">
                    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="">
                                Name*
                            </label>
                            <input type="text" name="name" value="{{ $product->name }}" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="">
                                Amount*
                            </label>
                            <input type="number" name="amount" value="{{ $product->amount }}" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="">
                                Quantity*
                            </label>
                            <input type="number" name="qty" value="{{ $product->qty }}" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="">
                                Image
                            </label>
                            <x-adminlte-input-file name="image"/>
                        </div>
                        <x-adminlte-button class="btn-flat" type="submit" label="Update" theme="success" icon="fas fa-lg fa-save"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
@section('js')
    
@stop
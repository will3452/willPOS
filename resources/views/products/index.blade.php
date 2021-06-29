@extends('adminlte::page')

@section('title', 'Product listing')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>Products</h1>
        <div>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                <i class="fa fa-plus"></i> Add Product
              </button>
              
              <!-- Modal -->
              <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">New Product</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="">
                                Name*
                            </label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="">
                                Amount*
                            </label>
                            <input type="number" name="amount" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="">
                                Quantity*
                            </label>
                            <input type="number" name="qty" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="">
                                Code
                            </label>
                            <input type="text" name="code" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">
                                Image
                            </label>
                            <x-adminlte-input-file name="image"/>
                        </div>
                        <x-adminlte-button class="btn-flat" type="submit" label="Submit" theme="success" icon="fas fa-lg fa-save"/>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
        </div>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <table id="table" class="table">
                <thead>
                    <tr>
                        <th>
                            ID
                        </th>
                        <th>
                            Image
                        </th>
                        <th>
                            Name
                        </th>
                        <th>
                            Amount
                        </th>
                        <th>
                            Quantity
                        </th>
                        <th>
                            Options
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>
                                {{ $product->code }}
                            </td>
                            <td>
                                <a href="{{ $product->public_image }}" target="_blank">
                                    <img src="{{ $product->public_image }}" alt="image of {{ $product->name }}" class="p-size">
                                </a>
                            </td>
                            <td>
                                {{ $product->name }}
                            </td>
                            <td>
                                PHP {{ number_format($product->amount, 2) }}
                            </td>
                            <td>
                                {{ $product->qty }}
                            </td>
                            <td>
                                <form id="deleteform{{ $product->id }}" action="{{ route('products.remove', $product) }}" method="POST">
                                    @csrf 
                                    @method('DELETE')
                                </form>
                                <div class="d-flex justify-content-around">
                                    <a href="{{ route('products.show', $product) }}" class="btn btn-secondary btn-sm">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="#" class="btn btn-danger btn-sm" onclick="deleteHandler({{ $product->id }})">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <style>
        .p-size{
            width:40px !important;
            height: 40px !important;
            object-fit: cover;
        }
    </style>
@stop
{{-- @section('plugins.Datatables', true) --}}
@section('js')
    <script>
        function deleteHandler(id){
            Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if(result.value){
                    $('#deleteform'+id).submit();
                }
            })
        }
        $(function(){
            $('#table').DataTable();

            // delete handler
            
        });
    </script>
@stop
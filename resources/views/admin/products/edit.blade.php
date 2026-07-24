@extends('admin.layouts.main')

@section('title','Cập nhật sản phẩm')

@section('content')

<div class="card">

    <div class="card-body">

        <form
            action="{{ route('products.update',$product) }}"
            method="POST"
            enctype="multipart/form-data">

            @csrf

            @method('PUT')

            @include('admin.products.form')

        </form>

    </div>

</div>

@endsection
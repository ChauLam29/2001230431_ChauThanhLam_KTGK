@extends('admin.layouts.main')

@section('title','Thêm sản phẩm')

@section('content')

<div class="card">

    <div class="card-body">

        <form
            action="{{ route('products.store') }}"
            method="POST"
            enctype="multipart/form-data">

            @csrf

            @include('admin.products.form')

        </form>

    </div>

</div>

@endsection
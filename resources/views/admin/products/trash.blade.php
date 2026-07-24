@extends('admin.layouts.main')

@section('title','Thùng rác')

@section('content')

<div class="card">

    <div class="card-header d-flex justify-content-between">

        <h5>Thùng rác</h5>

        <a href="{{ route('products.index') }}"
           class="btn btn-primary">
            Quay lại
        </a>

    </div>

    <div class="card-body">

        <table class="table table-bordered">

            <thead class="table-dark">

            <tr>

                <th>ID</th>
                <th>Tên</th>
                <th>Danh mục</th>
                <th>Trạng thái</th>
                <th>Thao tác</th>

            </tr>

            </thead>

            <tbody>

            @forelse($products as $product)

                <tr>

                    <td>{{ $product->id }}</td>

                    <td>{{ $product->name }}</td>

                    <td>{{ $product->category->name ?? '' }}</td>

                    <td>{{ $product->status }}</td>

                    <td>

                        <form
                            action="{{ route('products.restore',$product->id) }}"
                            method="POST"
                            class="d-inline">

                            @csrf
                            @method('PUT')

                            <button class="btn btn-success btn-sm">

                                Khôi phục

                            </button>

                        </form>

                        <form
                            action="{{ route('products.forceDelete',$product->id) }}"
                            method="POST"
                            class="d-inline">

                            @csrf
                            @method('DELETE')

                            <button
                                onclick="return confirm('Xóa vĩnh viễn?')"
                                class="btn btn-danger btn-sm">

                                Xóa vĩnh viễn

                            </button>

                        </form>

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="5" class="text-center">

                        Thùng rác trống.

                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

        {{ $products->links() }}

    </div>

</div>

@endsection
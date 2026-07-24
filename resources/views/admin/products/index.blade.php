@extends('admin.layouts.main')

@section('title', 'Danh sách sản phẩm')

@section('content')

<div class="card">

    <div class="card-header">

        <div class="d-flex justify-content-between align-items-center">

            <h5 class="mb-0">Danh sách sản phẩm</h5>

            <div class="d-flex gap-2">

                {{-- Import Excel --}}
                <form action="{{ route('products.import') }}"
                      method="POST"
                      enctype="multipart/form-data"
                      class="d-flex gap-2">

                    @csrf

                    <input type="file"
                           name="excel_file"
                           class="form-control form-control-sm"
                           accept=".xlsx,.xls"
                           required>

                    <button type="submit"
                            class="btn btn-success btn-sm">

                        Import Excel

                    </button>

                </form>

                <a href="{{ route('products.trash') }}"
                   class="btn btn-dark">

                    Thùng rác

                </a>

                <a href="{{ route('products.create') }}"
                   class="btn btn-primary">

                    Thêm sản phẩm

                </a>

            </div>

        </div>

    </div>

    <div class="card-body">

        @if(session('ok'))

            <div class="alert alert-success">

                {{ session('ok') }}

            </div>

        @endif

        <form method="GET"
              action="{{ route('products.index') }}"
              class="row g-3 mb-4">

            <div class="col-md-4">

                <input type="text"
                       name="keyword"
                       class="form-control"
                       placeholder="Tên sản phẩm..."
                       value="{{ request('keyword') }}">

            </div>

            <div class="col-md-3">

                <select name="category_id"
                        class="form-select">

                    <option value="">--Danh mục--</option>

                    @foreach($categories as $category)

                        <option
                            value="{{ $category->id }}"
                            {{ request('category_id')==$category->id?'selected':'' }}>

                            {{ $category->name }}

                        </option>

                    @endforeach

                </select>

            </div>

            <div class="col-md-3">

                <select
                    name="status"
                    class="form-select">

                    <option value="">--Trạng thái--</option>

                    <option
                        value="draft"
                        {{ request('status')=='draft'?'selected':'' }}>

                        Draft

                    </option>

                    <option
                        value="published"
                        {{ request('status')=='published'?'selected':'' }}>

                        Published

                    </option>

                </select>

            </div>

            <div class="col-md-2 d-grid">

                <button class="btn btn-success">

                    Tìm kiếm

                </button>

            </div>

        </form>

        <table class="table table-bordered table-hover align-middle">

            <thead class="table-dark text-center">

            <tr>

                <th>ID</th>

                <th>Ảnh</th>

                <th>Tên sản phẩm</th>

                <th>Danh mục</th>

                <th>Giá</th>

                <th>Trạng thái</th>

                <th>Tài liệu</th>

                <th width="180">

                    Thao tác

                </th>

            </tr>

            </thead>

            <tbody>

            @forelse($products as $product)

                <tr>

                    <td class="text-center">

                        {{ $product->id }}

                    </td>

                    <td class="text-center">

                        @if($product->image_path)

                            <img
                                src="{{ asset('storage/'.$product->image_path) }}"
                                width="80"
                                class="img-thumbnail">

                        @else

                            <span class="text-muted">

                                Chưa có ảnh

                            </span>

                        @endif

                    </td>

                    <td>

                        {{ $product->name }}

                    </td>

                    <td>

                        {{ $product->category->name ?? '' }}

                    </td>

                    <td>

                        {{ number_format($product->price,0,',','.') }} đ

                    </td>

                    <td class="text-center">

                        @if($product->status=='published')

                            <span class="badge bg-success">

                                Published

                            </span>

                        @else

                            <span class="badge bg-secondary">

                                Draft

                            </span>

                        @endif

                    </td>

                    <td class="text-center">

                        @if($product->document_path)

                            <a href="{{ route('products.download',$product->id) }}"
                               class="btn btn-info btn-sm">

                                Tải

                            </a>

                        @else

                            <span class="badge bg-warning">

                                Chưa có

                            </span>

                        @endif

                    </td>

                    <td class="text-center">

                        <a href="{{ route('products.edit',$product) }}"
                           class="btn btn-warning btn-sm">

                            Sửa

                        </a>

                        <form action="{{ route('products.destroy',$product) }}"
                              method="POST"
                              class="d-inline">

                            @csrf
                            @method('DELETE')

                            <button
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('Chuyển sản phẩm vào thùng rác?')">

                                Xóa

                            </button>

                        </form>

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="8"
                        class="text-center">

                        Không có dữ liệu.

                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

        <div class="mt-3">

            {{ $products->withQueryString()->links() }}

        </div>

    </div>

</div>

@endsection
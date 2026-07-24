<div class="mb-3">
    <label class="form-label">Tên sản phẩm</label>
    <input
        type="text"
        name="name"
        class="form-control"
        value="{{ old('name', $product->name ?? '') }}">

    @error('name')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label">Danh mục</label>

    <select name="category_id" class="form-select">

        <option value="">--Chọn danh mục--</option>

        @foreach($categories as $category)

            <option
                value="{{ $category->id }}"
                {{ old('category_id', $product->category_id ?? '') == $category->id ? 'selected' : '' }}>

                {{ $category->name }}

            </option>

        @endforeach

    </select>

    @error('category_id')
        <small class="text-danger">{{ $message }}</small>
    @enderror

</div>

<div class="mb-3">

    <label class="form-label">Giá</label>

    <input
        type="number"
        step="0.01"
        name="price"
        class="form-control"
        value="{{ old('price', $product->price ?? '') }}">

    @error('price')
        <small class="text-danger">{{ $message }}</small>
    @enderror

</div>

<div class="mb-3">

    <label class="form-label">Mô tả</label>

    <textarea
        name="description"
        rows="5"
        class="form-control">{{ old('description', $product->description ?? '') }}</textarea>

</div>

<div class="mb-3">

    <label class="form-label">

        Ảnh đại diện

    </label>

    <input
        type="file"
        name="image_up"
        class="form-control">

    @error('image_up')
        <small class="text-danger">{{ $message }}</small>
    @enderror

    @isset($product)

        @if($product->image_path)

            <img
                src="{{ asset('storage/'.$product->image_path) }}"
                width="120"
                class="mt-2">

        @endif

    @endisset

</div>

<div class="mb-3">

    <label class="form-label">

        File tài liệu

    </label>

    <input
        type="file"
        name="document_up"
        class="form-control">

    @error('document_up')
        <small class="text-danger">{{ $message }}</small>
    @enderror

</div>

<div class="mb-3">

    <label class="form-label">

        Trạng thái

    </label>

    <select
        name="status"
        class="form-select">

        <option value="draft"
            {{ old('status', $product->status ?? '') == 'draft' ? 'selected' : '' }}>
            Draft
        </option>

        <option value="published"
            {{ old('status', $product->status ?? '') == 'published' ? 'selected' : '' }}>
            Published
        </option>

    </select>

    @error('status')
        <small class="text-danger">{{ $message }}</small>
    @enderror

</div>

<button class="btn btn-success">

    Lưu

</button>

<a
    href="{{ route('products.index') }}"
    class="btn btn-secondary">

    Quay lại

</a>
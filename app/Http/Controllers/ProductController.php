<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Imports\ProductsImport;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Product::with('category');

        // Lọc theo tên
        if ($request->filled('keyword')) {
            $query->where('name', 'like', '%' . $request->keyword . '%');
        }

        // Lọc theo danh mục
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Lọc theo trạng thái
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $products = $query
            ->latest()
            ->paginate(5)
            ->withQueryString();

        $categories = Category::all();

        return view('admin.products.index', compact(
            'products',
            'categories'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();

        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $validated = $request->validated();

        // Upload ảnh
        if ($request->hasFile('image_up')) {
            $validated['image_path'] = $request->file('image_up')
                ->store('products/images', 'public');
        }

        // Upload tài liệu
        if ($request->hasFile('document_up')) {
            $validated['document_path'] = $request->file('document_up')
                ->store('products/documents', 'public');
        }

        Product::create($validated);

        return redirect()->route('products.index')
            ->with('success', 'Thêm sản phẩm thành công.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();

        return view(
            'admin.products.edit',
            compact('product', 'categories')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product)
    {
        $data = $request->validated();

        // Đổi ảnh
        if ($request->hasFile('image_up')) {

            if (
                $product->image_path &&
                Storage::disk('public')->exists($product->image_path)
            ) {
                Storage::disk('public')->delete($product->image_path);
            }

            $data['image_path'] = $request
                ->file('image_up')
                ->store('products/images', 'public');
        }

        // Đổi tài liệu
        if ($request->hasFile('document_up')) {

            if (
                $product->document_path &&
                Storage::disk('public')->exists($product->document_path)
            ) {
                Storage::disk('public')->delete($product->document_path);
            }

            $data['document_path'] = $request
                ->file('document_up')
                ->store('products/documents', 'public');
        }

        $product->update($data);

        return redirect()
            ->route('products.index')
            ->with('ok', 'Cập nhật thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()
            ->route('products.index')
            ->with(
                'ok',
                'Đã chuyển vào thùng rác.'
            );
    }
    public function downloadDocument($id)
    {
        $product = Product::findOrFail($id);

        if (
            !$product->document_path ||
            !Storage::disk('public')->exists($product->document_path)
        ) {
            return back()->with('ok', 'Tài liệu không tồn tại.');
        }

        return Storage::download(
            'public/' . $product->document_path
        );
    }
    public function trash()
    {
        $products = Product::onlyTrashed()
            ->with('category')
            ->latest()
            ->paginate(5);

        return view('admin.products.trash', compact('products'));
    }
    public function restore($id)
    {
        Product::onlyTrashed()
            ->findOrFail($id)
            ->restore();

        return redirect()
            ->route('products.trash')
            ->with(
                'ok',
                'Khôi phục thành công.'
            );
    }
    public function forceDelete($id)
    {
        $product = Product::onlyTrashed()
            ->findOrFail($id);

        if (
            $product->image_path &&
            Storage::disk('public')->exists($product->image_path)
        ) {

            Storage::disk('public')
                ->delete($product->image_path);
        }

        if (
            $product->document_path &&
            Storage::disk('public')->exists($product->document_path)
        ) {

            Storage::disk('public')
                ->delete($product->document_path);
        }

        $product->forceDelete();

        return redirect()
            ->route('products.trash')
            ->with(
                'ok',
                'Đã xóa vĩnh viễn.'
            );
    }
    public function import(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|mimes:xlsx,xls'
        ], [
            'excel_file.required' => 'Vui lòng chọn file Excel.',
            'excel_file.mimes' => 'Chỉ chấp nhận file Excel (.xlsx, .xls).'
        ]);

        Excel::import(
            new ProductsImport(),
            $request->file('excel_file')
        );

        return redirect()
            ->route('products.index')
            ->with('ok', 'Import sản phẩm thành công.');
    }
}

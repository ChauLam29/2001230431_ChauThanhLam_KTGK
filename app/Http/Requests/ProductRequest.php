<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:200',

            'category_id' => 'required|exists:categories,id',

            'price' => 'required|numeric|gt:0',

            'image_up' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:20',

            'document_up' => 'nullable|mimes:pdf,doc,docx|max:20',

            'status' => 'required|in:draft,published',
        ];
    }
     public function messages(): array
    {
        return [

            // Name
            'name.required' => 'Vui lòng nhập tên sản phẩm.',
            'name.string' => 'Tên sản phẩm không hợp lệ.',
            'name.max' => 'Tên sản phẩm không được vượt quá 200 ký tự.',

            // Category
            'category_id.required' => 'Vui lòng chọn danh mục.',
            'category_id.exists' => 'Danh mục được chọn không tồn tại.',

            // Price
            'price.required' => 'Vui lòng nhập giá sản phẩm.',
            'price.numeric' => 'Giá sản phẩm phải là số.',
            'price.gt' => 'Giá sản phẩm phải lớn hơn 0.',

            // Image
            'image_up.image' => 'Tệp tải lên phải là hình ảnh.',
            'image_up.mimes' => 'Ảnh chỉ được phép có định dạng JPG, JPEG, PNG hoặc WEBP.',
            'image_up.max' => 'Dung lượng ảnh không được vượt quá 20 KB.',

            // Document
            'document_up.mimes' => 'Tài liệu chỉ được phép có định dạng PDF, DOC hoặc DOCX.',
            'document_up.max' => 'Dung lượng tài liệu không được vượt quá 20 KB.',

            // Status
            'status.required' => 'Vui lòng chọn trạng thái sản phẩm.',
            'status.in' => 'Trạng thái sản phẩm không hợp lệ.',
        ];
    }

    /**
     * Tên hiển thị của các trường (tùy chọn).
     */
    public function attributes(): array
    {
        return [
            'name' => 'tên sản phẩm',
            'category_id' => 'danh mục',
            'price' => 'giá',
            'image_up' => 'ảnh đại diện',
            'document_up' => 'tài liệu',
            'status' => 'trạng thái',
        ];
    }
    
}

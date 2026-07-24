<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Product([
            'category_id' => $row['category_id'],
            'name' => $row['name'],
            'price' => $row['price'],
            'description' => $row['description'],
            'image_path' => $row['image_path'] ?? null,
            'document_path' => $row['document_path'] ?? null,
            'status' => $row['status'],
        ]);
    }
}

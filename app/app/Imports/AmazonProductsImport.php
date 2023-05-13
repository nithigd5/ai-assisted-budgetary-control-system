<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;

class AmazonProductsImport implements ToModel , WithUpserts, WithHeadingRow
{

    public function model(array $row)
    {
        Product::create([
            'id' => $row['uniq_id'] ,
            'name' => $row['product_name'] ,
            'brand' => $row['brand_name'] ,
            'description' => $row['about_product'] ,
            'category' => $row['category'] ,
            'min_price' => $row['selling_price'] ,
            'max_price' => $row['selling_price'] ,
        ]);
    }

    public function uniqueBy()
    {
        return 'id';
    }
}

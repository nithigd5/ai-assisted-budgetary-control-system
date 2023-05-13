<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;

class AmazonKaggleProductsImport implements ToModel , WithUpserts, WithHeadingRow
{
    public function model(array $row)
    {
        Product::create([
            'name' => $row['name'] ,
            'category' => $row['main_category'] ,
            'type' => $row['sub_category'] ,
            'min_price' => $row['discount_price'] ,
            'max_price' => $row['actual_price'] ,
            'ratings' => $row['ratings'] ,
            'no_of_ratings' => $row['no_of_ratings'] ,
            'extra' => json_encode([
                'link' => $row['link'],
                'image' => $row['image']
            ])
        ]);
    }

    public function uniqueBy()
    {
        return 'name';
    }

    public function batchSize(): int
    {
        return 10;
    }

    public function chunkSize(): int
    {
        return 10;
    }
}

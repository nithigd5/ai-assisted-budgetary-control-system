<?php

namespace Database\Seeders;

use App\Imports\AmazonKaggleProductsImport;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
//        Excel::import(new AmazonProductsImport(),
//            storage_path('app/datasets/marketing_sample_for_amazon_com-ecommerce__20200101_20200131__10k_data.csv')
//            ,null, \Maatwebsite\Excel\Excel::CSV);

        $csvFiles = Storage::disk('local')->allFiles('datasets\amazon');

        foreach ($csvFiles as $csv) {

            echo "Loading ".$csv.PHP_EOL;

            Excel::import(new AmazonKaggleProductsImport() ,
                $csv
                , 'local' , \Maatwebsite\Excel\Excel::CSV);
        }
    }
}

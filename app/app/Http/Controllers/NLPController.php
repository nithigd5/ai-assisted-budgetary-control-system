<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class NLPController extends Controller
{
    public function extract(Request $request)
    {
//        return [
//            'product' => 'Name of Product' ,
//            'price' => 233 ,
//            'mode' => 'Online'
//        ];
        $response = Http::post(config('app.api_host').'/expenses' , ['text' => $request->text]);

        return $response->json();
    }
}

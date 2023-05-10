<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class NLPController extends Controller
{
    public function extract(Request $request)
    {

        $response = Http::timeout(3)->post(config('app.api_host').'/purchases/from-text' , ['text' => $request->text]);

        return $response->json();
    }
}

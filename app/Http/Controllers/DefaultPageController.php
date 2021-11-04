<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DefaultPageController extends Controller
{
    public function index() {
        return view('welcome', [
            'configData' => json_encode([
                'appUrl' => env('APP_SERVER_URL'),
                'apiVersion' => env('API_VERSION')
            ])
        ]);
    }
}

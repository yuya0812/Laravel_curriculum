<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MapController extends Controller
{
    public function index()
    {
        // APIキーをビューに渡す
        $googleMapsApiKey = env('GOOGLE_MAPS_API_KEY');
        return view('posts.create', compact('googleMapsApiKey'));
    }
}

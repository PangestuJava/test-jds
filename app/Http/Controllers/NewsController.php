<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use App\Http\Resources\NewsResource;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::all();
        return NewsResource::collection($news);
    }

    public function show($id)
    {
        $news = News::with('author:id,username')->findOrFail($id);
        return new NewsResource($news);
    }
}

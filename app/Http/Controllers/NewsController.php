<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use App\Http\Resources\NewsResource;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::all();
        return NewsResource::collection($news);
    }

    public function show($id)
    {
        $news = News::with(['author:id,firstname,lastname', 'comments:id,news_id,user_id,comments_content'])->findOrFail($id);
        return new NewsResource($news);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'news_content' => 'required',
        ]);

        $request['author_id'] = Auth::user()->id;

        $news = News::create($request->all());
        return new NewsResource($news->loadMissing('author:id,firstname,lastname'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'news_content' => 'required',
        ]);

        $news = News::findOrFail($id);
        $news->update($request->all());

        return new NewsResource($news->loadMissing('author:id,firstname,lastname'));
    }

    public function destroy($id)
    {
        $news = News::findOrFail($id);
        $news->delete();

        return new NewsResource($news->loadMissing('author:id,firstname,lastname'));
    }
}

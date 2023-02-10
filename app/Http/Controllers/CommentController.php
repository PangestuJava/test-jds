<?php

namespace App\Http\Controllers;

use App\Http\Resources\CommentResource;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, $news_id)
    {
        $request['news_id'] = $news_id;
        $validated = $request->validate([
            'news_id' => 'required|exists:news,id',
            'comments_content' => 'required',
        ]);

        $request['user_id'] = auth()->user()->id;
        $comment = Comment::create($request->all());
        return new CommentResource($comment->loadMissing(['commentator:id,email,username']));
    }

    public function update(Request $request, $id)
    {
        // $request['news_id'] = $news_id;
        $validated = $request->validate([
            // 'news_id' => 'required|exists:news,id',
            'comments_content' => 'required',
        ]);
        $comment = Comment::findOrFail($id);
        $comment->update($request->all());
        return new CommentResource($comment->loadMissing(['commentator:id,email,username']));
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return new CommentResource($comment->loadMissing('commentator:id,email,username'));
    }
}

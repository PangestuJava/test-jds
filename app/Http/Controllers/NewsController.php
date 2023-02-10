<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Events\NewsCreated;
use App\Events\NewsDeleted;
use App\Events\NewsUpdated;
use Illuminate\Http\Request;
use App\Http\Resources\NewsResource;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::paginate(2);
        return NewsResource::collection($news);
    }

    public function show($id)
    {
        $news = News::with(['author:id,firstname,lastname', 'comments:id,news_id,user_id,comments_content'])->findOrFail($id);
        return new NewsResource($news);
    }

    public function store(Request $request)
    {
        // Melakukan validasi
        $request->validate([
            'title' => 'required|max:255',
            'image' => 'mimes:png,jpg|image|max:1020',
            'news_content' => 'required',
        ]);

        // Menyimpan gambar ke project
        if ($request->image) {
            $fileName = $this->generateRandomString();
            $extension = $request->image->extension();
            $newName = $fileName . '.' . $extension;
            $request->image->storeAs('image', $newName);
        } else {
            //Jika gambarnya tidak diisi
            $newName = '';
        }

        // Simpan Data ke Database
        $news = News::create([
            'title' => $request->title,
            'news_content' => $request->news_content,
            'image' => $newName,
            'author_id' => Auth::user()->id
        ]);
        NewsCreated::dispatch($news);
        return new NewsResource($news->loadMissing('author:id,firstname,lastname'));
    }

    public function update(Request $request, $id)
    {
        //mencari news sesuai Route yang dicari
        $news = News::findOrFail($id);

        // Melakukan Validasi data yang di input
        $request->validate([
            'title' => 'required|max:255',
            'image' => 'image|mimes:png,jpg|file|max:1020',
            'news_content' => 'required',
        ]);

        // Menyimpan gambar ke project
        if ($request->image) {
            $fileName = $this->generateRandomString();
            $extension = $request->image->extension();
            $newName = $fileName . '.' . $extension;
            $request->image->storeAs('image', $newName);
            // Delete Image di storage
            $image_path = public_path() . '/storage/image/' . $news->image;
            unlink($image_path);
        } else {
            $newName = $news->image;
        }

        // melakukan update data ke database
        $news->update([
            'title' => $request->title,
            'news_content' => $request->news_content,
            'image' => $newName,
        ]);
        NewsUpdated::dispatch($news);
        return new NewsResource($news->loadMissing('author:id,firstname,lastname'));
    }

    public function destroy($id)
    {
        $news = News::findOrFail($id);
        $image_path = public_path() . '/storage/image/' . $news->image;
        unlink($image_path);
        $news->delete();
        NewsDeleted::dispatch($news);

        return new NewsResource($news->loadMissing('author:id,firstname,lastname'));
    }

    function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}

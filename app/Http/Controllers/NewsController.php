<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class NewsController extends Controller
{
    public function index()
    {
        $newsList = News::latest()->paginate(9);
        return view('admin.news.index', compact('newsList'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.news.create', compact('categories'));
    }

    public function store(Request $request)
{
    
    $request->validate([
        'title' => 'required|string|max:255',
        'category_id' => 'required|exists:categories,id',
        'description' => 'required',
        'media_file' => 'nullable|file|mimes:jpg,jpeg,png|max:524288', 
    ]);

    $news = new News();
    $news->title = $request->title;
    $news->category_id = $request->category_id;
    $news->description = $request->description;

    if ($request->hasFile('media_file')) {
        $file = $request->file('media_file');
        $fileExtension = $file->getClientOriginalExtension();
        $newFileName = time() . '_' . uniqid() . '.' . $fileExtension;

        
        $image = imagecreatefromjpeg($file); 
        
        $quality = 75; 
        imagejpeg($image, storage_path('app/public/uploads/' . $newFileName), $quality);
        imagedestroy($image); 

        $news->image = 'uploads/' . $newFileName;
    }

    $news->save();

    return redirect()->route('news.index')->with('success', 'News created successfully!');
}


    public function edit($id)
    {
        $id = base64_decode($id);
        $news = News::findOrFail($id);
        $categories = Category::all();
        return view('admin.news.edit', compact('news', 'categories'));
    }

    public function update(Request $request, $id)
{
    $news = News::findOrFail($id);

    $request->validate([
        'title' => 'required|string|max:255',
        'category_id' => 'required|exists:categories,id',
        'description' => 'required',
        'media_file' => 'nullable|file|mimes:jpg,jpeg,png|max:524288', 
    ]);

    $news->title = $request->title;
    $news->category_id = $request->category_id;
    $news->description = $request->description;

    if ($request->hasFile('media_file')) {
        $file = $request->file('media_file');
        $fileExtension = $file->getClientOriginalExtension();
        $newFileName = time() . '_' . uniqid() . '.' . $fileExtension;

        
        $image = imagecreatefromjpeg($file); 
        $quality = 75; 
        imagejpeg($image, storage_path('app/public/uploads/' . $newFileName), $quality);  
        imagedestroy($image);  

       
        if ($news->image) {
            Storage::disk('public')->delete($news->image);
        }

        $news->image = 'uploads/' . $newFileName;  
    }

    $news->save();

    return redirect()->route('news.index')->with('success', 'News updated successfully!');
}


    public function destroy($id)
    {
        $id = base64_decode($id);
        $news = News::findOrFail($id);

        if ($news->image) {
            Storage::disk('public')->delete('news/' . $news->image);
        }

        $news->delete();

        return redirect()->route('news.index')->with('success', 'News deleted successfully!');
    }
}

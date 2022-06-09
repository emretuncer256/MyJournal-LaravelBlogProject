<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ArticleModel as ARM;
use App\Models\CategoryModel as CM;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            "articles" => ARM::orderBy('id', 'DESC')->get(),
        ];
        return view('admin.articles.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'categories' => CM::all(),
        ];
        return view('admin.articles.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:3',
            'image' => 'required|image|mimes:jpeg,jpg,png|max:1024'
        ]);

        $article = new ARM;
        $article->title = $request->title;
        $article->category_id = $request->category;
        $article->content = $request->content;
        $article->slug = Str::slug($article->title);

        if ($request->hasFile('image')) {
            $imageName = Str::random() . "." . $article->slug . "." . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads'), $imageName);
            $article->image = 'uploads/' . $imageName;
        }
        $article->save();
        toastr()->success('Makale başarıyla eklendi.', 'Başarılı');
        return redirect()->route('admin.articles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = ARM::findOrFail($id);
        $data = [
            'article' => $article,
            'categories' => CM::all(),
        ];
        return view('admin.articles.update', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|min:3',
            'image' => 'image|mimes:jpeg,jpg,png|max:1024'
        ]);

        $article = ARM::findOrFail($id);
        $article->title = $request->title;
        $article->category_id = $request->category;
        $article->content = $request->content;
        $article->slug = Str::slug($article->title);

        if ($request->hasFile('image')) {
            $imageName = Str::random() . "." . $article->slug . "." . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads'), $imageName);
            $article->image = 'uploads/' . $imageName;
        }
        $article->save();
        toastr()->success('Makale başarıyla güncellendi.', 'Güncelleme Başarılı');
        return redirect()->route('admin.articles.index');
    }

    public function trash()
    {
        $data = [
            'articles' => ARM::onlyTrashed()->orderBy('deleted_at', 'ASC')->get(),
        ];
        return view('admin.articles.trash', $data);
    }

    public function recover($id)
    {
        $article = ARM::onlyTrashed()->find($id);
        $article->restore();
        toastr()->success('Makale başarıyla geri yüklendi.', 'Başarılı');
        return redirect()->route('admin.articles.trash');
    }

    public function delete($id)
    {
        $article = ARM::find($id);
        toastr()->success('"' . $article->title . '"' . ' başlıklı makale geri dönüşüm kutusuna kaldırıldı.', 'Makale Kaldırıldı');
        $article->delete();
        return redirect()->route('admin.articles.index');
    }

    public function deletePermanently($id)
    {
        $article = ARM::onlyTrashed()->find($id);
        if (File::exists($article->image)) {
            File::delete(public_path($article->image));
        }
        $article->forceDelete();
        toastr()->success('Makale tamamen silindi.', 'Silme Başarılı');
        return redirect()->route('admin.article.trash');
    }

    public function activation(Request $request)
    {
        $article = ARM::findOrFail($request->id);
        $article->status = ($request->status == "true") ? true : false;
        $article->save();
    }
}

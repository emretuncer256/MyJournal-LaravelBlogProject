<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CategoryModel as CM;
use App\Models\ArticleModel as ARM;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $data = [
            'categories' => CM::all(),
        ];
        return view('admin.categories.index', $data);
    }

    public function store(Request $request)
    {
        if (!CM::whereSlug(Str::slug($request->name))->first()) {
            $category = new CM;
            $category->name = $request->name;
            $category->slug = Str::slug($request->name);
            $category->save();
            toastr()->success('"' . $category->name . '" adlı kategori eklendi.', 'Kategori Ekleme Başarılı');
            return redirect()->route('admin.category.index');
        }
        toastr()->error('"' . $request->name . '" adlı kategori zaten mevcut.', 'Kategori Ekleme Başarısız');
        return redirect()->route('admin.category.index');
    }

    public function getData(Request $request)
    {
        $category = CM::findOrFail($request->id);
        return response()->json($category);
    }

    public function update(Request $request)
    {
        $isSlugExists = CM::whereNotIn('id', [$request->id])->whereSlug(Str::slug($request->slug))->first();
        $isNameExists = CM::whereNotIn('id', [$request->id])->whereName($request->name)->first();
        if (!$isSlugExists and !$isNameExists) {
            $category = CM::findOrFail($request->id);
            $category->name = $request->name;
            $category->slug = Str::slug($request->slug);
            $category->updated_at = now();
            $category->save();
            toastr()->success('"' . $category->name . '" adlı kategori güncellendi.', 'Kategori Güncelleme Başarılı');
            return redirect()->route('admin.category.index');
        } elseif ($isSlugExists) {
            toastr()->error('"' . Str::slug($request->slug) . '" slugına sahip kategori zaten mevcut.', 'Kategori Güncelleme Başarısız');
            return redirect()->route('admin.category.index');
        }
        toastr()->error('"' . $request->name . '" adlı kategori zaten mevcut.', 'Kategori Güncelleme Başarısız');
        return redirect()->route('admin.category.index');
    }

    public function delete(Request $request)
    {
        $category = CM::findOrFail($request->id);
        if ($category->id == 1) {
            toastr()->error('Bu kategori silinemez.');
            return redirect()->back();
        }
        $count = $category->articleCount();
        $defaultCategory = CM::findOrFail(1);
        if ($category->articleCount() > 0) {
            ARM::where('category_id', $category->id)->update([
                'category_id' => 1,
                'status' => false
            ]);
            toastr()->info($count . ' makale "' . $defaultCategory->name . '" ' . "adlı kategoriye taşındı.", 'Makale Aktrımı Başarılı');
        }
        $name = $category->name;
        $category->delete();

        toastr()->success('"' . $name . '"' . ' adlı kategori başarıyla silindi.', 'Silme Başarılı');
        return redirect()->route('admin.category.index');
    }

    public function activation(Request $request)
    {
        $category = CM::findOrFail($request->id);
        $category->status = ($request->status == "true") ? true : false;
        $category->save();
    }
}

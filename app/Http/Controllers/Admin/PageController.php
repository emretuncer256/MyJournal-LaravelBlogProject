<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PageModel as PM;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function index()
    {
        $data = [
            'pages' => PM::all(),
        ];
        return view('admin.pages.index', $data);
    }

    public function create()
    {
        return view('admin.pages.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:3',
            'image' => 'required|image|mimes:jpeg,jpg,png|max:1024'
        ]);

        $page = new PM;
        $page->title = $request->title;
        $page->content = $request->content;
        $page->slug = Str::slug($page->title);

        $last = PM::orderBy('order', 'DESC')->first();

        $page->order = $last->order + 1;

        if ($request->hasFile('image')) {
            $imageName = Str::random() . "." . $page->slug . "." . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads\pages'), $imageName);
            $page->image = 'uploads/pages/' . $imageName;
        }
        $page->save();
        toastr()->success('Sayfa başarıyla eklendi.', 'Sayfa Ekleme Başarılı');
        return redirect()->route('admin.page.index');
    }


    public function edit($id)
    {
        $data = [
            'page' => PM::findOrFail($id),
        ];
        return view('admin.pages.update', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|min:3',
            'image' => 'image|mimes:jpeg,jpg,png|max:1024'
        ]);

        $page = PM::findOrFail($id);
        $page->title = $request->title;
        $page->content = $request->content;
        $page->slug = Str::slug($page->title);

        if ($request->hasFile('image')) {
            $imageName = Str::random() . "." . $page->slug . "." . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads'), $imageName);
            $page->image = 'uploads/' . $imageName;
        }
        $page->save();
        toastr()->success('Sayfa başarıyla güncellendi.', 'Güncelleme Başarılı');
        return redirect()->route('admin.page.index');
    }

    public function delete($id)
    {
        $page = PM::find($id);
        if (File::exists($page->image)) {
            File::delete(public_path($page->image));
        }
        toastr()->success('"' . $page->title . '"' . ' adlı sayfa tamamen silindi.', 'Sayfa Kaldırıldı');
        $page->delete();
        return redirect()->route('admin.page.index');

    }

    public function sort(Request $request)
    {
        $orders = $request->get('page');
        foreach ($orders as $order => $id) {
            PM::whereId($id)->update(['order' => $order]);
        }
    }

    public function activation(Request $request)
    {
        $page = PM::findOrFail($request->id);
        $page->status = ($request->status == "true") ? true : false;
        $page->save();
    }
}

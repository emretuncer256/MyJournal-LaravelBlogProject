<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CommentModel as CM;

class CommentController extends Controller
{
    public function index()
    {
        $data = [
            'comments' => CM::all(),
        ];
        return view('admin.comments.index', $data);
    }

    public function getData(Request $request)
    {
        $comment = CM::findOrFail($request->id);
        return response()->json($comment);
    }

    public function update(Request $request)
    {
        $comment = CM::findOrFail($request->id);
        $comment->fullname = $request->fullname;
        $comment->content = $request->content;
        $comment->save();
        toastr()->success('Yorum başarıyla güncellendi.', 'Yorum Güncellendi');
        return redirect()->route('admin.comment.index');
    }

    public function delete($id)
    {
        $success = CM::findOrFail($id)->delete();
        if ($success) {
            toastr()->success('Yorum başarıyla kaldırıldı.', 'Yorum Silindi');
            return redirect()->route('admin.comment.index');
        }
        toastr()->error('Bir hata meydana geldi. Lütfen daha sonra tekrar deneyin.', 'Yorum Silinemedi');
        return redirect()->route('admin.comment.index');
    }

    public function activation(Request $request)
    {
        $comment = CM::findOrFail($request->id);
        $comment->status = ($request->status == "true") ? true : false;
        $comment->save();
    }
}

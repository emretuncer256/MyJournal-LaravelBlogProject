<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\CategoryModel as CM;
use App\Models\ArticleModel as ARM;
use App\Models\PageModel as PM;
use App\Models\ContactModel as COM;
use Illuminate\Support\Facades\Mail;
use App\Models\ConfigModel as CONFIG;

class HomeController extends Controller
{
    public function __construct()
    {
        if (CONFIG::find(1)->status == 0) {
            return redirect()->to('maintenance')->send();
        }
        view()->share('pages', PM::orderBy('order', 'ASC')->whereStatus(1)->get());
        view()->share('categories', CM::all());
    }

    public function index()
    {
        $data = [
            'articles' => ARM::with('getCategory')->whereStatus(1)->whereHas('getCategory', function ($query) {
                $query->where('status', 1);
            })->orderBy('created_at', 'DESC')->paginate(4),
        ];
        return view('front.home', $data);
    }

    public function single($category, $slug)
    {
        $category = CM::whereStatus(1)->whereSlug($category)->first() ?? abort(403, 'Böyle bir kategori bulunamadı.');
        $article = ARM::whereStatus(1)->whereSlug($slug)->whereCategoryId($category->id)->first() ?? abort(403, 'Böyle bir makale bulunamadı.');
        $data = [
            'article' => $article ?? abort(403, 'Böyle bir yazı bulunamadı.'),
        ];
        $article->increment('hit');
        return view('front.single', $data);
    }

    public function category($slug)
    {
        $category = CM::whereStatus(1)->whereSlug($slug)->first() ?? abort(403, 'Böyle bir kategori bulunamadı.');
        $data = [
            'articles' => ARM::whereStatus(1)->whereCategoryId($category->id)->paginate(4),
            'category' => $category,
        ];
        return view('front.category', $data);
    }

    public function page($slug)
    {
        $data = [
            'page' => PM::whereSlug($slug)->first() ?? abort(403, "Böyle bir sayfa bulunamadı."),
        ];
        return view('front.page', $data);
    }

    public function contact()
    {
        return view('front.contact');
    }

    public function contactPost(Request $request)
    {
        $validator = Validator::make($request->post(), [
            'fullname' => 'required|min:5|max:20',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required|min:10'
        ]);
        if ($validator->fails()) {
            return redirect()->route('contact')->withErrors($validator)->withInput();
        }
        $contact = new COM();
        $contact->fullname = $request->fullname;
        $contact->email = $request->email;
        $contact->subject = $request->subject;
        $contact->message = $request->message;
        $contact->save();
        /*Mail::send([], [], function ($message) use ($request) {
            $message->from('emretuncer@gmail.com', 'My Journal');
            $message->to('emretuncertest@gmail.com');
            $message->setBody('Mesajı gönderen :', 'text/html');
            $message->subject($request->name . ' size yeni mesaj gönderdi.');
        });*/
        return redirect()->route('contact')->with('success', 'Mesajınız bize iletildi. Teşekkür ederiz.');
    }
}

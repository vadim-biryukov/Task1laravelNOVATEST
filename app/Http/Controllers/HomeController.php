<?php

namespace App\Http\Controllers;
use App\Likes;
use App\News;
use App\News_type;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $news=News::all()->sortByDesc('sorting');

        return view('home',compact('news'));

    }
    /* есть проблемы с названиями, например почему-то контроллер 
    который отвечает за новости назван Home,  
    а шаблон Info, сама переменная новости в деталке названа read логичнее было бы назвать news, и это не единственные проблемы с названиями
    функцию можно было бы назвать newsDetail например*/
    public function info($id){
        $read=News::find($id);
        $news_id=$id; //переменная нигде не используется
        $count_like=Likes::where('news_id',$id)->count();
        $news_types_id=News::find($id)->news_types_id;
        $type_title = News_type::find($news_types_id)->title;
        return view('info')->with([
            'read' => $read,
            'type_title' => $type_title,
            'count_like' => $count_like
        ]);
    }


}

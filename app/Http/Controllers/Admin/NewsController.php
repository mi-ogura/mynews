<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\News;

class NewsController extends Controller
{
    //
    public function add()
    {
        return view('admin.news.create');
    }

    public function create(Request $request)
    {
      $this->validate($request, News::$rules);

      $news = new News;
      $form = $request->all();

      // フォームから画像が送信されてきたら、保存して、$news->image_path に画像のパスを保存する
      if (isset($form['image'])) {
        $path = $request->file('image')->store('public/image');
        $news->image_path = basename($path);
      } else {
          $news->image_path = null;
      }

      // フォームから送信されてきた_tokenを削除する
      unset($form['_token']);
      // フォームから送信されてきたimageを削除する
      unset($form['image']);

      // データベースに保存する
      $news->fill($form);
      $news->save();
        // admin/news/createにリダイレクトする
        return redirect('admin/news/create');
  
    }
    public function index(Request $request)
    {
        //$requestの中のcond_titleの値を$cond_itleに代入、もし$requestにcond_titleがなければnullを代入
        $cond_title = $request->cond_title;
        if ($cond_title != '') {
            // 検索されたら検索結果を取得する
            $posts = News::where('title', $cond_title)->get();
        } else {
            // それ以外はすべてのニュースを取得する
            $posts = News::all();
        }
        //index.blade.phpのファイルに取得したレコード（$posts）とユーザーが入力した文字列（$cond_title）を渡し、ページを開く。
        return view('admin.news.index', ['posts' => $posts, 'cond_title' => $cond_title]);
    }
}

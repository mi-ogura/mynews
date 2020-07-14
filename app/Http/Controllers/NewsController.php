<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $cond_title = $request->cond_title;
        // $cond_title が空白でない場合は、記事を検索して取得する
        if ($cond_title != '') {
            $posts = News::where('title', $cond_title).orderBy('updated_at', 'desc')->get();
        } else {
            //News::all()/Eloquentを使った、すべてのnewsテーブルを取得する。
            //sortByDesc()/カッコの中の値でソートする（降順）。投稿日時順に新しい方から並べる。
            $posts = News::all()->sortByDesc('updated_at');
        }

        if (count($posts) > 0) {
            //shift()/配列の最初のデータを削除し、その値を返す。
            //最新の記事とそれ以外の記事とで表記を変えたいため。
            $headline = $posts->shift();
        } else {
            $headline = null;
        }

        // news/index.blade.php ファイルを渡している
        // また View テンプレートに headline、 posts、 cond_title という変数を渡している
        return view('news.index', ['headline' => $headline, 'posts' => $posts, 'cond_title' => $cond_title]);
    }
}

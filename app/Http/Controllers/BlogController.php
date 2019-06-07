<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use App\Http\Requests\BlogRequest;
use App\Models\Article;

class BlogController extends Controller
{
    /** @var Article */
    protected $article;

    function __construct(Article $article)
    {
        // Article モデルクラスのインスタンスを作成
        // 「依存注入」により、コンストラクタの引数にタイプヒントを指定するだけで、
        // インスタンスが生成される（コンストラクターインジェクション）
        $this->article = $article;
    }

    public function form(int $id = null)
    {
        // $id == nullの場合は新規記事作成
        // $id != nullの場合は記事の編集
        //     1) 通常編集時
        //     2) validationエラーによるフォーム画面遷移時

        // メソッドの引数に指定すれば、ルートパラメータを取得できる

        // Eloquent モデルはクエリビルダとしても動作するので find メソッドで記事データを取得
        // 返り値は null か App\Models\Article Object
        $article = $this->article->find($id);

        // 記事データがあれば toArray メソッドで配列にしておき、フォーマットした post_date を入れる
        $input = [];
        if ($article) {
            $input = $article->toArray();
        } else {
            $id = null;
        }

        // old ヘルパーを使うと、直前のリクエストのフラッシュデータを取得できる
        // ここではバリデートエラーとなったときに、入力していた値を old ヘルパーで取得する
        // DBから取得した値よりも優先して表示するため、array_merge の第二引数に設定する
        $input = array_merge($input, old());

        // View テンプレートへ値を渡すときは、第二引数に連想配列を設定する
        // View テンプレートでは 連想配列のキー名で値を取り出せる
        // return view('blog.form', ['input' => $input, 'id' => $id]);
        // compact 関数を使うと便利
        return view('blog.form', compact('input', 'id'));
    }

    /**
     * ブログ記事保存処理
     *
     * @param BlogRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function post(BlogRequest $request)
    {
        // 入力値の取得
        $input = $request->input();

        // array_get ヘルパは配列から指定されたキーの値を取り出すメソッド
        // 指定したキーが存在しない場合のデフォルト値を第三引数に設定できる
        // 指定したキーが存在しなくても、エラーにならずデフォルト値が返るのが便利
        $id = array_get($input, 'id');

        // Eloquent モデルから利用できる updateOrCreate メソッドは、第一引数の値でDBを検索し
        // レコードが見つかったら第二引数の値でそのレコードを更新、見つからなかったら新規作成します
        // ここでは id でレコードを検索し、第二引数の入力値でレコードを更新、または新規作成しています
        $article = $this->article->updateOrCreate(compact('id'), $input);

        // リダイレクトでフォーム画面に戻る
        // route ヘルパーでリダイレクト先を指定。ルートのエイリアスを使う場合は route ヘルパーを使う
        // with メソッドで、セッションに次のリクエスト限りのデータを保存する
        return redirect()
            ->route('form', ['id' => $article->id])
            ->with('status', 'Posting OK');
    }

    /**
     * ブログ記事削除処理
     *
     * @param AdminBlogRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(BlogRequest $request)
    {
        // 記事IDの取得
        $id = $request->input('id');

        // Article モデルを取得して delete メソッドを実行することで削除できる
        // このとき万が一 $article が null になる場合も想定して実装するのが良い（今回は紹介のみで使わないので割愛）
        //        $article = $this->article->find($id);
        //        $article->delete();

        // 主キーの値があるなら destroy メソッドで削除することができる
        // 引数は配列でも可。返り値は削除したレコード数
        $result = $this->article->destroy($id);
        $message = ($result) ? 'Delete successed' : 'Delete failed';

        // フォーム画面へリダイレクト
        return redirect()->route('form')->with('message', $message);
    }

    const NUM_PER_PAGE = 10;
    /**
     * ブログ記事一覧画面
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function list()
    {
        $list = $this->article->getArticleList(self::NUM_PER_PAGE);
        return view('blog.blog', compact('list'));
    }
}

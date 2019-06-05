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

    public function form()
    {
        // resources/views 配下にある、どのテンプレートを使うか指定。ディレクトリの階層はピリオドで表現できる
        // この例では resources/views/admin_blog/form.blade.php が読み込まれる
        return view('blog.new');
    }

    /**
     * ブログ記事保存処理
     *
     * @param BlogRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function post(BlogRequest $request)
    {
        // こちらも引数にタイプヒントを指定すると、
        // BlogRequest のインスタンスが生成される（メソッドインジェクション）
        // そして、BlogRequest で設定したバリデートも実行される（フォームリクエストバリデーション）

        // 入力値の取得
        $input = $request->input();

        // create メソッドで複数代入を実行する。
        // 対象テーブルのカラム名と配列のキー名が一致する場合、一致するカラムに一致するデータが入る
        $article = $this->article->create($input);

        // リダイレクトでフォーム画面に戻る
        // route ヘルパーでリダイレクト先を指定。ルートのエイリアスを使う場合は route ヘルパーを使う
        // with メソッドで、セッションに次のリクエスト限りのデータを保存する
        return redirect()->route('admin_form')->with('message', '記事を保存しました');
    }
}

@extends("layouts.common")

@section("title", "blog")

@section("header")
    <a href="{{url('/')}}">トップ</a>
    <a href="{{url('/blog/form')}}">書く</a>
@endsection

@php
    function print_article_stack($stack, $date) {
        echo '<div class="article">
            <h2 class="date">' . $date . '</h2>';
            while (!empty($stack)) {
                $article = array_pop($stack);
                echo '<div class="section">
                    <h3 class="title">' . $article->title . '</h3>
                    <p>' . $article->content . '</p>
                </div>';
            }
        echo '</div>';
    }

    function get_date($article) {
        return substr($article->created_at, 0, 10);
    }
@endphp

@section("content")
    @if (count($list) > 0)
        @php
        $article = $list[0];
        $stack_date = get_date($article);
        $article_stack = [$article];
        @endphp

        @for ($i = 1; $i < count($list); $i++)
            @php
            $article = $list[$i];
            $cur_date = get_date($article);
            @endphp

            @if ($cur_date == $stack_date)
                @php
                array_push($article_stack, $article);
                @endphp
            @else
                @php
                print_article_stack($article_stack, $stack_date);
                $stack_date = $cur_date;
                $article_stack = [$article];
                @endphp
            @endif
        @endfor
        @if (!empty($article_stack))
            @php
            print_article_stack($article_stack, $stack_date);
            @endphp
        @endif
    @endif

    <div class="article">
        <h2 class="date">2019-06-03</h2>
        <div class="section">
            <h3 class="title">浮動小数点数の悲劇</h3>
            <p>
                <a href="http://www-users.math.umn.edu/~arnold/disasters/Patriot-dharan-skeel-siam.pdf">
                    "Roundoff Error and the Patriot Missile"
                </a>
                を読んだ。
            </p>                    
            <p>場面: 1991年2月25日 湾岸戦争 アメリカvsイラク</p>
            <p>結果: イラクのスカッドミサイルがアメリカ陸軍兵舎に向け放たれた。
                アメリカのパトリオットミサイルは迎撃に失敗、28人の兵士が死亡。
            </p>
            <p>原因: パトリオットミサイルのシステムは、内部クロックとして0.1秒ごとにインクリメントするカウンタ
                を採用していた。0.1を2進数の浮動小数点数で表すと循環小数になり、どこかで数を丸める必要がある（実際は仮数部を23bitで保持していた）。
                システム起動から100時間後には、丸めから生じる誤差は、実時間と比べおよそ0.34秒になった。
                迎撃システムの性質上、長時間連続して可動させた上でも、正確な計算が求められるのだろう。0.34秒という誤差は致命的だった。
                実際の直接的な原因は、システム内のタイマーを正確なものに置き換えたとき、
                一部、誤差が存在するタイマーがそのまま残ってしまったことだったようだ。
            </p>
        </div>
        <div class="section">
            <h3 class="title">factorio</h3>
            <p>興味はあるが、費やす時間が数k時間になりそうで二の足。</p>
        </div>
    </div>

    <div class="article">
        <h2 class="date">2019-06-02</h2>
        <div class="section">
            <h3 class="title">SNS</h3>
            <p>Quoraが面白い。</p>
        </div>
    </div>
            
    <div class="article">
        <h2 class="date">2019-06-01</h2>
        <div class="section">
            <h3 class="title">runeとbyte</h3>
            <p>
                Go公式ブログ
                <a href="https://blog.golang.org/strings">"Strings, bytes, runes and characters in Go"</a>
                を読んだ。
                筆者はRob Pike先生。
            </p>
            <p>
                簡単なまとめ。Goのstringは（基本的には）byte型のスライスで実装される。
                byte型は、文字通り1byteのデータを格納する型のこと。
                つまりGoの文字列は1byteのデータ列で表され、ビルトイン関数であるlen()は、そのbyte数を返す。
                （例えばlen("abc"）== 3)
                ただ、multi byteな文字は（例えばひらがなはUTF-8で3byte）byte型には格納できない。
                そんなとき、rune型の出番。
                rune型は4バイト（のint型のエイリアス）で表され、Unicodeのcode pointを格納する。
                Goではシングルクォートで囲むとrune型に、ダブルだとstring型になる。
            </p>
            <p>
                英語が読みやすい。筆者はUTF-8開発者の一人でもある。CSの力もあり文章力もあり、すごい。
            </p>
        </div>
    </div>

    <div class="article">
        <h2 class="date">2019-05-29</h2>
        <div class="section">
            <h3 class="title">エディタの移ろい</h3>
            <p>atom -> emacs -> vscode | sublime text</p>
            <p>atom: はじめてのエディタ。きれいな見た目に感動。いつからかGoシンタックスハイライトが変になり、離脱。</p>
            <p>emacs: デフォルトに保管機能がなかった。ただkey bindの取得はとても有用だった。ありがとう。</p>
            <p>vscode: 現在のメイン。</p>
            <p>sublime: vscodeより軽く、簡単な作業にはこちら。ダークテーマが今ひとつかな。</p>
        </div>
    </div>
@endsection

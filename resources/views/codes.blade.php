@extends("layouts.common")

@section("title", "codes")

@section("header")
    <a href="{{url('/')}}">トップ</a>
@endsection

@section("content")
    <div class="article">
        <h3 class="title">
            <a class="code" href="https://github.com/Toasa/tgoc">tgoc</a>
        </h3>
        <p>Goで書いたGoコンパイラ。セルフホストを目指している（未）</p>
    </div>

    <div class="article">
        <h3 class="title">
            <a class="code" href="https://github.com/Toasa/g9cc">g9cc</a>
        </h3>
        <p>Goで書いたCコンパイラ。Rui Ueyamaさんの<a href="https://github.com/rui314/9cc">実装</a>を真似たもの。</p>
    </div>

    <div class="article">
        <h3 class="title">
            <a class="code" href="https://github.com/Toasa/bf_interpreter">bf interpreter</a>
        </h3>
        <p>C言語で書いたbrainf*ckインタプリタ</p>
    </div>

    <div class="article">
        <h3 class="title">
            <a class="code" href="https://github.com/Toasa/zelkova">zelkova</a>
        </h3>
        <p>web上にある欅坂のブログをスクレイピングし、文章をmecabを用いて形態素に分解し、
            単語ベクトルを生成し、LSTM（RNNの一種）でブログを自動生成した。</p>
    </div>

    <div class="article">
        <h3 class="title">
            <a class="code" href="https://github.com/Toasa/auto_diff">auto diff</a>
        </h3>
        <p>Python3の抽象構文木から、計算グラフを生成し、トップダウン型の自動微分を計算する。</p>
    </div>

    <div class="article">
        <h3 class="title">
            <a class="code" href="https://github.com/Toasa/base_podcast">base podcast</a>
        </h3>
        <p>RSSフィードからエピソードの一覧を表示し、再生ページのリンク先へ飛べる、androidアプリ。
            現在"Rebuild.fm", "tcfm", "misreading chat", "bilingual news"に対応。</p>
        </div>

    <div class="article">
        <h3 class="title">
            <a class="code" href="https://github.com/Toasa/t_mattix">t mattix</a>
        </h3>
        <p>数を取りあうゲーム。総計が多いと勝ち。</p>
    </div>

    <div class="article">
        <h3 class="title">
            <a href="https://github.com/Toasa/bbs">bbs</a>
        </h3>
        <p>ajax通信を利用した掲示板DB。はMySQL。JSフレームワークとしてvue.jsを使用。</p>
    </div>

@endsection
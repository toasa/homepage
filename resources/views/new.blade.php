@extends("layouts.common")

@section("title", "new")

@section("header")
    <a href="{{url('/')}}">トップ</a>
    <a href="{{url('/blog')}}">戻る</a>
@endsection

@section("content")
    <div class="article">
        <p><input type="text" name="title" size="40"></p>
        <p><textarea name="content" cols="100" rows="20"></textarea></p>
        <button>投稿</button><button>追加section</button>
    </div>
@endsection

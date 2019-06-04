@extends("layouts.common")

@section("title", "top")

@section("h1_title")
    <h1>とあさのうみ</h1>
@endsection

@section("content")
    <h2>このサイトは?</h2>
	<p>ブログや書いたコードをおいています。</p>
	<div>
		<a href="{{url('/blog')}}">ブログ</a>
	</div>
	<div>
		<a href="{{url('/codes')}}">書いたコード</a>
	</div>
	<h2>SNS</h2>
	<div>
		<a href="https://github.com/toasa">github</a>
	</div>
	<div>
		<a href="https://twitter.com/toasa_3">twitter</a>
	</div>
@endsection
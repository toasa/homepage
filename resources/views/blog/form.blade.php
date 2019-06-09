@extends("layouts.common")

@section("title", "form")

@section("header")
    <a href="{{url('/')}}">トップ</a>
    <a href="{{url('/blog')}}">戻る</a>
@endsection


@section("content")

    {{--if 文による条件分岐--}}
    @if (session('message'))
        <div class="alert alert-success">
            {{--セッションヘルパーを使ってキーを指定して、セッションに保存されたデータを取り出す--}}
            {{ session('message') }}
        </div>
        <br>
    @endif

    {{--$errors は Illuminate\Support\MessageBag インスタンスで、エラーメッセージの操作に便利なメソッドを使うことができる--}}
    {{--バリデートエラーがあった場合は、自動的にエラー内容・メッセージが保存された状態で、元のアドレスにリダイレクトされる--}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                {{--foreach 文によるループ--}}
                {{--エラーメッセージがあるなら、それを全て取り出して表示--}}
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <div class="article">
        <form method="POST" action="{{ route('post') }}">
            <p>
                <input type="text" name="title" value="{{isset($input['title']) ? $input['title'] : ''}}" size="40" placeholder="title">
            </p>
            <p>
                <textarea name="content" cols="100" rows="20" placeholder="content">{{isset($input['content']) ? $input['content'] : ''}}</textarea>
            </p>
            <input type="submit" value="post">
            <input type="hidden" name="id" value="{{ $id }}">
            {{ csrf_field() }}
        </form>

        @if ($id)
            <br>
            <form action="{{ route('delete') }}" method="POST">
                <input type="submit" class="btn btn-primary btn-sm" value="delete">
                <input type="hidden" name="id" value="{{ $id }}">
                {{ csrf_field() }}
            </form>
        @endif
    </div>
@endsection

{{-- layouts/profile.blade.phpを読み込む --}}
@extends('layouts.profile')


{{-- admin.blade.phpの@yield('title')に'ニュースの新規作成'を埋め込む --}}
@section('title', 'Myプロフィール')

{{-- admin.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>Myプロフィール</h2>
                <form action="{{ action('Admin\ProfileController@create') }}" method="post" enctype="multipart/form-data">
 <!--$errorsはvalidateで弾かれた内容を記憶する配列,
countメソッドは配列の個数を返す
もしエラーがなければ$errorsはnullを返し、count($errors)は0を返す-->

@if (count($errors) > 0)               
 
    <ul>
    <!--foreachは配列の数だけループする
    $errorsの中身の数だけループし、その中身を$eに代入-->
        @foreach($errors->all() as $e)
        <!--$eの中身を表示-->
            <li>{{ $e }}</li>
        @endforeach
    </ul>
@endif
<div class="form-group row">
    <label class="col-md-2" for="title">氏名</label>
    <div class="col-md-10">
        <input type="text" class="form-control" name="name" value="{{ old('title') }}">
    </div>
</div>
<div class="form-group row">
    <label class="col-md-2" for="title">性別</label>
    <div class="col-md-10"> 
        <input type="text" class="form-control" name="gender" value="{{ old('title') }}">     
    </div>
</div>
<div class="form-group row">
    <label class="col-md-2" for="title">趣味</label>
    <div class="col-md-10">
        <input type="text" class="form-control" name="hobby" value="{{ old('title') }}">
    </div>
</div>
    <div class="form-group row">
    <label class="col-md-2" for="body">自己紹介</label>
    <div class="col-md-10">
        <textarea class="form-control" name="introduction" rows="20">{{ old('body') }}</textarea>
    </div>
</div>
{{ csrf_field() }}
<input type="submit" class="btn btn-primary" value="更新">
</form>
            </div>
        </div>
    </div>
@endsection
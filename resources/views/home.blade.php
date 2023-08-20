{{-- adminLTEの基本構造 --}}

{{-- adminLTEのテンプレートを継承 --}}
@extends('adminlte::page')

{{-- タイトル --}}
@section('title', 'Dashboard')

{{-- ヘッダー --}}
@section('content_header')
    <h1>Dashboard</h1>
@stop

{{-- 本文 --}}
@section('content')
    <a class="btn btn-default btn-flat float-right btn-block " href="http://192.168.56.56/login" class="mb-5">login</a>
    <a class="btn btn-default btn-flat float-right btn-block " href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        Logout
    </a>
    <hr>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <h2 class="mt-5">Qiita検索エンジン</h2>
                <div class="row">
                    <form action="{{route('serachDashBorad')}}" method="post">
                        @csrf
                        <input type="text" name="search_text">
                        <button type="submit" class="btn btn-primary">検索</button>
                    </form>
                </div><!-- /.row -->
                @if ($errors->any())
                <div class="alert alert-warning alert-dismissible mt-3">
                    {{-- エラーの表示 --}}
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
        @endif
            </div><!-- /.col-md-10 -->
        </div>
            
        <div class="row justify-content-center">
            <div class="col-md-11">
                <table class="table table-striped table-dark mt-2">
                    <tr>
                        <th>タイトル</th>
                        <th>いいね数</th>
                        <th>コメント数</th>
                        <th>作成日</th>
                        <th>URL</th>
                    </tr>
                    @if(isset($result))
                        @foreach($result as $post)
                        <tr>
                            <td>{{$post['title']}}</td>
                            <td>{{$post['likes_count']}}</td>
                            <td>{{$post['comments_count']}}</td>
                            <td>{{$post['created_at']}}</td>
                            <th><a href="{{$post['url']}}" target="_blank" rel="noopener noreferrer">URL</a></th>
                        </tr>
                        @endforeach
                    @endif
                </table>
            </div>
        </div>
    </div>
@stop

{{-- adminLTE 標準CSS読み込み --}}
@section('css')

@stop

{{-- js読み込み --}}
@section('js')

@stop
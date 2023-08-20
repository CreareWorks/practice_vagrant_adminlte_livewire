{{-- adminLTEの基本構造 --}}
{{-- adminLTEのテンプレートを継承 --}}
@extends('adminlte::page')
{{-- タイトル --}}
@section('title', 'Profile')
{{-- ヘッダー --}}
@section('content_header')
    <h1 id="test">Profile</h1>
@stop
{{-- 本文 --}}
@section('content')

    <div class="row mb-3">
        <p class="col-12">
            ユーザー名
            <span class="text-info">|</span>
            {{Auth::user()->name}}
        </p>    
    </div>

    <h2>非同期テーブル練習</h2>
    <div>
        <h3>絞り込み検索</h3>
        <div class="row">
            <div class="form-group col-6">
                <label for="contract_text">契約</label>
                <input id="contract_text" name="contract_text" class="form-control" type="text">
            </div>
            <div class="form-group col-6">
                <label for="earnings_text">売上</label>
                <input id="earnings_text" name="earnings_text" class="form-control" type="text">
            </div>
        </div>
        <button type="submit" id="target_ajax_btn" class="btn btn-primary">検索</button>
    </div>
    <table class="table" id="ajax_table">
        <thead>
            <tr>
                <th>id</th>
                <th>契約名</th>
                <th>売上</th>
            </tr>
        </thead>
        <tbody>
            {{-- ajaxで出力する。 --}}
        </tbody>
    </table>
    
    <h2 class="mt-5">契約一覧</h2>
    <table class="table" id="contract_table">
        <thead>
            <tr>
                <th>No</th>
                <th>契約名</th>
                <th>売上</th>
            </tr>
        </thead>

        <tbody>
            <input type="hidden" value="{{$count = 1}}">
            @foreach ($user_meta as $user)
                <tr>
                    <td>{{$count++}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->price}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2 class="mt-5">イラスト投稿一覧</h2>
    <table class="table" id="illust_table">
        <thead>
            <tr>
                <th>No</th>
                <th>タイトル</th>
                <th>イラスト</th>
            </tr>
        </thead>

        <tbody>
            <input type="hidden" value="{{$count_B = 1}}">
            @foreach ($illusts_meta as $illust)
                <tr>
                    <td>{{$count_B++}}</td>
                    <td>{{$illust->title}}</td>
                    <td>
                        <img src="{{$illust->toDataURL}}" alt="">
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@stop
{{-- adminLTE 標準CSS読み込み --}}
@section('css')
    <link rel="stylesheet" href="assets/css/profile_table.css">
@stop
{{-- js読み込み --}}
@section('js')
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
    {{-- DataTables練習 --}}
    <script src="/js/profile_table.js"></script>
@stop

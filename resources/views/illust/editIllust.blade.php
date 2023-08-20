@extends('adminlte::page')

@section('title', 'イラスト編集画面')

@section('content_header')
    <h1>イラスト編集</h1>
@stop

@section('content')

    <div class="row mb-3 mt-3">
        <label for="target_title" ass="form-label">タイトル：</label>
        <input id="target_title" type="text" class="form-controller" value="{{$editIllust->title}}">
    </div><!-- /.row -->

    <p>描画スペース</p>
    {{-- 描画 --}}
    <div class="row">
        <canvas id="canvas" name="toDataURL" class="mb-3" width="500" height="300" style="border: solid 1px #000;box-sizing: border-box;"></canvas>
        <div class="ml-3">
            <div class="option">
                <div class="color">
                    色：
                    <a href="" class="black" data-color="0, 0, 0, 1"></a>
                    <a href="" class="white" data-color="255, 255, 255, 1"></a>
                    <a href="" class="red" data-color="255, 0, 0, 1"></a>
                    <a href="" class="blue" data-color="0, 0, 255, 1"></a>
                    <a href="" class="yellow" data-color="255, 255, 0, 1"></a>
                    <a href="" class="green" data-color="0, 255, 0, 1"></a>  
                </div>
                <div class="bold">
                    太さ：
                    <a href="" class="small" data-bold="1">小</a>
                    <a href="" class="middle" data-bold="5">中</a>
                    <a href="" class="large" data-bold="10">大</a>
                </div>
            </div>
            <input type="button" value="clear" id="clear">
            <a id="download" href="#" download="canvas.jpg">ダウンロード</a>
            <div class="mt-2">
                <button id="target_submit_btn" class="btn btn-primary">編集ボタン</button>
                <a href="{{route('showIllustDisplay')}}" class="btn btn-primary">戻る</a>
            </div>
        </div>
    </div>

    <p id="target_msg" class="text-red mt-3"></p>
@stop

{{-- CSS読み込み --}}
@section('css')
    <link href="{{asset('/assets/css/illust.css')}}" rel="stylesheet">
@stop

{{-- js読み込み --}}
@section('js')
    <script>
        window.Laravel = {};
        window.Laravel.toDataURL = @json($editIllust->toDataURL);
        window.Laravel.id = @json($editIllust->id);
    </script>
    <script src="/js/edit_illust.js"></script>
@stop
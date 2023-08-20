@extends('adminlte::page')

@section('title', 'イラスト掲示板')

@section('content_header')
    <h1>イラスト投稿</h1>
@stop

@section('content')
    @if (session('message'))
        <div class="alert alert-info alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                ×
            </button>
            {{ session('message') }}
        </div>
    @endif

    {{-- 描画 --}}
    <div class="row">
        <canvas id="canvas" class="mb-3" width="500" height="300" style="border: solid 1px #000;box-sizing: border-box;"></canvas>
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
                <input type="text" id="title" placeholder="タイトル">
            </div>
            <div class="mt-2">
                <button id="target_submit_btn" class="btn btn-primary" disabled>投稿ボタン</button>
            </div>
        </div>
    </div>
    
    {{-- 一覧 --}}
    <h2 class="mt-5">イラスト投稿一覧</h2>
    <div class="row mt-3" id="target_illust_upload">
        @foreach ($illust_meta as $illust)
            <div class="row mt-4 border-bottom target_illust_delete">
                <img src="{{$illust->toDataURL}}" class="col-8 mb-3 border">
                <div class="col-4">
                    <p>ユーザー：{{$illust->user_name}}</p>
                    <p>タイトル：{{$illust->title}}</p>
                    @if( Auth::id() === $illust->user_id )
                        <div class="row">
                            <a class="btn btn-primary" href="{{route('showEditIllust', $illust->id)}}" role="button">編集</a>
                            <form action="{{ route('deleteIllust', $illust->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger ml-3" onclick="return confirm('削除してもよろしいですか?');">
                                    削除
                                </button>
                            </form>
                        </div>
                        <div class="row">
                            <a class="btn btn-primary mt-3" href="{{route('showCommentIllust',$illust->id)}}" role="button">コメント一覧</a>
                        </div><!-- /.row -->
                    @endif
                </div>
            </div>
        @endforeach
    </div><!-- /.row -->

    {{-- ページネーション --}}
    @if ($illust_meta->hasPages())
        <div class="card-footer clearfix">
            {{ $illust_meta->links() }}
        </div>
    @endif

@stop

{{-- CSS読み込み --}}
@section('css')
    <link href="{{asset('/assets/css/illust.css')}}" rel="stylesheet">
@stop

{{-- js読み込み --}}
@section('js')
    <script src="/js/illust.js"></script>
@stop
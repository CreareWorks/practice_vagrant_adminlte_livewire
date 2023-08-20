@extends('adminlte::page')

@section('title', 'コメント一覧')

@section('content_header')
    <h1 class="mb-3">コメント一覧</h1>
@stop

@section('content')

    @if ($errors->any())
        <div class="alert alert-warning alert-dismissible">
            {{-- エラーの表示 --}}
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success_message'))
        <div class="alert alert-info alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                ×
            </button>
            {{ session('success_message') }}
        </div>
    @endif

    <div class="container-fluid">
        {{-- コメント投稿 --}}
        <form action="{{route('storeCommentIllust', request()->id)}}" method="post">
            @csrf
            <div class="form-group">
                <label for="input_comment">コメントを投稿</label>
                <input type="text" id="input_comment" name="input_comment" class="form-control">
            </div><!-- /.form-group -->
            <input type="submit" name="comment_btn" class="btn-primary">
        </form>

        {{-- コメント一覧 --}}
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>コメント投稿者</th>
                    <th>本文</th>
                    <th>編集/削除</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($comment_meta as $comment)
                    <tr>
                        <td>
                            @foreach ($user as $meta)
                                @if ($meta->id == $comment->user_id)
                                    {{$meta->name}}
                                @endif
                            @endforeach
                        </td>
                        <td>{{$comment->comment_body}}</td>
                        <td>
                            <div class="row">
                                <a class="btn btn-primary col-6 text-center" href="{{route('showEditComment', $comment->id)}}">編集</a>
                                <form action="{{route('deleteCommentIllust', [$comment->id, request()->id])}}" method="post" class="col-6 text-center">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('削除してもよろしいですか?');">
                                        削除
                                    </button>
                                </form>
                            </div><!-- /.row -->
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a class="btn btn-primary mb-3" href="{{route('showIllustDisplay')}}">戻る</a>
    </div><!-- /.container-fluid -->
@stop

{{-- CSS読み込み --}}
@section('css')
    
@stop

{{-- js読み込み --}}
@section('js')
    
@stop
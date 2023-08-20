@extends('adminlte::page')

@section('title', 'コメント編集')

@section('content_header')
    <h1 class="mb-3">コメント編集</h1>
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

    @if (session('success_message2'))
        <div class="alert alert-info alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                ×
            </button>
            {{ session('success_message2') }}
        </div>
    @endif

    <div class="container-fluid">
        {{-- コメント投稿 --}}
        <form action="{{route('editCommentIllust', $comment->id)}}" method="post">
            @csrf
            @method('put')
            <div class="form-group">
                <label for="input_comment">コメントを編集</label>
                <input type="text" value="{{$comment->comment_body}}" id="input_comment" name="input_comment" class="form-control">
            </div><!-- /.form-group -->
            <input type="submit" name="comment_btn" class="btn btn-primary" value="編集">
        </form>

        <a class="btn btn-primary mt-3" href="{{route('showCommentIllust', $comment->illusts_id)}}">戻る</a>
    </div><!-- /.container-fluid -->
@stop

{{-- CSS読み込み --}}
@section('css')
    
@stop

{{-- js読み込み --}}
@section('js')
    
@stop
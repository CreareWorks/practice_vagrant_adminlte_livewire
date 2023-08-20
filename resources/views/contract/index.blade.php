{{-- adminLTEのテンプレートを継承する --}}
@extends('adminlte::page')

@section('title', '契約一覧')

@section('content_header')
    <h1>契約一覧</h1>
@stop

@section('content')
    {{-- completeMsg! --}}
    @if (session('message'))
        <div class="alert alert-info alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                ×
            </button>
            {{ session('message') }}
        </div>
    @endif

    {{-- 新規登録画面へ --}}
    <a class="btn btn-primary mb-2" href="{{ route('contract.create') }}" role="button">新規登録</a>

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>社員名</th>
                        <th>契約名</th>
                        <th>売上</th>
                        <th style="width: 75px"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($contracts as $contract)
                        <tr>
                            <td>{{$contract->users_name}}</td>
                            <td>{{ $contract->name }}</td>
                            {{-- 数字フォーマット --}}
                            <td>{{ number_format($contract->price) }}</td>
                            <td>
                                <a class="btn btn-primary btn-sm mb-2" href="{{ route('contract.edit', $contract->id) }}" role="button">編集</a>
                                <form action="{{ route('contract.destroy', $contract->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    {{-- 簡易的に確認メッセージを表示 --}}
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('削除してもよろしいですか?');">
                                        削除
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- ページネーション --}}
            @if ($contracts->hasPages())
                <div class="card-footer clearfix">
                    {{ $contracts->links() }}
                </div>
            @endif
        </div>
    </div>
@stop
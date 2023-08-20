<div>
    <div class="col-12 pt-5">

        {{-- Create子コンポーネントを埋め込み --}}
        <div class="col-5 mx-auto">
            <livewire:contract.create/>
        </div>
        {{-- 追記ここまで --}}

        @foreach($data as $board)
            <div class="card col-5 mx-auto">
                <div class="card-body">
                    <p>{{ $board->name }}</p>
                    <p>{{ $board->price }}</p>
                </div>
            </div>
        @endforeach
    </div>
</div>

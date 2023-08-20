<div>
    <form wire:submit.prevent="create">
        <x-adminlte-modal wire:ignore.self id="createModal" title="書きこむ" size="md" theme="teal" v-centered
                          static-backdrop scrollable>
            <div class="card">
                <div class="card-body">
                    @if (session()->has('createMessage'))
                        <x-adminlte-alert theme="success" title="Success">
                            {{ session('createMessage') }}
                        </x-adminlte-alert>
                    @else
                        <x-adminlte-input name="name" label="名前" wire:model.lazy="name"/>

                        <x-adminlte-textarea name="price" label="金額" rows=5 wire:model.lazy="price">
                        </x-adminlte-textarea>

                        {{-- @foreach($tags as $tag) --}}
                            {{-- <div class="custom-control custom-checkbox custom-control-inline"> --}}
                                {{-- <input type="checkbox" class="custom-control-input" id="{{ $tag->id }}" --}}
                                       {{-- value="{{ $tag->id }}" wire:model.lazy="select_tags"> --}}
                                {{-- <label class="custom-control-label" for="{{ $tag->id }}">{{ $tag->name }}</label> --}}
                            {{-- </div> --}}
                        {{-- @endforeach --}}
                    @endif
                </div>
            </div>
            <x-slot name="footerSlot">
                <div class="col">
                    <div class="row">
                        <div class="col-6">
                            @if (!session()->has('createMessage'))
                                <x-adminlte-button type="submit" class="btn-lg btn-block" label="登録" theme="success"/>
                            @endif
                        </div>
                        <div class="col-6">
                            <x-adminlte-button theme="secondary" class="btn-lg btn-block" label="閉じる"
                                               data-dismiss="modal"/>
                        </div>
                    </div>
                </div>
            </x-slot>
        </x-adminlte-modal>
    </form>

    <x-adminlte-button label="書きこむ" data-toggle="modal" class="bg-teal mb-3" wire:click="openModal()"/>

    <script>
        //モーダル展開用            
        window.addEventListener('show_create_modal', event => {
            $('#createModal').modal('show');
        });
    </script>
</div>
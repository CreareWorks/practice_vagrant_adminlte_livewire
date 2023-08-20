<?php

namespace App\Http\Livewire\Contract;

use Livewire\Component;
use App\Models\contracts;
use Illuminate\Support\Facades\Auth;

class Create extends Component
{
    //public $tags;
    //public $select_tags = [];
    public $name;
    public $price;

    protected $rules = [
        'name' => 'required',
        'price' => 'required',
    ];

    protected $validationAttributes = [
        'name' => '名前',
        'price' => '金額'
    ];

    //バリデーションの日本語ファイル用意するのが面倒だったので'required'だけ書き換え
    protected $messages = [
        'required' => ':attributeは必ず指定してください。',
    ];

    //コンストラクタ的な役割、プロパティの初期化とかに使う
    //mountはページが開いた時に一度だけ動く。
    //public function mount()
    //{
    //    //$this->tags = Tag::all();
    //}

    //メイン、更新が入ると走る
    public function render()
    {
        return view('livewire.contract.create');
    }

    //モーダル展開用
    public function openModal()
    {
        //jsのイベントを発火させる
        $this->dispatchBrowserEvent('show_create_modal');
    }

    //書き込み処理
    public function create(contracts $contract)
    {
        //バリデーション発動、ひっかかったらここで止まります
        $this->validate();

        //投稿情報作成
        $contract->user_id = Auth::id();
        $contract->name = $this->name;
        $contract->price = $this->price;

        $contract->save();

        //フラッシュメッセージ
        session()->flash('createMessage', 'かきこんだよ');

        //全てのプロパティを初期化。mountで設定した値も消える
        $this->reset(['name','price']);

        //親コンポーネントのrefreshイベント発火
        $this->emitUp('RefreshBoard');
    }
}

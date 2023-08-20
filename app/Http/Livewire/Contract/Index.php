<?php

namespace App\Http\Livewire\Contract;

use Livewire\Component;
use App\Models\contracts;

class Index extends Component
{

    protected $listeners = ['RefreshBoard' => '$refresh'];

    public function render()
    {
        $data = contracts::orderBy('id','desc')->get();
        return view('livewire.contract.index',compact('data'))
            ->extends('adminlte::page')
            ->section('content');
    }
}

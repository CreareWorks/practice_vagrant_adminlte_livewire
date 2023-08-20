<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\contracts;
use App\Http\Requests\contractRequest;
use Illuminate\Support\Facades\Auth;

class contractController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contracts = contracts::select(
                'users.name as users_name',
                'contracts.id',
                'contracts.name',
                'contracts.price'
            )
        ->join('users', 'contracts.user_id', '=', 'users.id')
        ->orderBy('contracts.id', 'desc')
        ->paginate(5);

        return view(
            'contract.index',
            ['contracts' => $contracts]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contract.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(contractRequest $request, contracts $contract)
    {

        $contract->user_id = Auth::id();
        $contract->name = $request->name;
        $contract->price = $request->price;

        $contract->save();

        return redirect()->route('contract.index')->with('message', '登録しました');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contract = contracts::find($id);

        return view('contract.edit',[
            'contract' => $contract
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(contractRequest $request, $id)
    {
        $contract = contracts::find($id);

        $contract->fill($request->all())->save();

        return redirect()->route('contract.index')->with('message','編集しました。');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        contracts::where('id',$id)->delete();

        return redirect()->route('contract.index')->with('message','削除しました。');
    }
}

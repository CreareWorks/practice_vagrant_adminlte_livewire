<?php
namespace App\Http\Services;

use App\Models\contracts;
use App\Models\illusts;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;
use App\Http\Services\PracticeAbstractUserService;

class UserService extends PracticeAbstractUserService
{
    //abstractを継承している為、PracticeAbstractUserService内、抽象メソッドは必ず実行しなければいけない。
    //使い方の例として、使用したいmodelのインスタンスを生成する為に使ったりする。→この場合、コンストラクタで定義しておくと良い。
    public function test()
    {   
        $test = "test";
        return $test;
    }

    public function __construct()
    {
        //当classインタンス生成時に抽象メソッドであるtest()を実行
        $this->test();
    }

    //抽象classのtest2()をオーバライドしてみる。(このメソッドを生かしたまま、当classでtest2()を呼び出すと"オーバーライド"が返却される)
    //ここでオーバーライドせずに、当classでtest2()を呼び出すとPracticeAbstractUserServiceで定義された内容を参照する。(つまり"test"が返ってくる)
    //抽象classで予めpublic定義しておけば、そのまま使用する事もできるし、オーバーライドして機能によって中身を書き換えて使用する事ができる。
    //public function tset2()
    //{
    //    $result = "オーバーライド";
    //    return $result;
    //}

    /**
     * ダッシュボード表示
     * get
     */
    public function showDashBorad()
    {
        //抽象class練習 呼び出し
        //dd($this->tset2());
        
        //cURL error 6: Could not resolve host: qiita.comがでて画面アクセス不可になる為一旦殺す

        //$tag_id = "Laravel";

        //$url = "https://qiita.com/api/v2/tags/" . $tag_id . "/items?page=1&per_page=20";
        //$method = "GET";

        ////接続
        //$client = new Client();

        //$response = $client->request($method, $url);

        //$result = $response->getBody();

        $result = "";

        return $result = json_decode($result, true);

    }

    /**
     * DashBorad検索
     * post
     * 
     * @return void
     */
    public function serachDashBorad($tag_id)
    {
        //実際にはURLパラメーター渡して値を変更したりする
        $url = "https://qiita.com/api/v2/tags/" . $tag_id . "/items?page=1&per_page=20";
        $method = "GET";

        //接続
        $client = new Client();

        $response = $client->request($method, $url);

        $result = $response->getBody();

        return $result = json_decode($result, true);

    }


    /**
     * プロフィール画面表示用
     *
     * @return void
     */
    public function getUserMeta()
    {
        return contracts::select(
            'users.name as user_name',
            'contracts.name',
            'contracts.price'
        )
        ->join('users', 'contracts.user_id', '=', 'users.id')
        ->where('users.id', '=', Auth::id())
        ->get();
    }

    /**
     * イラストデータ(プロフィール表示用)
     */
    public function getIllustsMeta()
    {
        return illusts::select(
            'illusts.title',
            'illusts.toDataURL'
        )
        ->join('users', 'illusts.user_id', '=', 'users.id')
        ->where('users.id', '=', Auth::id())
        ->get();
    }


    /**
     * password変更
     */
    public function changePassword($requset) {

        $user = User::find(Auth::id());

        $user->password = $requset->password;

        $user->save();
        
    }

    /**
     * 名前変更
     */
    public function changeName($requset) {
        $user = User::find(Auth::id());

        $user->name = $requset->name;

        $user->save();
    }

    /**
     * ajaxで検索、テーブル出力(admin向けを想定)
     */
    public function ajaxTable($request)
    {
        $query = contracts::select(
            'contracts.id',
            'contracts.name',
            'contracts.price'
        );

        if($request->filled("contract_text")) {
            $query->where('contracts.name', '=', $request->contract_text);
        }
        if($request->filled("earnings_text")) {
            $query->where('contracts.price', '=', $request->earnings_text);
        }

        return $query->get();
    }
}
?>
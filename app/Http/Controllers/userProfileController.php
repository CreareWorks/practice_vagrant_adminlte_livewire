<?php

namespace App\Http\Controllers;

use App\Http\Services\UserService;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\ChngeUserNameRequset;
use App\Http\Requests\SearchDashboradRequest;
use Illuminate\Http\Request;

class userProfileController extends Controller
{
    private $user_service;
    public function __construct(
        UserService $user_service
    )
    {
        $this->user_service = $user_service;
    }

    /**
     * dashbord表示
     */
    public function showDashBorad()
    {
        $result = $this->user_service->showDashBorad();
        return view('home',[
            'result' => $result
        ]);
    }

    /**
     * DashBorad Qiita検索
     */
    public function serachDashBorad(SearchDashboradRequest $request)
    {
        if ($request->has('search_text')) {
            $tag_id = $request->search_text;
        } else {
            //error文言を返す
            return redirect()->route('showDashBorad');
        }

        $result = $this->user_service->serachDashBorad($tag_id);
        return view('home',[
            'result' => $result
        ]);
    }

    /**
     * プロフィール画面を表示
     *
     * @return void
     */
    public function showProfile(){

        $profile_meta = $this->user_service->getUserMeta();
        $illusts_meta = $this->user_service->getIllustsMeta();
        
        return view(
            'user.userProfile',
            [
                'user_meta' => $profile_meta,
                'illusts_meta' => $illusts_meta
            ]
        );

    }

    /**
     * パスワード変更画面を表示
     *
     * @return void
     */
    public function showChangePassword() {
        return view('user.changePassword');
    }

    /**
     * パスワード変更
     *
     * @return void
     */
    public function changePassword(ChangePasswordRequest $requset) {

        $this->user_service->changePassword($requset);

        return redirect()->route('showPassword')->with('message','変更完了しました。');
    }


    /**
     * 名前変更画面表示
     *
     * @param ChngeUserNameRequset $requset
     * @return void
     */
    public function showChangeName() {
        return view('user.changeUserName');
    }

    /**
     * 名前変更
     */
    public function changeName(ChngeUserNameRequset $requset) {

        $this->user_service->changeName($requset);

        return redirect()->route('showUserName')->with('message', '変更完了しました。');

    }

    /**
     * ajax
     */
    public function ajaxTable(Request $request)
    {
        $result = $this->user_service->ajaxTable($request);

        return response()->json($result);
    }

}

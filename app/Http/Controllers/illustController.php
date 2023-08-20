<?php

namespace App\Http\Controllers;

use App\Http\Services\IllustService;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Request;
use App\Models\User;
use App\Http\Requests\illustCommentRequest;

class illustController extends Controller
{
    private $illust_service;
    public function __construct(
        IllustService $illust_service
    )
    {
        $this->illust_service = $illust_service;
    }


    /**
     * イラスト投稿一覧表示
     *
     * @return void
     */
    public function showIllustDisplay() {
        
        $illust_meta = $this->illust_service->getIllustMeta();

        return view(
            'illust.illustLIsts',
            ['illust_meta' => $illust_meta]
        );

    }

    /**
     * イラスト一覧画面(新規投稿
     *
     * @param Request $requset
     * @return void
     */
    public function uploadIllust(Request $requset) {
        return $this->illust_service->uploadIllust($requset);
    }

    public function deleteIllust($id){
        return $this->illust_service->deleteIllust($id);
    }


    /**
     * イラスト編集画面
     *
     * @param [type] $id
     * @return void
     */
    public function showEditIllust($id) {
        $result = $this->illust_service->showEditIllust($id);

        //他ユーザーによるアクセスを制御
        if($result === null){
            return redirect()->route('showIllustDisplay');
        };

        return view(
            'illust.editIllust',
            ['editIllust' => $result]
        );
    }


    /**
     * イラスト更新
     */
    public function updateIllust($id, Request $request) {

        return $this->illust_service->updateIllust($id,$request);
        
    }

    /**
     * コメント表示
     */
    public function showCommentIllust($id) {

        $result = $this->illust_service->showCommentIllust($id);
        $user = User::all();

        return view(
            'illust.commentIllust',
            [
                'comment_meta' => $result,
                'user' => $user
            ]
        );

    }

    /**
     * コメント投稿
     */
    public function storeComment(int $id,illustCommentRequest $request)
    {
        $this->illust_service->storeCommentIllust($id,$request);

        return redirect()->route('showCommentIllust',$id)
        ->with('success_message','正常に投稿しました。');
        
    }

    /**
     * コメント削除
     */
    public function deleteComment($comment_id,$illust_id)
    {
        $this->illust_service->deleteComment($comment_id);

        return redirect()->route('showCommentIllust', $illust_id)
        ->with('success_message','正常に削除しました。');
    }

    /**
     * コメント編集画面表示
     */
    public function showEditComment($id)
    {
        $result = $this->illust_service->showEditComment($id);

        return view(
            'illust.editCommentIllust',
            [
                'comment' => $result,
            ]
        );
    }

    /**
     * コメント編集
     */
    public function editCommentIllust(int $id, illustCommentRequest $request)
    {
        $this->illust_service->editCommentIllust($id, $request);

        return redirect()->route('showEditComment',$id)->with('success_message2','編集完了しました。');
    }

}

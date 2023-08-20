<?php
namespace App\Http\Services;


use App\Models\User;
use App\Models\illusts;
use App\Models\illustComments;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class IllustService
{

    /**
     * Undocumented function
     *
     * @return void
     */
    public function getIllustMeta() {
        return illusts::select(
            'users.name as user_name',
            'users.id as user_id',
            'illusts.id',
            'illusts.title',
            'illusts.toDataURL'
        )
        ->join('users', 'illusts.user_id', '=', 'users.id')
        ->orderBy('illusts.id', 'desc')
        ->paginate(10);
    }

    /**
     * Undocumented function
     *
     * @param [type] $requset
     * @return void
     */
    public function uploadIllust($requset) {
        $illusts = new illusts();

        $illusts->user_id = Auth::id();
        $illusts->title = $requset->title;
        $illusts->toDataURL = $requset->toDataURL;
        $illusts->canvas_meta = $requset->canvas_meta;

        $illusts->save();

        $value = illusts::select(
            'users.name as user_name',
            'illusts.id',
            'illusts.title',
            'illusts.toDataURL'
        )
        ->join('users', 'illusts.user_id', '=', 'users.id')
        ->where('users.id', '=', Auth::id())
        ->orderBy('illusts.id', 'desc')
        ->first();

        $output_toDataURL = $value['toDataURL'];
        $output_user_name = $value['user_name'];
        $output_title = $value['title'];
        $output_id = $value['id'];
        $token = session('_token');

$result[] = <<<EOM
<p class="mt-3 text-danger">イラスト投稿完了しました。</p>
<div class="row mt-4 border-bottom target_illust_upload">
    <img src="$output_toDataURL" class="col-8 mb-3">
    <div class="col-4">
        <p>ユーザー：$output_user_name</p>
        <p>タイトル：$output_title</p>
    </div>
    <div class="row">
        <a class="btn btn-primary" href="http://192.168.56.56/showEditIllust/$output_id" role="button">編集</a>
        <form action="http://192.168.56.56/deleteIllust/$output_id" method="post">
            <input type="hidden" name="_token" value="$token">
            <input type="hidden" name="_method" value="DELETE">
            <button type="submit" class="btn btn-danger ml-3" onclick="return confirm('削除してもよろしいですか?');">
                削除
            </button>
        </form>
    </div>
</div>
EOM;

        return $result;
    }

    /**
     * イラスト削除
     *
     * @param [type] $id
     * @return void
     */
    public function deleteIllust($id) 
    {
        illusts::where('id',$id)->delete();
        return redirect()->route('showIllustDisplay')->with('message','削除しました。');
    }


    /**
     * 編集画面表示
     */
    public function showEditIllust($id)
    {
        return illusts::select(
            'id',
            'title',
            'toDataURL',
            'user_id'
        )
        ->where('id', $id)
        ->first();
    }


    /**
     * イラスト更新
     */
    public function updateIllust($id,$requset)
    {
        return illusts::where('id',$id)
        ->update([
            'title' => $requset->title,
            'toDataURL' => $requset->toDataURL
        ]);
    }

    /**
     * コメント表示
     */
    public function showCommentIllust($id) 
    {
        $illust = illusts::find($id);

        //hasManyで指定している為、JOINせずに返却
        //illustsテーブルのリレーション先である、illustsCommentsテーブルを参照
        return $illust->illusts;
    }

    /**
     * コメント投稿
     */
    public function storeCommentIllust(int $id,object $request) : void
    {
        try{
            DB::beginTransaction();

            $comment = new illustComments();

            $comment->user_id = Auth::id();
            $comment->illusts_id = $id;
            $comment->comment_body = $request->input_comment;

            $comment->save();

            DB::commit();
        } catch(\Exception $e) {
            DB::rollBack();
            session()->flash('errors', '更新失敗');
        }
    }

    /**
     * コメント削除
     */
    public function deleteComment($comment_id)
    {
        try{
            DB::beginTransaction();

            illustComments::where('id', $comment_id)->delete();

            DB::commit();
        } catch(\Exception $e) {
            DB::rollBack();
            session()->flash('errors', '削除失敗');
        }
    }

    /**
     * コメント編集画面表示
     */
    public function showEditComment($id)
    {
        return illustComments::find($id);
    }

        /**
     * コメント編集
     */
    public function editCommentIllust(int $id, $request)
    {
        try{
            DB::beginTransaction();

            illustComments::where('id',$id)
            ->update([
                'comment_body' => $request->input_comment
            ]);

            DB::commit();
        } catch(\Exception $e) {
            DB::rollBack();
            session()->flash('errors', '削除失敗');
        }
        
    }

}
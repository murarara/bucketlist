<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class BoardShareController extends Controller
{
    //ユーザを閲覧許可にする
    public function store(Request $request, $board_id)
    {
        // バリデーション
        $request->validate([
            'email' => 'required',
        ]);
        
        // 入力されたメールアドレスの取得
        $email = $request->email;
        
        //emailからユーザのidを取得
        $user_id = User::select('id')->where('email',$email)->first();

        // シェアしたいユーザに閲覧を許可する
        $user_id->share($user_id, $board_id);
        
        // // タスク一覧ページへリダイレクト
        return redirect()->route('boards.show', ['board' => $board_id, 'user_id' => $user_id]);
        //テスト用view
        //return view('test', ['email' => $request, 'user_id' => $user_id, 'board' => $board_id]);
    }
}

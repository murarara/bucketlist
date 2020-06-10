<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Board;

class BoardsController extends Controller
{
    public function index()
    {
        // $data = [];
        if (\Auth::check()) {
            // 認証済みユーザ（閲覧者）を取得
            $user = \Auth::user();
            // ユーザのボード一覧を作成日時の降順で取得
            $boards = $user->feed_boards()->orderBy('id', 'asc')->paginate(10);

            // $data = [
            //     'user' => $user,
            //     'boards' => $boards,
            // ];
            
            return view('welcome', ['user' => $user,'boards' => $boards]);
        }
        
        // ログインしていない
        return view('welcome');
    }
    
    public function create()
    {
        $board = new Board;
        return view('boards.create',[
            'board' => $board,
        ]);
    }
    
    public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            'title' => 'required|max:255',
            'desc' => 'required|max:255',
        ]);
        
        // 認証済みユーザ（閲覧者）のボードとして作成（リクエストされた値をもとに作成）
        $request->user()->boards()->create([
            'title' => $request->title,
            'desc' => $request->desc,
        ]);

        // トップページへリダイレクトさせる
        return redirect('/');
    }
}

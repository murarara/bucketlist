<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Board;

class BoardsController extends Controller
{
    public function index()
    {
        if (\Auth::check()) {
            // 認証済みユーザ（閲覧者）を取得
            $user = \Auth::user();
            // ユーザのボード一覧を作成日時の降順で取得
            $boards = $user->feed_boards()->orderBy('id', 'asc')->paginate(10);
            
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

        // ボード一覧のページへリダイレクトさせる
        return redirect('/');
    }
    
    public function show($id)
    {
        $board = Board::find($id);
        // ボードのタスク一覧を作成日時の降順で取得
        $tasks = $board->feed_tasks()->orderBy('id', 'asc')->paginate(10);
        // 認証済みユーザ（閲覧者）がそのタスクの所有者である場合
        if (\Auth::id() === $board->user_id) {
    
            // タスク一覧ビューでそれらを表示
            return view('tasks.index', ['board' => $board, 'tasks' => $tasks]);
        }
        
        // トップページへリダイレクトさせる
        return redirect('/');
    }
    
    public function edit($id)
    {
        // idの値でタスクを検索して取得
        $task = Task::find($id);

        // 認証済みユーザ（閲覧者）がそのタスクの所有者である場合
        if (\Auth::id() === $task->user_id) {
            // タスク編集ビューでそれを表示
            return view('tasks.edit', [
                'task' => $task,
            ]);
        }
        // トップページへリダイレクトさせる
        return redirect('/');
    }

    public function update(Request $request, $id)
    {
        // バリデーション
        $request->validate([
            'content' => 'required|max:255',
            'status' => 'required|max:10',
        ]);
        
        // idの値でタスクを検索して取得
        $task = Task::find($id);
        
        // 認証済みユーザ（閲覧者）がそのタスクの所有者である場合
        if (\Auth::id() === $task->user_id) {
            // タスクを更新
            $task->content = $request->content;
            $task->status = $request->status;
            $task->save();
        }

        // トップページへリダイレクトさせる
        return redirect('/');
    }
}

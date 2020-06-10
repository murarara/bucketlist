<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Board;
use App\Task;

class TasksController extends Controller
{
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $task = new Task;
        return view('tasks.create',[
            'board' => $id,
            'task' => $task,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        // バリデーション
        $request->validate([
            'content' => 'required|max:255',
            'status' => 'required|max:10',
            'memo' => 'max:255'
        ]);
        
        $board_id = $id;
        
        Task::create([
            'board_id' => $board_id,
            'content' => $request->content,
            'status' => $request->status,
            'memo' => $request->memo,
        ]);
        
        // タスク一覧ページへリダイレクト
        return redirect()->route('boards.show', ['board' => $board_id]);
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
    public function edit($board_id, $task_id)
    {
        // idの値でタスクを検索して取得
        $task = Task::find($task_id);

        // タスク編集ビューでそれを表示
        return view('tasks.edit', [
            'board' => $board_id,
            'task' => $task,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $board_id, $task_id)
    {
        // バリデーション
        $request->validate([
            'content' => 'required|max:255',
            'status' => 'required|max:10',
            'memo' => 'max:255',
        ]);
        
        // idの値でタスクを検索して取得
        $task = Task::find($task_id);
        
        // タスクを更新
        $task->content = $request->content;
        $task->status = $request->status;
        $task->memo = $request->memo;
        $task->save();

        // タスク一覧ページへリダイレクト
        return redirect()->route('boards.show', ['board' => $board_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($board_id, $task_id)
    {
        // idの値でタスクを検索して取得
        $task = Task::find($task_id);
        // 認証済みユーザ（閲覧者）がそのタスクの所有者である場合は、投稿を削除
        if (\Auth::id() === $task->user_id) {
            $task->delete();
        }

        // タスク一覧ページへリダイレクト
        return redirect()->route('boards.show', ['board' => $board_id]);
    }
    
    
}

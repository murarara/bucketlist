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

    public function create($id)
    {
        $task = new Task;
        return view('tasks.create',[
            'board' => $id,
            'task' => $task,
        ]);
    }

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

    public function show($id)
    {
        //
    }

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

    public function destroy($board_id,$task_id)
    {
        // idの値でタスクを検索して取得
        $task = Task::find($task_id);
        
        $task->delete();

        // タスク一覧ページへリダイレクト
        return redirect()->route('boards.show', ['board' => $board_id]);
    }
    
}

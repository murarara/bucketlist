@extends('layouts.app')

@section('content')
    
    <h1>{{ $board->title }}</h1>
    <!-- タスク作成ページへのリンク -->
    {!! link_to_route('tasks.create', 'タスクを追加', ['board' => $board->id], ['class' => 'btn btn-Light']) !!}
    
    <!-- タスク一覧表示 -->
    @if(count($tasks) > 0)
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>予定</th>
                    <th>今のところ..</th>
                    <th>ちょっとメモ</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            @foreach($tasks as $task)
                <tr>
                    <td>{!! link_to_route('tasks.edit', $task->content, ['board' => $board->id, 'task' => $task->id], ['class' => 'btn btn-Light']) !!}</td>
                    <td>{{ $task->status }}</td>
                    <td>{{ $task->memo }}</td>
                    <td>
                        {!! Form::open(['route' => ['tasks.delete', $board, $task], 'method' => 'delete']) !!}
                            {!! Form::submit('×', ['class' => 'btn btn-danger btn-sm']) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
                
            @endforeach
            </tbody>
        </table>
        {{-- ページネーションのリンク --}}
        {{ $tasks->links() }}
    @endif
@endsection
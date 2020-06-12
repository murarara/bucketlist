@extends('layouts.app')

@section('content')
    
    <h1>{{ $board->title }}{{$user}}</h1>
    
    <!-- タスク作成ページへのリンク -->
    {!! link_to_route('tasks.create', 'リストを追加', ['board' => $board->id], ['class' => 'btn btn-Light']) !!}
    
    <!-- 招待ページへのリンク -->
    {{--{!! link_to_route('signup.get', 'みんなでシェアする', [], ['class' => 'btn btn-Light']) !!}--}}
    
    <!-- 自分のボードである場合のみ表示 -->
    @if($board->user_id == Auth::id())
        <!-- シェア機能 -->
        @include('search')
    @endif

    
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
                    <td>{!! link_to_route('tasks.edit', $task->status, ['board' => $board->id, 'task' => $task->id], ['class' => 'btn btn-Light']) !!}</td>
                    <td>
                        @if($task->memo)
                            {!! link_to_route('tasks.edit', $task->memo, ['board' => $board->id, 'task' => $task->id], ['class' => 'btn btn-Light']) !!}
                        @endif
                    </td>
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
@extends('layouts.app')

@section('content')
    
    <h1>（ボードの名前）</h1>
        @if(count($tasks) > 0)
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>task</th>
                        <th>status</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($tasks as $task)
                    <tr>
                        <td>{!! link_to_route('tasks.edit', $task->content, ['task' => $task->id]) !!}</td>
                        <td>{{ $task->status }}</td>
                        <td>{{ $task->memo }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{-- ページネーションのリンク --}}
            {{ $tasks->links() }}
        @endif
@endsection
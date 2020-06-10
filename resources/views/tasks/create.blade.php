@extends('layouts.app')

@section('content')

    <h1>新規タスク追加ページ</h1>
    
    <div class="row">
        <div class="col-6">
            {!! Form::model($task, ['route' => ['tasks.store', $board]]) !!}

                <div class="form-group">
                    {!! Form::label('content', 'タスク:') !!}
                    {!! Form::text('content', null, ['class' => 'form-control']) !!}
                    {!! Form::label('status', 'ステータス:') !!}
                    {!! Form::text('status', null, ['class' => 'form-control']) !!}
                    {!! Form::label('memo', 'メモ:') !!}
                    {!! Form::textarea('memo', null, ['class' => 'form-control', 'rows' => '2']) !!}
                </div>

                {!! Form::submit('add', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
    </div>

@endsection
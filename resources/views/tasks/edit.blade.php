@extends('layouts.app')

@section('content')

    <h1>タスク編集ページ</h1>
    
    <div class="row">
        <div class="col-6">
            {!! Form::model($task, ['route' => ['tasks.update', $board, $task], 'method' => 'put']) !!}

                <div class="form-group">
                    {!! Form::label('content', '予定:') !!}
                    {!! Form::text('content', null, ['class' => 'form-control', 'placeholder' => '荘厳な景色を見る']) !!}
                    {!! Form::label('status', '今のところ..:') !!}
                    {!! Form::text('status', null, ['class' => 'form-control']) !!}
                    {!! Form::label('memo', 'ちょっとメモ:') !!}
                    {!! Form::textarea('memo', null, ['class' => 'form-control', 'rows' => '2']) !!}
                </div>

                {!! Form::submit('この内容でアップデートする！', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
    </div>

@endsection
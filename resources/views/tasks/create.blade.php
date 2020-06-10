@extends('layouts.app')

@section('content')

    <h1>これから何する？</h1>
    
    <div class="row">
        <div class="col-6">
            {!! Form::model($task, ['route' => ['tasks.store', $board]]) !!}

                <div class="form-group">
                    {!! Form::label('content', '予定:') !!}
                    {!! Form::text('content', null, ['class' => 'form-control', 'placeholder' => '世界一の美女にキスをする']) !!}
                    {!! Form::label('status', '今のところ..:') !!}
                    {!! Form::text('status', null, ['class' => 'form-control']) !!}
                    {!! Form::label('memo', 'ちょっとメモ:') !!}
                    {!! Form::textarea('memo', null, ['class' => 'form-control', 'rows' => '2']) !!}
                </div>

                {!! Form::submit('これしたい！', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
    </div>

@endsection
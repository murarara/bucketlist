@extends('layouts.app')

@section('content')

    <h1>{{ $board->title }}</h1>
    
    <div class="row">
        <div class="col-6">
            {!! Form::model($board, ['route' => ['boards.update', $board], 'method' => 'put']) !!}

                <div class="form-group">
                    {!! Form::label('title', 'タイトル:') !!}
                    {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => '今日の晩ご飯']) !!}
                    {!! Form::label('desc', 'ボードの説明:') !!}
                    {!! Form::text('desc', null, ['class' => 'form-control', 'placeholder' => '買うものをメモする！']) !!}
                </div>

                {!! Form::submit('この内容でアップデートする！', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
    </div>

@endsection
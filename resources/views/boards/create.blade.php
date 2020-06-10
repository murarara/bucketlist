@extends('layouts.app')

@section('content')

    <h1>ボードを作成する</h1>
    
    <div class="row">
        <div class="col-6">
            {!! Form::model($board, ['route' => 'boards.store']) !!}

                <div class="form-group">
                    {!! Form::label('title', 'タイトル:') !!}
                    {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'バケットリスト']) !!}
                    {!! Form::label('desc', 'ボードの説明:') !!}
                    {!! Form::text('desc', null, ['class' => 'form-control', 'placeholder' => '死ぬ前にやり残したこと']) !!}
                </div>

                {!! Form::submit('このボードでＯＫ！', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
    </div>

@endsection
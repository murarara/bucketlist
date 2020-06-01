@extends('layouts.app')

@section('content')
    <div class="center jumbotron">
        <div class="text-center">
            @if (Auth::check())
                <h1>{{ Auth::user()->name }}のボード</h1>
            @else
                <div class="center jumbotron">
                    <div class="text-center">
                        <h1>BucketListへようこそ！<head>
                        </head></h1>
                        {{-- ユーザ登録ページへのリンク --}}
                        {!! link_to_route('signup.get', 'アカウントを作成', [], ['class' => 'btn btn-lg btn-primary']) !!}
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
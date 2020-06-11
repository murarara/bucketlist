@extends('layouts.app')

@section('content')
    <div class="center">
        <div class="text">
            @if (Auth::check())
                <h1>{{ Auth::user()->name }}のボード</h1>
                {{-- ボード作成ページへのリンク --}}
                {!! link_to_route('boards.create', 'ボード作成', [], ['class' => 'btn btn-Light']) !!}
                {{-- 招待ページへのリンク --}}
                {!! link_to_route('signup.get', 'メンバーを招待', [], ['class' => 'btn btn-Light']) !!}
                    
                <!-- ボード一覧表示 -->
                <div class="row">
                    @foreach($boards as $board)
                          <div class="col-sm-6 col-md-3">
                                <div class="card h-100" style="width: 18rem;">
                                  <div class="card-body">
                                    <h2 class="card-title">{{ $board->title }}</h2>
                                        <p class="card-subtitle mb-2 text-muted">{{ $board->desc }}</p>
                                        {!! link_to_route('boards.show', 'このボードを見る', ['board' => $board->id], ['class' => 'btn btn-Light']) !!}
                                        {!! link_to_route('boards.edit', '編集', ['board' => $board->id], ['class' => 'btn btn-Light']) !!}
                                  </div>
                                </div>
                          </div>
                    @endforeach
                </div>
            @else
                <div class="center jumbotron">
                    <div class="text-center">
                        <h1>BucketListへようこそ！</h1>
                        {{-- ユーザ登録ページへのリンク --}}
                        {!! link_to_route('signup.get', 'アカウントを作成', [], ['class' => 'btn btn-lg btn-primary']) !!}
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection



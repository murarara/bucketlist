<a class="btn btn-Light" data-toggle="collapse" href="#search" role="button" aria-expanded="false" aria-controls="search">
    リストをシェアする
</a>

<div class="form-group collapse" id="search">
    <div class="card card-body">
    {!! Form::open(['route' => ['board.share', $board->id]]) !!}
        {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'シェアしたいユーザのメールアドレス'] ) !!}
        {!! Form::submit('あなたとシェアする！', ['class' => 'btn btn-Light btn-block']) !!}
    {!! Form::close() !!}
    </div>   
</div>
{!! Form::open(array('action' => 'ParseController@index', 'method' => 'get')) !!}
{!! Form::submit('to parse') !!}
{!! Form::close()!!}


@if( $urls->all()==null )
    <div>the base is empty</div>
@endif

@foreach ($urls as $l)

    <a href="/db/{{$l->indexJobAion}}">{{$l->httpAinua}}</a><BR>

@endforeach
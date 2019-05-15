{!! Form::open(array('action' => 'ParseController@index', 'method' => 'get')) !!}
{!! Form::submit('to parse') !!}
{!! Form::close()!!}




@foreach ($lin as $l)

<a href="/db/{{$l->indexJobAion}}">{{$l->httpAinua}}</a><BR>

@endforeach
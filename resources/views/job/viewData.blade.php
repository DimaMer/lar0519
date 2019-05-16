
{!! Form::open(array('action' => 'BaseDataController@index', 'method' => 'get')) !!}
{!! Form::submit('back') !!}
{!! Form::close()!!}

{!! Form::open(array('url' => "db/$idJob/del", 'method' => 'get')) !!}
{!! Form::submit('del') !!}
{!! Form::close()!!}


@foreach ($users as $key1=>$value1)

<h2>{{$key1}}</h2>
{{$value1}}
@endforeach


{!! Form::open(array('action' => 'VacanciesController@index', 'method' => 'get')) !!}
{!! Form::submit('back') !!}
{!! Form::close()!!}

{!! Form::open(['action' => 'show@destroy', 'method'=>"delete", 'route' => ['show.destroy',$idJob]]) !!}
{!! Form::submit('destroy') !!}
{!! Form::close() !!}


@foreach ($users as $key1=>$value1)

<h2>{{$key1}}</h2>
{{$value1}}
@endforeach

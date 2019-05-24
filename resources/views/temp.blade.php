{!! Form::open(['method'=>"get"]) !!}
{!! Form::submit('index') !!}
{!! Form::close() !!}

{!! Form::open(['action' => 'temp@store']) !!}
    {!! Form::submit('store') !!}
{!! Form::close() !!}


{!! Form::open(['action' => 'temp@create', 'method'=>"get"]) !!}
{!! Form::submit('create') !!}
{!! Form::close() !!}

{!! Form::open(['action' => 'temp@edit', 'method'=>"get", 'route' => ['temp.edit','1']]) !!}
{!! Form::submit('edit') !!}
{!! Form::close() !!}
{!! Form::open(['action' => 'temp@update', 'method'=>"put", 'route' => ['temp.update','1']]) !!}
{!! Form::submit('update') !!}
{!! Form::close() !!}

    {!! Form::open(['action' => 'temp@show', 'method'=>"get", 'route' => ['temp.show','1']]) !!}
{!! Form::submit('show') !!}
{!! Form::close() !!}


{!! Form::open(['action' => 'temp@destroy', 'method'=>"delete", 'route' => ['temp.destroy','1']]) !!}
{!! Form::submit('destroy') !!}
{!! Form::close() !!}
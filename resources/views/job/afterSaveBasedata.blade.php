
{!! Form::open(array('action' => 'BaseDataController@index', 'method' => 'get')) !!}
{!! Form::submit('view all page') !!}
{!! Form::close()!!}
<h1>the data added (or update) to database</h1>
{{print_r($index)}}
<BR>
{{print_r($data)}}
<BR>




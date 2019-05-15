<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>



{{print_r($index)}}
{!! Form::open(array('action' => 'BaseDataController@create', 'method' => 'put')) !!}
{!! Form::submit('Save date to databases!') !!}
{!! Form::close()!!}
@foreach ($data as $key=>$value)
<h1>{{$key}}</h1>
@foreach ($value as $key1=>$value1) {
<h2>{{$key1}}</h2>
{{$value1}}
<BR>


@endforeach
@endforeach



</body>
</html>
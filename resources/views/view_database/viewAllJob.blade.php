

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Search</title>

</head>
<body style="width:90%; margin:50px; ">


@if( $vacancy->all()==null )
    <div>the base is empty</div>
@endif

{!! Form::open(['action' => 'VacanciesController@store']) !!}
<div id="app">
    <test></test>
</div>
{!! Form::close()!!}



<script src="/js/app.js"></script>
</body>
</html>


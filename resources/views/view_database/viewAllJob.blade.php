<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no,
                        initial-scale=1.0, maximum-scale=1.0,
                        minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible"
              content="ie=edge">
        <title>Search</title>
    </head>
    <body style="width:90%; margin:50px; ">
        @if( $vacancy->all()==null )
            <div>
                the base is empty
            </div>
        @endif
        {!! Form::open(['action' => 'VacanciesController@store']) !!}
            <div id="app">
                <test></test>
            </div>
        {!! Form::close()!!}
        <script src="/js/app.js"></script>
    </body>
</html>



<link rel="stylesheet" href="{{ URL::asset('css/app1.css') }}">
@if( $vacancy->all()==null )
    <div>the base is empty</div>
@endif



<div>
    {!! Form::open(['action' => 'VacanciesController@store']) !!}
    <table class="table_price">
        <caption>Vacancy</caption>
        <tr>
            <th>Vacancy</th>
            <th>Company</th>
            <th>Time ago</th>
            <th>select vacancy <br>




                {!! Form::checkbox('all',$vacancy[4]['indexjob'],false) !!}
            </th>
        </tr>
        @foreach ($vacancy as $key=>$l)
        <tr>
            <td><a href="/show/{{$l->indexjob}}">{{$l->vacancy}}</a><BR></td>
            <td>{{$l->company}}</td>
            <td>{{$l->time}}</td>
            <td>{!! Form::checkbox($key,$l->indexjob,false) !!}</td>
        </tr>
        @endforeach
    </table>


    {!! Form::submit('send selected json-vacancies to site') !!}
    {!! Form::close()!!}

</div>




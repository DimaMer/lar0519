

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Search</title>
    <link rel="stylesheet" href="{{ URL::asset('css/app1.css') }}">

</head>
<body style="width:90%; margin:50px; ">



@if( $vacancy->all()==null )
    <div>the base is empty</div>
@endif


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




<div>
    <input type="text" placeholder="What are you looking for?"
           v-model="query">
</div>
<span>
<button class="btn" type="button" @click="search()" v-if="!loading">Search!</button>
    <button class="btn" type="button" disabled="disabled" v-if="loading">Searching...</button>
                        </span>
<div v-if="error">
    <span aria-hidden="true"></span>
    @{{ error }}
</div>
<div >
    <div style="border: 4px double black; " v-for="product in job">
        <p v-for="prod in product">*@{{ prod }}</p>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.26/vue.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/1.0.1/vue-resource.min.js"></script>
<script src="/js/app.js"></script>
</body>
</html>


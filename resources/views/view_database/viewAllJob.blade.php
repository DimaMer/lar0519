

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

<div>
    <input type="text" placeholder="What are you looking for?"
           v-model="query">
    <span>
<button class="btn" type="button" @click="search()" v-if="!loading">Search!</button>
        <button class="btn" type="button" disabled="disabled" v-if="loading">Searching...</button>
                        </span>
    {!! Form::submit('send after search') !!}
</div>


<div v-if="error">
    <span aria-hidden="true"></span>
    @{{ error }}
</div>

<div style="display: flex; ">

    <div style="border: 4px double black; " v-for="(key, product) in job">

        <input v-bind:name=key type="checkbox" v-bind:value=product.indexjob>
        <span>select job</span>
        <p v-for="prod in product">*@{{ prod }}</p>
    </div>
</div>
{!! Form::close()!!}
{!! Form::open(['action' => 'VacanciesController@store']) !!}
<span style="   margin-left: 40%;  ">
    {!! Form::submit('send selected json-vacancies to site') !!} </span>
<table class="table_price">
    <caption>Vacancy</caption>
    <tr>
        <th>Vacancy</th>
        <th>Company</th>
        <th>Time ago</th>
        <th>select ALL vacancy <br>

            {!! Form::checkbox('all','all',false) !!}
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

{!! Form::close()!!}

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.26/vue.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/1.0.1/vue-resource.min.js"></script>
<script src="/js/app.js"></script>
</body>
</html>


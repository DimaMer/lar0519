@if( $vacancy->all()==null )
    <div>the base is empty</div>
@endif

@foreach ($vacancy as $l)

    <a href="/show/{{$l->indexjob}}">{{$l->httpjob}}</a><BR>

@endforeach

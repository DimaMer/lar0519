


@if( $urls->all()==null )
    <div>the base is empty</div>
@endif

@foreach ($vacancy as $l)

    <a href="/{{$l->indexjob}}">{{$l->httpjob}}</a><BR>

@endforeach
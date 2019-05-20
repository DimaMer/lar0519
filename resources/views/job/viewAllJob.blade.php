


@if( $urls->all()==null )
    <div>the base is empty</div>
@endif

@foreach ($urls as $l)

    <a href="/{{$l->indexJobAion}}">{{$l->httpAinua}}</a><BR>

@endforeach
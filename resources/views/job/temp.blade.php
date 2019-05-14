<h1>Write, how many Jobs do you want to parse? </h1>

{!! Form::open()!!}
<div style=" width: 500px; text-align: right; font-size: 24px;">
    {!! Form::label('Jobs count') !!}
    {!! Form::number('name', '1') !!}
    <BR>
</div>
<BR>
<h1>Select, which class do you want to parse? </h1>
<BR>

<div style=" width: 500px; text-align: right; font-size: 24px;">
    {!! Form::label('(vacancy-title)') !!}
    {!!Form::checkbox('class[vacancy]','vacancy-title','true') !!}<BR>
    {!! Form::label('(company-title)') !!}
    {!!Form::checkbox("class[company]" ,'company-title','true') !!}<BR>
    {!! Form::label('(time-passed)') !!}
    {!!Form::checkbox("class[time]",'time-passed','true') !!}<BR>
    {!! Form::label('(vacancy-info-wrapper)(vacancy-block)(post)') !!}
    {!!Form::checkbox("class[vacancyInfoWrapper]",'vacancy-info-wrapper vacancy-block post','true') !!}<BR>
    {!! Form::label('(company-description)(vacancy-block post)') !!}
    {!!Form::checkbox("class[companyDescription]" ,'company-description vacancy-block post','true') !!}<BR>
    {!! Form::label('(selected-category)') !!}
    {!!Form::checkbox("class[category]",'selected-category','true') !!}<BR>
    {!! Form::label('(selected-city)(vacancy-city)') !!}
    {!!Form::checkbox("class[cityVacancyCity]",'selected-city vacancy-city','true') !!}<BR>
    <BR>
    {!! Form::submit() !!}

</div>
{!! Form::close()!!}


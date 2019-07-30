@extends('admin.index')

@section('content')
<div class="box">
  <div class="box-header">
    <h3 class="box-title">{{$title}} </h3>
</div> 
<div class="box-body">


<!-- {!! Form::open(['route'=>['countries.update',$trade->id],'method'=>'put' ]) !!} -->   <!-- OR -->

{!! Form::open(['url'=>aurl('trademarks/'.$trade->id), 'method'=>'put','files'=>true ]) !!}  


<div class="form-group">
  
  {!! Form::label('name_ar',trans('admin.name_ar')) !!}
  {!! Form::text('name_ar',$trade->name_ar,['class'=>'form-control']) !!}
</div>

<div class="form-group">
  
  {!! Form::label('name_en',trans('admin.name_en')) !!}
  {!! Form::text('name_en',$trade->name_en,['class'=>'form-control']) !!}
</div>

<div class="form-group">
  
  {!! Form::label('logo',trans('admin.trade_icon')) !!}
  {!! Form::file('logo',['class'=>'form-control']) !!}
   @if(!empty($trade->logo))
  <img src="{{ Storage::url($trade->logo) }}" style="width: 50px; height: 50px" />
  @endif
</div>


  {!! Form::submit(trans('admin.save'),['class'=>'btn btn-primary form-control']) !!}

{!! Form::close() !!}

</div> 
</div>






@endsection

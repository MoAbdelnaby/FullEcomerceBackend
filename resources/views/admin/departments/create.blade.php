@extends('admin.index')

@section('content')

@push('js')
<script type="text/javascript">
  $(document).ready(function() {

      $('#jstree').jstree({
        "core" : {
          'data' : {!! load_dep(old('parent'))  !!},
          "themes" : {
            "variant" : "large"
          }
        },
        "checkbox" : {
          "keep_selected_style" : false
        },
        "plugins" : [ "wholerow"]
      });

  });

   $('#jstree').on('changed.jstree', function(e,data) {
    var i , j , r = [];
    for(i = 0, j = data.selected.length; i < j; i++)
    {
      r.push(data.instance.get_node(data.selected[i]).id);
    }
    $('.parent_id').val(r.join(', '));

  });

</script>
@endpush

<div class="box">
  <div class="box-header">
    <h3 class="box-title">{{$title}} </h3>
</div> 
<div class="box-body">

{!! Form::open(['url'=>aurl('departments'),'files'=>true ]) !!}

<div class="form-group">
  
  {!! Form::label('dep_name_ar',trans('admin.dep_name_ar')) !!}
  {!! Form::text('dep_name_ar',old('dep_name_ar'),['class'=>'form-control']) !!}
</div>

<div class="form-group">
  
  {!! Form::label('dep_name_en',trans('admin.dep_name_en')) !!}
  {!! Form::text('dep_name_en',old('dep_name_en'),['class'=>'form-control']) !!}
</div>

<div class="clearfix"></div>
{!! Form::label('departments',trans('admin.departments')) !!}
<div id="jstree"></div>
<input type="hidden" class="parent_id" name="parent" value="{{ old('parent') }}">
<div class="clearfix"></div>


<div class="form-group">
  
  {!! Form::label('description',trans('admin.description')) !!}
  {!! Form::textarea('description',old('description'),['class'=>'form-control']) !!}
</div>

<div class="form-group">
  
  {!! Form::label('keywords',trans('admin.keywords')) !!}
  {!! Form::textarea('keywords',old('keywords'),['class'=>'form-control']) !!}
</div>
<div class="form-group">
  
  {!! Form::label('icon',trans('admin.icon')) !!}
  {!! Form::file('icon',['class'=>'form-control']) !!}
</div>



{!! Form::submit(trans('admin.add'),['class'=>'btn btn-primary form-control']) !!}

{!! Form::close() !!}

</div> 
</div>






@endsection

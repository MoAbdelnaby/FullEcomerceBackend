@extends('admin.index')
@section('content')


<div class="box">
  <div class="box-header">
    <h3 class="box-title">{{ $title }}</h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    {!! Form::open(['url'=>aurl('products')]) !!}

    <a href="#" class="btn btn-primary save">{{ trans('admin.save_product') }} <i class="far fa-save"></i></a>
    <a href="#" class="btn btn-success save_and_continue">{{ trans('admin.save_and_continue') }} <i class="fas fa-save"></i></a>
    <a href="#" class="btn btn-info copy_product">{{ trans('admin.copy_product') }} <i class="fa fa-copy"></i></a>
    <a href="#" class="btn btn-danger delete">{{ trans('admin.delete') }} <i class="fa fa-trash"></i></a>
    <hr />
<ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#product_info">{{trans('admin.product_info')}}</a></li>
    <li><a data-toggle="tab" href="#department">{{trans('admin.department')}}</a></li>
    <li><a data-toggle="tab" href="#product_setting">{{trans('admin.product_setting')}}</a></li>
    <li><a data-toggle="tab" href="#product_media">{{trans('admin.product_media')}}</a></li>
    <li><a data-toggle="tab" href="#product_size_weight">{{trans('admin.product_size_weight')}}</a></li>
    <li><a data-toggle="tab" href="#product_other_data">{{trans('admin.product_other_data')}}</a></li>
  </ul>

    <div class="tab-content">
      @include('admin.products.tabs.product_info')
      @include('admin.products.tabs.department')
      @include('admin.products.tabs.product_setting')
      @include('admin.products.tabs.product_media')
      @include('admin.products.tabs.product_size_weight')
      @include('admin.products.tabs.product_other_data')
    
    </div>

 
<div class="form-group">
  
  {!! Form::label('name_ar',trans('admin.color_name_ar')) !!}
  {!! Form::text('name_ar',old('name_ar'),['class'=>'form-control']) !!}
</div>



  {!! Form::submit(trans('admin.add'),['class'=>'btn btn-primary form-control']) !!}

{!! Form::close() !!}

</div> 
</div>





@endsection

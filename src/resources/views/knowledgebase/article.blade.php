@extends('backpack::layout')

@section('content-header')
	<section class="content-header">
	  <h1>
	    {{ trans('backpack::crud.preview') }} <span class="text-lowercase">{{ $crud->entity_name }}</span>
	  </h1>
	  <ol class="breadcrumb">
	    <li><a href="{{ url(config('backpack.base.route_prefix'), 'dashboard') }}">{{ trans('backpack::crud.admin') }}</a></li>
	    <li><a href="{{ url($crud->route) }}" class="text-capitalize">{{ $crud->entity_name_plural }}</a></li>
	    <li class="active">{{ trans('backpack::crud.preview') }}</li>
	  </ol>
	</section>
@endsection

@section('content')
	@if ($crud->hasAccess('list'))
		<a href="{{ url($crud->route) }}"><i class="fa fa-angle-double-left"></i> {{ trans('backpack::crud.back_to_all') }} <span class="text-lowercase">{{ $crud->entity_name_plural }}</span></a><br><br>
	@endif

	<!-- Default box -->
	  <div class="box">
	    <div class="box-header with-border">
	      <h3 class="box-title">
            {{ $entry->title }}
          </h3>
          <ul class="list-unstyled list-inline pull-right export-buttons">
              <li><a href="{{ url($crud->route.'/'.$entry->getKey()).'/export/word' }}" class="btn btn-xs btn-default"><i class="fa fa-file-word-o"></i> Export to Word</a></li>
              <li><a href="{{ url($crud->route.'/'.$entry->getKey()).'/export/pdf' }}" class="btn btn-xs btn-default"><i class="fa fa-file-pdf-o"></i> Export to PDF</a></li>
          </ul>
	    </div>
	    <div class="box-body">
			{!! $entry->content !!}
	    </div><!-- /.box-body -->
	  </div><!-- /.box -->

@endsection


@section('after_styles')
    <style>
        .export-buttons .fa {
            padding-right: 5px;
        }
    </style>
@endsection

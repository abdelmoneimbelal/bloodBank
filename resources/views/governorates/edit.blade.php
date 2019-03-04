@extends('layouts.app')
<!-- Content Header (Page header) -->
@section('page_title')
    Edit Gavernorates
@endsection

@section('content')
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Edit Gavernorates</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                            title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                @include('partials.validation_errors')
                @include('flash::message')
                <br>
                {!! Form::model($model,[
                    'action' => ['GovernratesController@update', $model->id],
                    'method' => 'put'
                ]) !!}
                @include('governorates.form')
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
@endsection
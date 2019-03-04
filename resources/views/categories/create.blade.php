@extends('layouts.app')
@inject('model','App\Category')
@section('page_title')
    Create Category
@endsection

@section('content')


    <section class="content">

        <div class="box">

            <div class="box-header with-border">

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                            title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                {!! Form::model($model,[
                'action' => 'CategoriesController@store'
                ]) !!}
                @include('partials.validation_errors')
                @include('categories.form')
                {!! Form::close () !!}
            </div>

        </div>
    </section>
@endsection

@extends('layouts.app')
@inject('model','App\Governrate')
@section('page_title')
    Create Post
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
                @include('partials.validation_errors')
                <br>
                {!! Form::open([
                'action' => 'ArticlesController@store',
                'files'=>   true,
                'method' => 'post',
                'enctype' =>'multipart/form-data'
                ]) !!}

                <div class="form-group">
                    <label for="name">Title</label>
                    {!! Form::text('title',null,[
                    'class' => 'form-control'
                 ]) !!}
                    <label for="name">Description</label>
                    {!! Form::text('description',null,[
                    'class' => 'form-control'
                 ]) !!}
                    <label class="form-control" for="image">Choose an image : </label>
                    {!! Form::file('image', [
                    'class'=>'form-control'
                   ]) !!}

                    <label class="form-control" for="select">Select the category:</label>
                    {!! Form::select('category_id',$categories,null,[
                        'class' => 'form-control'
                     ]) !!}
                    <label class="form-control" for="publish_date">Publish date :  </label>
                    {{ Form::date('publish_date', \Carbon\Carbon::now(), ['class' => 'form-control']) }}
                </div>
                <div class="form-group">
                    <button class="btn btn-primary" type="submit"> Create</button>
                </div>

                {!! Form::close () !!}
            </div>

        </div>
    </section>
@endsection

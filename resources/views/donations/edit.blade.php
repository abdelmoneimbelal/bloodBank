@extends('layouts.app')
@section('page_title')
    Create new donation
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
                {!! Form::model($model,[
                'action' => ['OrdersController@update',$model->id],
                'method' =>'put'
                ]) !!}
                <div class="form-group">
                    <label for="name">Patient Name</label>
                    {!! Form::text('name',null,[
                        'class'=>'form-control'
                    ]) !!}
                </div>
                <div class="form-group">
                    <label for="age">Patient Age</label>
                    {!! Form::number('age',null,[
                        'class'=>'form-control'
                    ]) !!}
                </div>

                <div class="form-group">
                    <label for="phone">Phone</label>
                    {!! Form::text('phone',null,[
                        'class'=>'form-control'
                    ]) !!}

                    <div class="form-group">
                        <label for="hospital_name">Hospital Name</label>
                        {!! Form::text('hospital_name',null,[
                            'class'=>'form-control'
                        ]) !!}
                    </div>

                   <!-- <div class="form-group">
                        <label for="hospital_address">Hospital Address</label>
                        {//!! Form::text('hospital_address',null,[
                            'class'=>'form-control'
                        ]) !!}
                    </div> -->
                    <div class="form-group">
                        <label for="detailes">Notes</label>
                        {!! Form::textarea('detailes',null,[
                            'class'=>'form-control'
                        ]) !!}
                    </div>
                    <div class="form-group">
                        <label for="number_ofbage_requierd">Blood Bags</label>
                        {!! Form::number('number_ofbage_requierd',null,[
                            'class'=>'form-control'
                        ]) !!}
                    </div>

                    <div class="form-group">
                        <label for="blood_type">Blood Type</label>
                        {!! Form::select('blood_type_id',$bloodtypes,[],[
                            'class'=>'form-control'
                        ]) !!}
                    </div>

                    <div class="form-group">
                        <label for="city">City</label>
                        {!! Form::select('city_id',$cities,[],[
                            'class'=>'form-control'
                        ]) !!}
                    </div>

                    <div class="form-group">
                        <button class="btn btn-primary" type="submit"> Update</button>
                    </div>
                </div>


                {!! Form::close () !!}
            </div>

        </div>
    </section>
@endsection

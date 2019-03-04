@extends('layouts.app')
@inject('donation','App\Order')
@section('page_title')
    Donations
@endsection

@section('content')


    <section class="content">

        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">List of donations</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                            title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">

                @include('flash::message')
                <br>
                @if(count($records))
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Age</th>
                                <th>Blood Bags</th>
                                <th>Hospital Name</th>
                                <!--<th>Hospital_address</th>-->
                                <th>Phone</th>
                                <th>City</th>
                                <th>Blood Type</th>
                                <th>Notes </th>
                                <th class="text-center">Edit</th>
                                <th class="text-center">Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($records as $record)
                                <tr>
                                    <td class="text-center">{{$loop->iteration}}</td>
                                    <td class="text-center">{{$record->name}}</td>
                                    <td class="text-center">{{$record->age}}</td>
                                    <td class="text-center">{{$record->number_ofbage_requierd}}</td>
                                    <td class="text-center">{{$record->hospital_name}}</td>
                                    <!--<td class="text-center">{//{$record->hospital_address}}</td>-->
                                    <td class="text-center">{{$record->phone}}</td>
                                    <td class="text-center">{{optional($record->city)->name}}</td>
                                    <td class="text-center">{{optional($record->bloodTypes)->name}}</td>
                                    <td class="text-center">{{$record->detailes}}</td>
                                    <td class="text-center">
                                        <a href="{{url(route('orders.edit',$record->id))}}" class="btn btn-success btn-xs"><i class="fa fa-edit"></i></a>
                                    </td>
                                    <td class="text-center">
                                        {!! Form::open([
                                            'action' => ['OrdersController@destroy',$record->id],
                                            'method' => 'delete'
                                        ]) !!}
                                        <button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></button>
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="alert alert-danger" role="alert">
                        No Data
                    </div>
                @endif
            </div>

        </div>


    </section>
@endsection

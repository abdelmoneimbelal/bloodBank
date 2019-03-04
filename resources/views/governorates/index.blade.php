@extends('layouts.app')

<!-- Content Header (Page header) -->
@section('page_title')
    Gavernorates
@endsection

@section('content')
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Gavernorates</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                            title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                <a href="{{url(route('governrates.create'))}}" class="btn btn-primary"><i class="fa fa-plus"></i> New Gavernorate </a> <br /> <br />
                @include('flash::message')
                <br>
                @if (count($records))
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($records as $record)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$record->name}}</td>
                                        <td>
                                            <a class="btn btn-success" href="{{url(route('governrates.edit', $record->id))}}">
                                                <i class="fa fa-edit"></i> Edit
                                            </a>
                                        </td>
                                        <td>
                                            {!! Form::open([
                                                 'action' => ['GovernratesController@destroy', $record->id],
                                                 'method' => 'delete'
                                            ]) !!}
                                                <button type="submit" class="btn btn-danger">
                                                    <i class="fa fa-trash"></i> Delete
                                                </button>
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
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
@endsection
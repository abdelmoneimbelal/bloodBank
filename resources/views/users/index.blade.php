@extends('layouts.app')
@section('page_title')
    Admins
@endsection

@section('content')


    <section class="content">

        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Create New Admin</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                            title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                <a href="{{url(route('users.create'))}}" class="btn btn-primary"><i class="fa fa-plus"></i> New Admin</a><br>
                @include('flash::message')
                <br>
                @if(count($records))
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th class="text-center">Title</th>
                                <th class="text-center">Category</th>
                                <th class="text-center">Content</th>
                                <th class="text-center">Image</th>
                                <th class="text-center">Edit</th>
                                <th class="text-center">Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($records as $record)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td class="text-center">{{$record->title}}</td>
                                    {{--<td class="text-center">{{$record->category->name}}</td>--}}
                                    {{--<td class="text-center">{{$record->description}}</td>--}}
                                    {{--<td>--}}
                                        {{--<img src="{{asset($record->image)}}" style="width:100px; height:100px">--}}
                                    {{--</td>--}}

                                    <td class="text-center">
                                        <a href="{{url(route('articles.edit',$record->id))}}" class="btn btn-success btn-xs">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    </td>

                                    <td class="text-center">
                                        {!!Form::open([
                                        'action' =>['ArticlesController@destroy',$record->id],
                                        'method' =>'delete'

                                        ]) !!}
                                        <button type="submit" class="btn btn-danger btn-xs">
                                            <i class="fa fa-trash"></i>
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

        </div>


    </section>
@endsection

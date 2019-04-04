@extends('layouts.app')
@section('page_title')
   @lang('lang.users')
@endsection

@section('content')


    <section class="content">

        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">@lang('lang.users')</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                            title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">

                {{--<h3 class="box-title" style="margin-bottom: 15px">@lang('site.users') <small>{{ $users->total() }}</small></h3>--}}

                <form action="{{ route('users.index') }}" method="get">

                    <div class="row">

                        <div class="col-md-4">
                            <input type="text" name="search" class="form-control" placeholder="@lang('lang.search')" value="{{ request()->search }}">
                        </div>

                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> @lang('lang.search')</button>
                            @if (auth()->user()->hasPermission('create_users'))
                                <a href="{{ route('users.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('lang.add')</a>
                            @else
                                <a href="#" class="btn btn-primary disabled"><i class="fa fa-plus"></i> @lang('lang.add')</a>
                            @endif
                        </div>

                    </div>
                </form><!-- end of form -->
                @include('flash::message')
                @include('partials.session')
                <br>
                @if(count($records))
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Email</th>
                                {{--<th class="text-center">Image</th>--}}
                                <th class="text-center">Edit</th>
                                <th class="text-center">Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($records as $record)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td class="text-center">{{$record->name}}</td>
                                    <td class="text-center">{{$record->email}}</td>
                                    {{--<td>--}}
                                        {{--<img src="{{asset($record->image)}}" style="width:100px; height:100px">--}}
                                    {{--</td>--}}

                                    <td class="text-center">
                                        <a href="{{url(route('users.edit',$record->id))}}" class="btn btn-success btn-xs">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    </td>

                                    <td class="text-center">
                                        {!!Form::open([
                                        'action' =>['UserController@destroy',$record->id],
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

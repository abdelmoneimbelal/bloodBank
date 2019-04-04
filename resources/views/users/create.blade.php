@extends('layouts.app')
@inject('model','App\User')
@section('page_title')
    Create New Admin
@endsection

@section('content')


    <section class="content">

        <div class="box">

            <div class="box-header with-border">
                <h3 class="box-title">@lang('lang.admins')</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                            title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip"
                            title="Remove">
                        <i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                @include('partials.validation_errors')
                <br>
                <form action="{{ route('users.store') }}" method="post" enctype="multipart/form-data">

                    {{ csrf_field() }}
                    {{ method_field('post') }}

                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                    </div>

                    {{--<div class="form-group">--}}
                        {{--<label>Image</label>--}}
                        {{--<input type="file" name="image" class="form-control image">--}}
                    {{--</div>--}}

                    {{--<div class="form-group">--}}
                        {{--<img src="{{ asset('uploads/user_images/default.png') }}" style="width: 100px"--}}
                             {{--class="img-thumbnail image-preview" alt="">--}}
                    {{--</div>--}}

                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Password Confirmation</label>
                        <input type="password" name="password_confirmation" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>@lang('lang.permissions')</label>
                        <div class="nav-tabs-custom">

                            @php
                                $models = ['users', 'categories', 'governorates', 'posts', ''];
                                $maps = ['create', 'read', 'update', 'delete'];
                            @endphp

                            <ul class="nav nav-tabs">
                                @foreach ($models as $index=>$model)
                                    <li class="{{ $index == 0 ? 'active' : '' }}">
                                        <a href="#{{ $model }}" data-toggle="tab">@lang('lang.' . $model)</a>
                                    </li>
                                @endforeach
                            </ul>

                            <div class="tab-content">

                                @foreach ($models as $index=>$model)

                                    <div class="tab-pane {{ $index == 0 ? 'active' : '' }}" id="{{ $model }}">

                                        @foreach ($maps as $map)
                                            <label>
                                                <input type="checkbox" name="permissions[]" value="{{ $map . '_' . $model }}"> @lang('lang.' . $map)
                                            </label>
                                        @endforeach

                                    </div>

                                @endforeach

                            </div><!-- end of tab content -->

                        </div><!-- end of nav tabs -->

                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>@lang('lang.add')
                        </button>
                    </div>

                </form><!-- end of form -->
            </div>

        </div>
    </section>
@endsection

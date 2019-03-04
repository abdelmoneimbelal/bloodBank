@extends('layouts.app')
@inject('client','App\Client')
@inject('order','App\Order')
@inject('article','App\Article')
<!-- Content Header (Page header) -->
@section('page_title')
  Dashboard
@endsection

@section('small_title')
    Statistics
@endsection
@section('content')
    <!-- Main content -->
    <section class="content">
         <div class="row">
             <div class="col-md-3 col-sm-6 col-xs-12">
                 <div class="info-box">
                     <span class="info-box-icon bg-aqua"><i class="fa fa-users"></i></span>

                     <div class="info-box-content">
                         <span class="info-box-text">Clients</span>
                         <span class="info-box-number">{{$client->count()}}</span>
                     </div>
                     <!-- /.info-box-content -->
                 </div>
                 <!-- /.info-box -->
             </div>
             <div class="col-md-3 col-sm-6 col-xs-12">
                 <div class="info-box">
                     <span class="info-box-icon bg-green"><i class="fa fa-line-chart"></i></span>

                     <div class="info-box-content">
                         <span class="info-box-text">Orders</span>
                         <span class="info-box-number">{{$order->count()}}</span>
                     </div>
                     <!-- /.info-box-content -->
                 </div>
                 <!-- /.info-box -->
             </div>
             <div class="col-md-3 col-sm-6 col-xs-12">
                 <div class="info-box">
                     <span class="info-box-icon bg-green"><i class="fa fa-book"></i></span>

                     <div class="info-box-content">
                         <span class="info-box-text">Articles</span>
                         <span class="info-box-number">{{$article->count()}}</span>
                     </div>
                     <!-- /.info-box-content -->
                 </div>
                 <!-- /.info-box -->
             </div>
         </div>

        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Title</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                            title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                Abdelmoneim
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                Footer
            </div>
            <!-- /.box-footer-->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
@endsection

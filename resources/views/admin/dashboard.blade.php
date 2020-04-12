@extends('layouts.admin')

@section('content')
    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-lg-4 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <p>Total Berita</p>
                        <h3>{{ $totalNews }}</h3>
                    </div>
                    <div class="icon">
                        <i class="nav-icon fa fa-newspaper-o"></i>
                    </div>
                    <a href="{{ url('dashboard/news') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-4 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <p>Total Fitur</p>
                        <h3>{{ $totalFeatures }}</h3>
                    </div>
                    <div class="icon">
                        <i class="nav-icon fa fa-star"></i>
                    </div>
                    <a href="{{ url('dashboard/news') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-4 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <p>Total Artikel</p>
                        <h3>{{ $totalBlogs }}</h3>
                    </div>
                        <div class="icon">
                        <i class="nav-icon fa fa-book"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
    </div>
@endsection

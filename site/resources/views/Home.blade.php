@extends('Layout.app')

@section('title', 'HomePage')




@section('content')


@include('Component.HomeBanner')

@include('Component.HomeService')

@include('Component.HomeCourse')

@include('Component.HomeProjects')

@include('Component.HomeContact')

@include('Component.HomeReview')

@endsection

@extends('Layout.app')

@section('title', 'CoursePage');




@section('content')

   @include('Component.CoursePageTopBanner')
   @include('Component.CoursePageAllCourse')

@endsection

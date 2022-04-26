@extends('Layout.app')

@section('title', 'ProjectPage');




@section('content')

   @include('Component.ProjectPageTopBanner')
   @include('Component.ProjectPageAllProject')

@endsection

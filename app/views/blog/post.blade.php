@extends('layout')

@section('content')
    @include('blog.includes.post', ['article' => $article])
    @include('blog.includes.comments', ['article' => $article])
@stop
@extends('layouts.app')

@section('content')
  <a href="/posts" class="btn btn-default">Go Back</a>
  <h1>{{$post->title}}</h1> 
  <div>
    {!!$post->body!!}
  </div>
  <hr>
  <small>Written on {{$post->created_at->format('Y-m-d')}}
      by {{$post->user->name}}</small>
  <hr>
  @if(!Auth::guest())
  @if(Auth::user()->if == $post->user_id)
  <a href="/posts/{{$post->id}}/edit" class="btn btn-default">Edit</a>

  {!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' =>'float-right' ])!!}
    {{Form::hidden('_method', 'DELETE')}}
    {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
  {!!Form::close()!!}
  @endif
  @endif
@endsection
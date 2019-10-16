@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <h3 class="card-header">Dashboard</h3>
        <div class="card-body">
          <a href="/posts/create" class="btn btn-primary">Create Post</a>
        </div>
        <h3 class="container">Your Blog Posts</h3>
        <div class="container">
        <table class="table table-striped">
          <tr>
            <th>Title</th>
            <th></th>
            <th></th>
          </tr>
          @foreach($posts as $post)
            <tr>
              <th>{{$post->title}}</th>
              <th><a href="/posts/{{$post->id}}/edit" class="btn btn-primary">Edit</a></th>
              <th> 
                {!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' =>'float-right' ])!!}
                  {{Form::hidden('_method', 'DELETE')}}
                  {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                {!!Form::close()!!}
              </th>
            </tr>
          @endforeach
        </table>      
      </div>
      </div>
    </div>
  </div>
</div>
@endsection

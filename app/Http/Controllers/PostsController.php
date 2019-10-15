<?php

namespace App\Http\Controllers;

use DB;
use App\Post;

use Illuminate\Http\Request;

class PostsController extends Controller
{
  public function show($id)
  {
    $post = Post::find($id);
    sleep(1);
    return view('posts.show')->with('post', $post);
  }

  public function edit($id)
  {
    $post = Post::find($id);
    return view('posts.edit')->with('post', $post);
  }

  public function update(Request $request, $id)
  {
    $this->validate($request, [
      'title' => 'required',
      'body' => 'required'

    ]);
    $post = Post::find($id);
    $post->title =  $request->input('title');
    $post->body =  $request->input('body');
    $post->save();

    return redirect('posts/')->with('success', 'Post Updated');
  }

  public function store(Request $request)
  {
    $this->validate($request, [
      'title' => 'required',
      'body' => 'required'

    ]);
    $post = new Post;
    $post->title =  $request->input('title');
    $post->body =  $request->input('body');
    $post->save();

    return redirect('posts/')->with('success', 'Post Created');
  }

  public function destroy($id)
  {
    $post = Post::find($id);
    $post->delete();
    return redirect('/posts')->with('success', 'Post Removed');
  }

  public function create()
  {
    return view('posts.create');
  }

  public function index()
  {
    $posts = Post::orderBy('created_at', 'desc')->paginate(10);
    sleep(1);
    return view('posts.index')->with('posts', $posts);
  }

}

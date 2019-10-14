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
    sleep(10);
    return view('posts.show')->with('post', $post);
  }

  public function update(Request $request, $id)
  {
    //
  }

  public function store(Request $request)
  {
    //
  }

  public function destroy($id)
  {
    //
  }

  public function create()
  {
    return view('posts.create');
  }

  public function index()
  {
    $posts = Post::orderBy('title', 'desc')->paginate(10);
    sleep(20);
    return view('posts.index')->with('posts', $posts);
  }

}

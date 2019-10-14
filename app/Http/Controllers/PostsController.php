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
    //
  }

  public function index()
  {
    $posts = Post::orderBy('title', 'desc')->paginate(1);
    sleep(60);
    return view('posts.index')->with('posts', $posts);
  }

}

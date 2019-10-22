<?php

namespace App\Http\Controllers;

use DB;
use App\Post;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Scoutapm\Laravel\Facades\ScoutApm;

class PostsController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
      $this->middleware('auth', ['except' => ['index', 'show']]);
  }

  public function show($id)
  {
    $post = Post::find($id);
    sleep(1);
    ScoutApm::addContext("URI Info", 'posts.show');
    return view('posts.show')->with('post', $post);
  
  }

  public function edit($id)
  {
    
    $post = Post::find($id);
    ScoutApm::addContext("Edited Post ID", $post->id);
    // CHeck for correct user
    if(auth()->user()->id !== $post->user_id) {
      return redirect('/posts')->with('error', 'You are not authorized to do that!!');
    }
    return view('posts.edit')->with('post', $post);
  }

  public function update(Request $request, $id)
  {
    $this->validate($request, [
      'title' => 'required',
      'body' => 'required',
      'cover_image' => 'image|nullable|max:1999'

    ]);
    //Handle file upload
    if($request->hasFile('cover_image')){
      // Get filename with extension
      $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
      //Get just filename
      $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
      //Get just extension
      $extension = $request->file('cover_image')->getClientOriginalExtension();
      //Filename to store
      $fileNameToStore = $filename.'_'.time().'.'.$extension;
      //Upload Image
      $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
    }

    $post = Post::find($id);
    $post->title =  $request->input('title');
    $post->body =  $request->input('body');
    if($request->hasFile('cover_image')){
      $post->cover_image = $fileNameToStore;
    }
    ScoutApm::addContext("Post ID", $post->id);
    $post->save();

    return redirect('posts/')->with('success', 'Post Updated');
  }

  public function store(Request $request)
  {
    $this->validate($request, [
      'title' => 'required',
      'body' => 'required',
      'cover_image' => 'image|nullable|max:1999'

    ]);
    //Handle file upload
    if($request->hasFile('cover_image')){
      // Get filename with extension
      $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
      //Get just filename
      $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
      //Get just extension
      $extension = $request->file('cover_image')->getClientOriginalExtension();
      //Filename to store
      $fileNameToStore = $filename.'_'.time().'.'.$extension;
      //Upload Image
      $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
    }else{
      $fileNameToStore = 'noimage.jpg';
    }
    //Create Post
    $post = new Post;
    $post->title =  $request->input('title');
    $post->body =  $request->input('body');
    $post->user_id = auth()->user()->id;
    $post->cover_image = $fileNameToStore;
    $post->save();

    return redirect('posts/')->with('success', 'Post Created');
  }

  public function destroy($id)
  {
    $post = Post::find($id);
    // Check the user is the correct user
    if(auth()->user()->id !== $post->user_id) {
      return redirect('/posts')->with('error', 'You are not authorized to do that!!');
    }
    //delete image
    if($post->cover_image != 'noimage.png'){
      Storage::delete('public/cover_images/'.$post->cover_image);
    }

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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
  public function index(){
    $title = 'Welcome to Thunderdome';
    return view('pages.index')->with('title', $title);
  }

  public function about() {
    $title = 'About Me and Stuff';
    return view('pages.about')->with('title', $title);
  }

  public function services() {
    $data = array(
      'title' => 'Services, get em while you can!',
      'services' => ['Web Design', 'Programming', 'SEO', 'Other Things']
    );
    return view('pages.services')->with($data);
  }
}

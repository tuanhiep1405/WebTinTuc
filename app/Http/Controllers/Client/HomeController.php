<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */


  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function index()
  {
    $cate = Category::all();

    // dd($cate);
    $posts = Post::with('category')
      ->select('id', 'content', 'type_id', 'image', 'title', 'views', 'created_at', 'category_id')
      ->where('type_id', 1)
      ->orderBy('views', 'desc')
      ->limit(3)
      ->get();

    // dd($posts);
    $top3 = Post::with('category')
      ->select('id', 'image', 'title', 'views', 'created_at', 'category_id')
      ->where('type_id', 2)
      ->orderBy('created_at', 'desc')
      ->limit(3)
      ->get();

    // dd($post);
    $normal = Post::with('category')
      ->select('id', 'content', 'image', 'title', 'views', 'created_at', 'category_id')
      ->where('type_id', 3)
      ->orderBy('created_at', 'desc')
      ->limit(1)
      ->get();


    $top4 = Post::with('category')
      ->select('id', 'content', 'image', 'title', 'views', 'created_at', 'category_id')
      ->orderBy('created_at', 'desc')
      ->limit(4)
      ->get();


    return view(
      'client.index',
      compact('cate', 'posts', 'top3', 'normal', 'top4')


    );
  }
  public function search(Request $request)
  {
    $cate = Category::all();

    $query = $request->input('query');

    $query = $request->input('query');

    $posts = Post::with('category', 'tags')
    ->select('id', 'created_at', 'title', 'content', 'image', 'views', 'category_id')
    ->where(function ($q) use ($query) {
        $q->where('title', 'like', '%' . $query . '%')
          ->orWhere('content', 'like', '%' . $query . '%')
          ->orWhereHas('tags', function ($q) use ($query) {
              $q->where('name', 'like', '%' . $query . '%');
          });
    })
    ->get();



    return view('client.search_results', compact('posts', 'query', 'cate'));
  }
}

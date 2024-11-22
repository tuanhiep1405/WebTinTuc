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
    $cate = Category::where('status', 1)->get();
    // dd($cate);

    // dd($cate);
    $posts = Post::with(['category' => function ($query) {
      $query->where('status', 1); // Điều kiện categories.status = 1
    }])
      ->select('id', 'content', 'type_id', 'image', 'title', 'views', 'created_at', 'category_id')
      ->where('type_id', 1)
      ->orderBy('views', 'desc')
      ->limit(3)
      ->get();

    // dd($posts);

    $top3 = Post::with(['category' => function ($query) {
      $query->where('status', 1);
    }])
      ->select('id', 'image', 'title', 'views', 'created_at', 'category_id')
      ->where('type_id', 2)
      ->orderBy('created_at', 'desc')
      ->limit(3)
      ->get();

    // dd($top3);

    $normal = Post::with(['category' => function ($query) {
      $query->where('status', 1);
    }])
      ->select('id', 'content', 'image', 'title', 'views', 'created_at', 'category_id')
      ->where('type_id', 3)
      ->orderBy('created_at', 'desc')
      ->limit(1)
      ->get();

    // dd($normal);

    $top4 = Post::with(['category' => function ($query) {
      $query->where('status', 1);
    }])
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
    $cate = Category::where('status', 1)->get();

    $query = $request->input('query');

    $posts = Post::with('category', 'tags')
      ->select('id', 'created_at', 'title', 'content', 'image', 'views', 'category_id')
      ->where(function ($q) use ($query) {
        $q->where('title', 'like', '%' . $query . '%')
          ->orWhere('content', 'like', '%' . $query . '%')
          ->orWhereHas('tags', function ($q) use ($query) {
            $q->where('name', 'like', '%' . $query . '%'); // Tìm theo tag
          })
          ->orWhereHas('category', function ($q) use ($query) {
            $q->where('name', 'like', '%' . $query . '%'); // Tìm theo danh mục
          });
      })
      ->get();




    return view('client.search_results', compact('posts', 'query', 'cate'));
  }
}

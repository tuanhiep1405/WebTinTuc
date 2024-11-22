<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TTLController extends Controller
{
    public function index($id)
    {
        $cate = Category::all();


        $chiTiet = Category::select('name')->where('id', $id)->first();


        $posts = Post::with('category')
            ->select('id', 'content', 'image', 'title', 'views', 'created_at', 'category_id')
            ->where('category_id', $id)
            ->orderBy('created_at', 'desc')
            ->get();

        //  dd($posts);
        return view(
            'client.tinTrongLoai',
            [
                'posts' => $posts,
                'cate' => $cate,
                'chiTiet' => $chiTiet,
            ]
        );
    }
}

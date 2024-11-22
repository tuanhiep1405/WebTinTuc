<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DetailController extends Controller
{
    public function index($id = 0)
    {
        // $post = DB::table('posts')->where('id', $id)->first();
        $cate = DB::table('categories')->get();

        $chiTiet = Post::with('category')
            ->select(
                'id',
                'category_id',
                'summary',
                'content',
                'type_id',
                'image',
                'title',
                'views',
                'created_at'
            )
            ->where('id', $id)
            ->first();


        // Lấy ra các bài viết tương tự trong cùng danh mục
        $tuongtu = Post::with('category')
            ->select('id', 'category_id', 'created_at', 'title', 'image')
            ->where('category_id', $chiTiet->category_id)
            ->where('id', '!=', $id)
            ->limit(3)
            ->get();


        // dd($tuongtu);
        //tag
        
        $postWithTags = DB::table('posts')
            ->select('posts.id', 'posts.title as post_title', 'tags.name as tag_name', 'tags.id AS tags_id')
            ->join('post_tags', 'posts.id', '=', 'post_tags.post_id')
            ->join('tags', 'post_tags.tag_id', '=', 'tags.id')
            ->where('posts.id', $id)
            ->get();

        // dd($postWithTags);

        $bl = Comment::with([
            'user:id,name',
            'replyComments.user:id,name'
        ])
            ->where('post_id', $id)
            ->orderBy('created_at', 'desc')
            ->get(['id', 'user_id', 'content', 'created_at']);


        // dd($bl->toArray());   

        return view(
            'client.chiTiet',
            compact('cate', 'chiTiet', 'tuongtu', 'postWithTags', 'bl')
        );
    }
    public function store(Request $request)
    {
        // dd($request->all());
        // Validate the request
        $data = $request->validate([
            'post_id' => 'required|integer',
            'user_id' => 'required|integer',
            'content' => 'required|string',
        ]);
        // dd($data);
        Comment::query()->create($data);
        return back();
    }
}

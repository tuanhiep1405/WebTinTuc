<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TinTagController extends Controller
{


    public function index($id)
    {
        $cate = Category::where('status',1)->get();



        $postWithTags = DB::table('posts AS p')

            ->join('post_tags AS pt', 'p.id', '=', 'pt.post_id')
            ->join('tags AS t', 'pt.tag_id', '=', 't.id')
            ->where('pt.tag_id', $id)
            ->select(
                'p.id',
                'p.views',
                'p.created_at',
                'p.content',
                'p.image',
                'p.category_id as p_category_id',
                'p.title as post_title',
                DB::raw('GROUP_CONCAT(t.name SEPARATOR ", ") as tag_names')
            )
            ->groupBy('p.id', 'p.views', 'p.created_at', 'p.content', 'p.image', 'p.category_id', 'p.title')
            ->distinct()
            ->get();

        return view('client.tinTheoTag', compact('postWithTags', 'cate'));
   
    }
}

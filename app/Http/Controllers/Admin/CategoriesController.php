<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{

    const PATH_VIEW = 'admin.pages.categories.';

    /**
     * Display a listing of the resource.
     */

     //danh sách danh mục
    public function index()
    {
        $data = Category::paginate(5);
        return view(self::PATH_VIEW . __FUNCTION__, compact('data'));
    }

    //danh sách danh mục bị khóa 
    public function listHiden()
    {
        
    $cateHide = Category::where('status',0)->paginate(5);

    return view(self::PATH_VIEW . __FUNCTION__, compact('cateHide'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // 
    }

    /**
     * Store a newly created resource in storage.
     */
    
     //thêm mới danh mục
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:255'
        ]);
        try {
            Category::query()->create($data);
            return redirect()
                ->route('admin.pages.categories.index')
                ->with('sucsses', true);
        } catch (\Throwable $th) {
            return back()
                ->with('sucsses', false)
                ->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */

     //hiển thị dữ liệu danh mục theo id edit 
    public function edit(string $id)
    {
        $cate = Category::find($id);
        return view(self::PATH_VIEW . __FUNCTION__, compact('cate'));
    }

    /**
     * Update the specified resource in storage.
     */

     //update danh mục theo id
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'name' => 'required|max:255'
        ]);

        $cate = Category::find($id);

        try {
            $cate->update($data);
            return redirect()
                ->route('admin.pages.categories.edit')
                ->with('success', ' successfully.');
        } catch (\Throwable $th) {
            return back()
                ->with('success', 'failure')
                ->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    //Khóa danh mục
    public function look(string $id){
        $data = Category::findOrFail($id);
        try {
            $data->status = 0;
            $data->save();
            return redirect()->route('categories.index')->with('success', 'Tài khoản đã được khóa');

        } catch (\Throwable $th) {
            return redirect()->route('categories.index')->with('success', 'Tài khoản khóa thất bại');

        }


    }

    //Mở khóa danh mục
    public function unlock(string $id){
        $data = Category::findOrFail($id);
        try {
            $data->status = 1;
            $data->save();
            return back()->with('success', 'Tài khoản đã được mở khóa');

        } catch (\Throwable $th) {
            return back()->with('success', 'Tài khoản mở khóa thất bại');

        }


    }
}

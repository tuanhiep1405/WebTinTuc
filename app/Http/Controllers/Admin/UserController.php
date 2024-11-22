<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    const PATH_VIEW = 'admin.pages.user.';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    $data = User::where('status',1)->paginate(5);

    return view(self::PATH_VIEW . __FUNCTION__, compact('data'));
    }

    public function listLook()
    {
        
    $data = User::where('status',0)->paginate(5);

    return view(self::PATH_VIEW . __FUNCTION__, compact('data'));
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
    public function store(Request $request)
    {
        //
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
    public function edit(string $id)
    {
        $data = User::findOrFail($id);
        $roles = ['admin', 'editor', 'user'];
        return view(self::PATH_VIEW . __FUNCTION__, compact('data','roles'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
       try {

        $request->validate([
            'role' => 'required|in:admin,editor,user', // Kiểm tra giá trị hợp lệ
        ]);
    
        $user = User::findOrFail($id);
        $user->role = $request->input('role'); // Cập nhật vai trò mới
        $user->save();
    
        return redirect()->route('user.edit',$id)->with('success', 'User updated successfully.');
       
       } catch (\Throwable $th) {
        return redirect()->route('user.edit',$id)->with('success', 'User updated failure');

       }
    }


    public function look(string $id){
        $data = User::findOrFail($id);
        try {
            $data->status = 0;
            $data->save();
            return redirect()->route('user.index')->with('success', 'Tài khoản đã được khóa');

        } catch (\Throwable $th) {
            return redirect()->route('user.index')->with('success', 'Tài khoản khóa thất bại');

        }


    }

    public function unlock(string $id){
        $data = User::findOrFail($id);
        try {
            $data->status = 1;
            $data->save();
            return back()->with('success', 'Tài khoản đã được mở khóa');

        } catch (\Throwable $th) {
            return back()->with('success', 'Tài khoản mở khóa thất bại');

        }


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

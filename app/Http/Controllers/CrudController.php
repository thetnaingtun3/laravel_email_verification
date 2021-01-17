<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class CrudController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $posts = Post::all();
        return \response()->json($posts);
    }

    public function create()
    {
        return \view('ajax');
    }

    public function store(Request $request)
    {
        $post = Post::create($request->all());
        return response()->json($post);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $post = Post::find($id);
        return response()->json($post);
    }

    public function update(Request $request, $id)
    {
        $post = Post::find($id)->update($request->all());
        return response()->json($post);
    }

    public function destroy($id)
    {
        Post::find($id)->delete();
        return \response()->json(['done']);
    }
}

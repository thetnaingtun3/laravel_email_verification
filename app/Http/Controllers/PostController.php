<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $posts = DB::table('posts')->paginate(5);
        return \view('index', compact('posts'));
    }

    public function create()
    {
        return \view('create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
            'author' => 'required',
        ]);
        $name = $request->get('name');
        $detail = $request->get('detail');
        $author = $request->get('author');
        $posts = DB::insert('insert into posts(name, detail, author) value(?,?,?)', [$name, $detail, $author]);
        if ($posts) {
            $red = redirect('posts')->with('success', 'Data has been added');
        } else {
            $red = redirect('posts/create')->with('danger', 'Input data failed, please try again');
        }
        return $red;
    }
    public function search(Request $request)
    {
        $search = $request->get('search');
        $posts = DB::table('posts')

            ->where('author', 'like', '%' . $search . '%')
            ->orWhere('name', 'like', '%' . $search . '%')
            ->orWhere('detail', 'like', '%' . $search . '%')
            ->paginate(5);
        return view('index', ['posts' => $posts]);
    }
    public function show($id)
    {
        $posts = DB::select('select * from posts where id=?', [$id]);
        return view('show', ['posts' => $posts]);
    }

    public function edit($id)
    {
        $posts = DB::select('select * from posts where id=?', [$id]);
        return view('edit', ['posts' => $posts]);
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'name' => 'required',
            'detail' => 'required',
            'author' => 'required',
        ]);

        $name = $request->get('name');
        $detail = $request->get('detail');
        $author = $request->get('author');
        $posts = DB::update('update posts set name=?, detail=?, author=? where id=?', [$name, $detail, $author, $id]);
        if ($posts) {
            $red = redirect('posts')->with('success', 'Data has been updated');
        } else {
            $red = redirect('posts/edit/' . $id)->with('danger', 'Error update please try again');
        }
        return $red;
    }

    public function destroy($id)
    {
        //
    }
    public function deleteAll(Request $request){
        $ids = $request->get('ids');
        $dbs = DB::delete('delete from posts where id in ('.implode(",",$ids).')');
        return redirect('posts');
    }
}

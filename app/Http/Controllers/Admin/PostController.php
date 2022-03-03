<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class PostController extends Controller
{
    //
    public function index()
    {
        abort_if(Gate::denies('access_post'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $data['title']      = 'Posts';
        $data['toptitle']   = 'Posts';
        $data['list']      = Post::all();
        $data['posts']      = true;

        return view('admin.posts.index', $data);
    }

    public function create()
    {
        abort_if(Gate::denies('create_post'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $data['title']      = 'New Post';
        $data['toptitle']   = 'New Post';
        $data['posts']      = true;
        $data['action']     = route('post.save');

        return view('admin.posts.create', $data);
    }

    public function edit($id)
    {
        abort_if(Gate::denies('edit_post'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $post = Post::find($id);
        if (!$post) {
            return redirect()->back();
        }

        $data['title'] = 'Edit post ' . $post->title;
        $data['toptitle'] = 'Edit post ' . $post->title;
        $data['posts'] = true;
        $data['post']       = $post;
        $data['action']     = route('post.update', $post->id);

        return view('admin.posts.create', $data);
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('create_post'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $validate = Validator::make($request->all(), [
            'title'         => ['required'],
            'description'   => ['required'],
        ]);

        if ($validate->fails()) {
            return redirect()->back()->with('errors', $validate->errors());
        }

        $result = Post::create([
            'title' => $request->title,
            'user_id' => auth()->user()->id,
            'description' => $request->description
        ]);

        if (!$result) {
            return redirect()->back()->with('warning', 'error on execution operation');
        }

        return redirect()->route('posts')->with('success', 'success on create post');
    }

    public function update($id, Request $request) {
        abort_if(Gate::denies('edit_post'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $post = Post::find($id);
        if (!$post) {
            return redirect()->back();
        }

        $validate = Validator::make($request->all(), [
            'title'         => ['required'],
            'description'   => ['required'],
        ]);

        if ($validate->fails()) {
            return redirect()->back()->with('errors', $validate->errors());
        }

        $result = Post::where('id', $id)->update([
            'title'         => $request->title,
            'description'   => $request->description
        ]);

        if (!$result) {
            return redirect()->back()->with('warning', 'error on execution operation');
        }

        return redirect()->route('posts')->with('success', 'success on edit post');
    }

    public function delete($id) {
        abort_if(Gate::denies('delete_post'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $post = Post::find($id);
        if (!$post) {
            return redirect()->back();
        }

        $result = Post::where('id', $id)->delete();

        if (!$result) {
            return redirect()->back()->with('warning', 'error on execution operation');
        }

        return redirect()->route('posts')->with('success', 'success on delete post');

    }
}

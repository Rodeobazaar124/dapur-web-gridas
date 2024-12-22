<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DefaultResponse;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->paginate(8);
        return new DefaultResponse(true, 'List of posts', $posts);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title'     => 'required',
            'content'   => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $image = $request->file('image');
        $image->storeAs('public/posts', $image->hashName());

        $post = Post::create([
            'image'     => $image->hashName(),
            'title'     => $request->title,
            'content'   => $request->content,
        ]);

        return new DefaultResponse(true, 'Post created successfully!', $post);
    }
    public function show($id)
    {
        $post = Post::find($id);
        if (!$post) {
            return response()->json(['error' => 'Post not found'], 404);
        }
        return new DefaultResponse(true, 'Post found', $post);

        if (!$post) {
            return response()->json(['error' => 'Post not found'], 404);
        }
    }
    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        $validator = Validator::make($request->all(), [
            'title'     => 'required',
            'content'   => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        if (!$post) {
            return response()->json(['error' => 'Post not found'], 404);
        }


        if ($request->hasFile('image')) {
            unset($validator);
            $image = $request->file('image');
            $image->storeAs('public/posts', $image->hashName());
            if (Storage::exists('public/posts/' . basename($post->image))) {
                Storage::delete('public/posts/' . basename($post->image));
            }
            $post->update([
                'image'     => $image->hashName(),
                'title'     => $request->title,
                'content'   => $request->content,
            ]);
        } else {
            $post->update([
                'title'     => $request->title,
                'content'   => $request->content,
            ]);
        }

        return new DefaultResponse(true, 'Post updated successfully!', $post);
    }

    public function destroy($id)
    {
        $post = Post::find($id);
        Storage::delete('public/posts/' . basename($post->image));
        $post->delete();
        return new DefaultResponse(true, 'Post deleted successfully!', null);
    }
}

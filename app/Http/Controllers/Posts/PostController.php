<?php

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function create(\App\Http\Requests\User\PostRequest $request)
    {
        $post = new \App\Models\Post();
        $post->title = $request->title;
        $post->content = $request->content;
        $post->author = auth()->user()->username;
        $post->category = $request->category;
        $post->save();

        return redirect()->route('profile')->with('success', 'Post criado com sucesso!');
    }

    public function show($id)
    {
        $post = \App\Models\Post::find($id);
        if (!$post) {
            return redirect()->route('blog')->with('error', 'Post não encontrado.');
        }
        return view('Posts/post')->with('post', $post);
    }

    public function delete($id)
    {
        $post = \App\Models\Post::find($id);
        if ($post && $post->author === auth()->user()->username) {
            $post->delete();
            return redirect()->route('profile')->with('success', 'Post deletado com sucesso!');
        }
        return redirect()->route('profile')->with('error', 'Post não encontrado ou você não tem permissão para deletá-lo.');
    }
}

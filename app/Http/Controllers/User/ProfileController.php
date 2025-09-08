<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function index()
    {
        return view('User/profile')
            ->with('posts', \App\Models\Post::where('author', auth()->user()->username)->get())
            ->with('user', auth()->user());
    }

    public function update(\App\Http\Requests\User\ProfileRequest $request)
    {
        $user = auth()->user();
        $user->username = $request->username;
        $user->bio = $request->bio;
        $user->save();

        return redirect()->route('profile')->with('success', 'Perfil atualizado com sucesso!');
    }

    public function show($username)
    {
        $user = \App\Models\User::where('username', $username)->first();
        if (!$user) {
            return redirect()->route('blog')->with('error', 'Usuário não encontrado.');
        }
        return view('User/profile')->with('user', $user)->with('posts', \App\Models\Post::where('author', $username)->get());
    }
}

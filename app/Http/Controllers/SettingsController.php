<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.post-settings.index', [
            'users' => User::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('dashboard.post-settings.post', [
            'post' => $post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('dashboard.post-settings.edit', [
            'post' => $post,
            'categories' => Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, Post $post)
    {
        $rules = [
            'title' => 'required|max:255',
            'category_id' => 'required',
            'image' => 'image|file|max:1024',
            'body' => 'required'
        ];

        // Jika slug diubah, lakukan validasi unik slug
        if ($request->slug != $post->slug) {
            $rules['slug'] = 'required';
        }

        $validatedData = $request->validate($rules);

        if ($request->hasFile('image')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }

            $validatedData['image'] = $request->file('image')->store('post-images');
            $validatedData['excerpt'] = Str::limit(strip_tags($request->body), 200);
        } else {
            // Jika tidak ada gambar baru, pertahankan data gambar lama
            unset($validatedData['image']);
            // Anda juga dapat mempertahankan data excerpt yang sebelumnya jika diperlukan
        }

        // Jika slug tidak diubah, gunakan slug yang lama
        if ($request->slug == $post->slug) {
            $validatedData['slug'] = $post->slug;
        }

        Post::where('id', $_POST['id'])->update($validatedData);


    // Use route() helper to generate the redirect URL with the user ID
    return redirect()->route('post-settings.detail', ['user' => $_POST['userId']])->with('success', 'Post updated');

    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */

    public function destroy()
    {
        $postId = $_POST['id'];

        // Cari data post berdasarkan $postId
        $post = Post::find($postId);

        if (!$post) {
            // Jika data post tidak ditemukan, alihkan pengguna dengan pesan error
            return redirect('/dashboard/post-settings')->with('error', 'Post not found!');
        }

        // Menghapus gambar terkait (jika ada)
        if ($post->image) {
            Storage::delete($post->image);
        }

        // Menghapus data post berdasarkan $postId
        $post->delete();

        // Alihkan pengguna ke halaman /dashboard/settings dengan pesan sukses
        return redirect('/dashboard/post-settings')->with('success', 'Post has been deleted!');
    }



    public function detail($userId)
    {
        return view('dashboard.post-settings.detail', [
            "posts" => Post::where('user_id', $userId)->get(),
            "user" => User::where('id', $userId)->get()
        ]);
    }
}

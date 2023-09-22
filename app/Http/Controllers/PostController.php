<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        // get posts
        $posts = Post::latest()->paginate(5);

        // render view with post
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        // render view with post
        return view('posts.create');
    }

    public function store(Request $request)
    {
        //validate form
       $this->validate($request, [
        'image'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'title'     => 'required|min:5',
        'content'   => 'required|min:10'
       ]);

       //upload image
       $image = $request->file('image');
       $image->storeAs('public/posts', $image->hashName());

       // create
       Post::create([
            'image'     => $image->hashName(),
            'title'     => $request->title,
            'content'   => $request->content
       ]);

       return redirect()->route('posts.index')->with(['success'=>'Data berhasil disimpan!']);
    }

    public function edit(Post $post)
    {
        // render view with post
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        //validate form
       $this->validate($request, [
        'image'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'title'     => 'required|min:5',
        'content'   => 'required|min:10'
       ]);

      // check if image is upload 
      if($request->hashFile('image')) {
          //upload new image
          $image = $request->file('image');
          $image->storeAs('public/posts', $image->hashName());

          // delete old image
          Storage::delete('public/posts/'. $post->image);

          Post::update([
            'image'     => $image->hashName(),
            'title'     => $request->title,
            'content'   => $request->content
       ]);

        } else {
            
            Post::update([
                'title'     => $request->title,
                'content'   => $request->content
           ]);

        }
         return redirect()->route('posts.index')->with(['success'=>'Data berhasil diupdate!']);
    }

    public function destroy(Post $post)
    {
        Storage::delete('public/posts/'. $post->image);

        // delete post
        $post ->delete();
        // render view with post
        return redirect()->route('posts.index')->with(['success'=>'Data berhasil dihapus!']);
    }

    public function show(string $id)
    {
        $post = Post::findOrFail($id);
        // render view with post
        return view('posts.edit', compact('post'));
    }
}

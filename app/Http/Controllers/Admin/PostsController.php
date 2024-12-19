<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostsController extends Controller
{
    public function index(Request $request)
    {
        // Іздеу сұранысын аламыз
        $search = $request->get('search', '');

        // Егер іздеу сөзі болса, сүзгіні қолданамыз
        if ($search) {
            $posts = Post::where('title', 'like', "%{$search}%")
                ->orWhere('content', 'like', "%{$search}%")
                ->get();
        } else {
            // Егер іздеу жоқ болса, барлық жазбаларды аламыз
            $posts = Post::all();
        }

        return view('admin.posts.index', compact('posts'));
    }
}

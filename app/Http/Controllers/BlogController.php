<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class BlogController extends Controller
{
    public function index(Request $request)
    {

        $validated = $request->validate([
            'search' => ['nullable', 'string', 'max:50'],
            'from_date' => ['nullable', 'string', 'date'],
            'to_date' => ['nullable', 'string', 'date', 'after_or_equal:from_date'],
            'content' => ['nullable', 'string', 'max:50'],
            'tags' => ['nullable', 'string'],
        ]);

        $query = Post::query();

        if (Auth::user()->isAdmin()) {
        } else {
            $query
                ->where('published', true)
                ->whereNotNull('published_at')
                ->where('published_at', '<=', now());
        }


        if ($search = $validated['search'] ?? null) {
            $query->where('title', 'like', "%{$search}%");
        }
        if ($fromdate = $validated['from_date'] ?? null) {
            $query->where('published_at', '>=', new Carbon($fromdate));
        }
        if ($todate = $validated['to_date'] ?? null) {
            $query->where('published_at', '<=', new Carbon($todate));
        }
        if ($content = $validated['content'] ?? null) {
            $query->where('content', 'like', "%{$content}%");
        }
        if ($tag = $validated['tags'] ?? null) {
            $query->whereJsonContains('tags', $tag);
        }

        $posts = $query->latest('published_at')->paginate(12, ['id', 'title', 'published_at', 'tags', 'published']);

        return view('blog.index', compact('posts'));
    }
    public function show(Post $post)
{
    $post_id = $post->id;

    $comments = Comment::query()
        ->where('post_id', $post_id)
        ->orderBy('created_at')
        ->join('users', 'comments.user_id', '=', 'users.id')
        ->select('comments.*', 'users.name as user_name', 'users.avatar as user_avatar')
        ->get();

    return view('blog.show', compact('post', 'comments'));
}


    public function deletePostPhotos(Request $request)
    {
        $postIdPhotos = $request->input('post_id_photo');
        $fileName = $request->input('file_name');
        $post = Post::find($postIdPhotos);

        if ($post) {
            $files = json_decode($post->file, true);

            if (is_array($files)) {
                $updatedFiles = array_filter($files, function ($file) use ($fileName) {
                    return $file !== $fileName;
                });

                $post->file = json_encode($updatedFiles);
                $post->save();

                $filePathPh = public_path('files/' . $fileName);
                if (File::exists($filePathPh)) {
                    File::delete($filePathPh);
                }

                logActivity("Delete file $fileName from post: $post->title");
            }
        }

        return redirect()->back();
    }
    public function like($post)
    {
        return 'MAKE like';
    }
}

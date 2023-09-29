<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:100'],
            'content' => ['required', 'string'],
            'published_at' => ['nullable', 'string', 'date'],
            'published' => ['nullable', 'boolean'],
            'file' => ['nullable', 'array'],
            'file.*' => ['nullable', 'mimes:jpeg,png,jpg,gif,pdf', 'max:5000'],
            'tags' => ['nullable', 'string'],
        ]);

        $tagsArray = [];
        if ($validated['tags']) {
            $tagsArray = explode(',', $validated['tags']);
        }
        $tagsJson = json_encode($tagsArray);

        $post = new Post([
            'user_id' => auth()->user()->id,
            'title' => $validated['title'],
            'content' => $validated['content'],
            'published_at' => new Carbon($validated['published_at'] ?? null),
            'published' => $validated['published'] ?? false,
            'tags' => $tagsJson,
        ]);

        $post->save();

        if ($request->hasFile('file')) {
            $filePaths = [];
            foreach ($request->file('file') as $file) {
                $filePath = $file->store('', 'files');
                $filePaths[] = $filePath;
            }
            $post->file = $filePaths;
            $post->save();
        }

        logActivity(__('Новая запись в Блоге: ') . $post->title);

        return redirect()->route('admin.posts.show', $post);
    }

    public function show(Post $post)
    {
        return view('admin.show', compact(('post')));
    }

    public function edit(Post $post)
    {
        return view('admin.edit', compact('post'));
    }
    public function update(Request $request, $id)
    {
        $validated = validate($request->all(), [

            'title' => ['required', 'string', 'max:100'],
            'content' => ['required', 'string'],
            'published_at' => ['nullable', 'string', 'date'],
            'published' => ['nullable', 'boolean'],
            'file' => ['nullable', 'array'],
            'file.*' => ['nullable', 'mimes:jpeg,png,jpg,gif,pdf', 'max:5000'],
            'tags' => ['nullable', 'string']
        ]);

        $tagsArray = [];
        if ($validated['tags']) {
            $tagsArray = explode(',', $validated['tags']);
        }
        $tagsJson = json_encode($tagsArray);

        $post = Post::find($id);

        if ($request->hasFile('file')) {
            $filePaths = $post->file ? json_decode($post->file, true) : []; // Получаем уже существующие файлы или пустой массив

            foreach ($request->file('file') as $file) {
                $filePath = $file->store('', 'files');
                $filePaths[] = $filePath; // Добавляем новый файл в массив
            }

            $post->update(['file' => json_encode($filePaths)]); // Обновляем поле с файлами
        }

        $post->update([
            'user_id' => User::query()->value('id'),
            'title' => $validated['title'],
            'content' => $validated['content'],
            'published_at' => new Carbon($validated['published_at'] ?? null),
            'published' => $validated['published'] ?? false,
            'tags' => $tagsJson,
        ]);

        logActivity("Изменение в Блоге: $post->title");

        return redirect()->route('admin.posts.show', $post);
    }

    public function destroy(Request $request)
    {
        $postId = $request->input('post_id');
        $delete = Post::find($postId);
        $post = Post::find($postId);

        if ($post) {
            $comments = Comment::where('post_id', $postId)->get();

            foreach ($comments as $comment) {
                $files = json_decode($comment->file, true);
                if (is_array($files)) {
                    foreach ($files as $filePath) {
                        $filePath = public_path('files/' . $filePath);
                        if (File::exists($filePath)) {
                            File::delete($filePath);
                        }
                    }
                }
                $comment->delete();
            }
        }

        if ($delete) {
            $files = json_decode($delete->file, true);
            if (is_array($files)) {
                foreach ($files as $filePath) {
                    $filePath = public_path('files/' . $filePath);
                    if (File::exists($filePath)) {
                        File::delete($filePath);
                    }
                }
            }

            $delete->delete();

            logActivity("Удаление статьи из Блога: $delete->title");
            return redirect()->route('blog');
        } else {
            return redirect()->route('blog');
        }
    }



    public function like()
    {
        return 'Like + 1';
    }
}

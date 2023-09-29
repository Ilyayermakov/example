<?php

namespace App\Http\Controllers\Table;

use App\Http\Controllers\Controller;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class JobController extends Controller
{
    public function index(Request $request)
    {
        $query = Job::query();
        $jobs = $query
            ->get();

        return $jobs;
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'file' => ['nullable', 'array'],
            'file.*' => ['nullable', 'image:jpeg,png,jpg,gif', 'max:5000'], // Увеличил максимальный размер до 5000 Кб
        ]);

        if ($request->hasFile('file')) {
            foreach ($request->file('file') as $file) {
                $filePath = $file->store('', 'job'); // Можно указать папку public, чтобы файлы были доступны через URL
                Job::create([
                    'file' => $filePath,
                ]);
            }

            if (file_exists(public_path('files/' . $filePath))) {
                logActivity("Добавление фотографии на главную страницу: $filePath");
            }
        }
        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        $fileId = $request->input('file_id');
        $delete = Job::find($fileId);
        if ($delete) {
            $filePath = public_path('img/job/' . $delete->file);
            if (File::exists($filePath)) {
                File::delete($filePath);
            }
            $delete->delete();
            logActivity("Удаление фотографии с главной страницы: $delete->file");
            return redirect()->route('home');
        } else {
            return redirect()->route('home');
        }
    }
}

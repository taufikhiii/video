<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $video = Video::latest()->paginate(2);
        return view('video.index', compact('video'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('video.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'video' => ['required', 'file', 'mimetypes:video/mp4,video/mpeg,video/quicktime', 'max:10240'], // Batas ukuran video 10 MB
            'caption' => 'nullable|string|max:100', // Batas panjang caption 100 karakter, boleh kosong
        ]);        
        

        // Mengambil ID pengguna yang sedang login
    $user= auth()->user();

    $video = new Video();
    $video->created_by = $user->id;
    $video->video = $request->file('video')->store('videos');
    $video->caption = $request->caption;
    $video->save();


        return redirect()->route('video.index')->with('success', 'Video Berhasil disimpan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Video $video)
    {
        // Hapus video dari penyimpanan sebelum menghapus data dari database
        if ($video->video) {
            Storage::delete($video->video);
        }

        if ($video->delete()) {
            return redirect()->route('video.index')->with('success', 'Video berhasil dihapus!');
        }

        return redirect()->route('video.index')->with('error', 'Gagal menghapus video.');
    }
}

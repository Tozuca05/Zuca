<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Playlist;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class AdminPlaylistController extends Controller
{
    public function index(): View
    {
        $viewData = [];
        $viewData["title"] = "Admin Page - Playlists - Online Store";
        $viewData["playlists"] = Playlist::with('tag')->get();
        $viewData["tags"] = Tag::all(); 
        return view('admin.playlist.index')->with("viewData", $viewData);
    }

    public function create(): View
    {
        $viewData = [];
        $viewData["title"] = "Admin Page - Create Playlist - Online Store";
        $viewData["tags"] = Tag::all();
        return view('admin.playlist.create')->with("viewData", $viewData);
    }

    public function store(Request $request): RedirectResponse
    {
        Playlist::validate($request);

        $newPlaylist = new Playlist();
        $newPlaylist->setName($request->input('name'));
        $newPlaylist->setLink($request->input('link'));
        $newPlaylist->setTagId($request->input('tag_id'));

        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('img'), $imageName);
            $newPlaylist->setImageUrl('img/'.$imageName);
        }

        $newPlaylist->save();

        return redirect()->route('admin.playlist.index')
            ->with('success', 'Playlist created successfully');
    }

    public function edit(string $id): View
    {
        $viewData = [];
        $playlist = Playlist::findOrFail($id);
        $viewData["title"] = "Admin Page - Edit Playlist - Online Store";
        $viewData["playlist"] = $playlist;
        $viewData["tags"] = Tag::all();
        return view('admin.playlist.edit')->with("viewData", $viewData);
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        Playlist::validate($request);

        $playlist = Playlist::findOrFail($id);
        $playlist->setName($request->input('name'));
        $playlist->setLink($request->input('link'));
        $playlist->setTagId($request->input('tag_id'));

        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('img'), $imageName);
            $playlist->setImageUrl('img/'.$imageName);
        }

        $playlist->save();

        return redirect()->route('admin.playlist.index')
            ->with('success', 'Playlist updated successfully');
    }

    public function delete(string $id): RedirectResponse
    {
        Playlist::destroy($id);
        return redirect()->route('admin.playlist.index')
            ->with('success', 'Playlist deleted successfully');
    }

    public function show(string $id): View
    {
        $viewData = [];
        $playlist = Playlist::findOrFail($id);
        $viewData["title"] = $playlist->getName() . " - Admin - Online Store";
        $viewData["subtitle"] = $playlist->getName() . " - Playlist Information";
        $viewData["playlist"] = $playlist;
        return view('admin.playlist.show')->with("viewData", $viewData);
    }
}
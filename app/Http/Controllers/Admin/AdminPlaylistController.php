<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Playlist;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminPlaylistController extends Controller
{
    // Muestra todas las playlists
    public function index(): View
    {
        $viewData = [];
        $viewData['title'] = 'Admin Page - Playlists - Online Store';
        $viewData['subtitle'] = 'Manage your playlists';
        $viewData['playlists'] = Playlist::with('tag')->get(); // Carga las playlists junto con sus tags
        $viewData['tags'] = Tag::all(); // Carga todos los tags

        return view('admin.playlist.index')->with('viewData', $viewData);
    }

    // Muestra el formulario para crear una nueva playlist
    public function create(): View
    {
        $viewData = [];
        $viewData['title'] = 'Admin Page - Create Playlist - Online Store';
        $viewData['tags'] = Tag::all(); // Carga todos los tags para el formulario

        return view('admin.playlist.create')->with('viewData', $viewData);
    }

    // Almacena una nueva playlist
    public function store(Request $request): RedirectResponse
    {
        // Cambia la validación para el campo "link" a texto normal
        $request->validate([
            'name' => 'required|string|max:255',
            'link' => 'required|string', // Cambiado de 'url' a 'string'
            'tag_id' => 'required|exists:tags,id',
            'image' => 'required|file|image|max:2048', // Validación de imagen
        ]);

        $newPlaylist = new Playlist;
        $newPlaylist->setName($request->input('name'));
        $newPlaylist->setLink($request->input('link')); // Acepta texto normal
        $newPlaylist->setTagId($request->input('tag_id'));

        // Manejo de la carga de la imagen
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('img'), $imageName);
            $newPlaylist->setImageUrl('img/' . $imageName);
        }

        $newPlaylist->save(); // Guarda la nueva playlist

        return redirect()->route('admin.playlist.index')
            ->with('success', 'Playlist created successfully');
    }

    // Muestra el formulario para editar una playlist existente
    public function edit(string $id): View
    {
        $viewData = [];
        $playlist = Playlist::findOrFail($id); // Encuentra la playlist por ID
        $viewData['title'] = 'Admin Page - Edit Playlist - Online Store';
        $viewData['playlist'] = $playlist; // Pasa la playlist a la vista
        $viewData['tags'] = Tag::all(); // Carga todos los tags

        return view('admin.playlist.edit')->with('viewData', $viewData);
    }

    // Actualiza una playlist existente
    public function update(Request $request, string $id): RedirectResponse
    {
        // Cambia la validación para el campo "link" a texto normal
        $request->validate([
            'name' => 'required|string|max:255',
            'link' => 'required|string', // Cambiado de 'url' a 'string'
            'tag_id' => 'required|exists:tags,id',
            'image' => 'nullable|file|image|max:2048', // Validación de imagen (opcional)
        ]);

        $playlist = Playlist::findOrFail($id); // Encuentra la playlist por ID
        $playlist->setName($request->input('name'));
        $playlist->setLink($request->input('link')); // Acepta texto normal
        $playlist->setTagId($request->input('tag_id'));

        // Manejo de la carga de la imagen
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('img'), $imageName);
            $playlist->setImageUrl('img/' . $imageName);
        }

        $playlist->save(); // Guarda los cambios en la playlist

        return redirect()->route('admin.playlist.index')
            ->with('success', 'Playlist updated successfully');
    }

    // Elimina una playlist
    public function delete(string $id): RedirectResponse
    {
        Playlist::destroy($id); // Elimina la playlist por ID

        return redirect()->route('admin.playlist.index')
            ->with('success', 'Playlist deleted successfully');
    }

    // Muestra detalles de una playlist específica (opcional)
    public function show(string $id): View
    {
        $viewData = [];
        $playlist = Playlist::findOrFail($id); // Encuentra la playlist por ID
        $viewData['title'] = $playlist->getName() . ' - Admin - Online Store';
        $viewData['subtitle'] = $playlist->getName() . ' - Playlist Information';
        $viewData['playlist'] = $playlist; // Pasa la playlist a la vista

        return view('admin.playlist.show')->with('viewData', $viewData);
    }
}

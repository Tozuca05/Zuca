<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Playlist;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PlaylistController extends Controller
{
    public function index(Request $request): View
    {
        $userId = Auth::id();
        $order = Order::where('user_id', $userId)->latest()->first();

        $playlist = null;

        if ($order) {
            $playlist = $order->getAssociatedPlaylist();
        } else {
            return redirect()->route('order.index')->with('error', 'No orders found for this user.');
        }

        $viewData = [
            'title' => 'Playlist - Zuca',
            'subtitle' => 'Playlist correspondiente',
            'playlist' => $playlist,
        ];

        return view('playlist.index')->with('viewData', $viewData);
    }

    public function show(string $id): View|RedirectResponse
    {
        try {
            $playlist = Playlist::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return redirect()->route('playlists.index')->with('error', 'Playlist not found.');
        }
    
        $viewData = [
            'title' => 'Playlist Details - Zuca',
            'subtitle' => 'Playlist Information',
            'playlist' => $playlist,
        ];
    
        return view('playlist.show')->with('viewData', $viewData);
    }
    
    public function getAssociatedPlaylist(Request $request): RedirectResponse
    {
        $orderId = $request->input('order_id'); 
        $order = Order::findOrFail($orderId); 

        $playlist = $order->getAssociatedPlaylist();

        if ($playlist) {
            return redirect()->route('playlists.show', ['id' => $playlist->getId()]);
        }

        return redirect()->route('order.index')->with('error', 'No se encontró una playlist asociada.');
    }
}

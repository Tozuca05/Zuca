<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminItemController extends Controller
{
    
    public function topSoldProducts(): View
    {
        $viewData = [];
        $viewData['title'] = 'Productos Más Vendidos - Admin - Zuca Store';
        $viewData['topProducts'] = Item::selectRaw('product_id, SUM(quantity) as total_sold')
            ->join('orders', 'items.order_id', '=', 'orders.id')
            ->where('orders.status', 'Paid')
            ->groupBy('product_id')
            ->orderByDesc('total_sold')
            ->limit(3)
            ->with('product')
            ->get();
        return view('admin.item.top_sold')->with('viewData', $viewData);
    }
}


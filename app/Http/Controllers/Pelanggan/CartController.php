<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        return view('pelanggan.cart');
    }
    public function add(Menu $menu)
    {
        $cart = session()->get('cart', []);
        $id = $menu->id;

        if (!isset($cart[$id])) {
            $cart[$id] = [
                'name' => $menu->name,
                'price' => $menu->price,
                'image' => $menu->image,
                'quantity' => 1
            ];
        } else {
            $cart[$id]['quantity']++;
        }

        session()->put('cart', $cart);
        return response()->json(['success' => true, 'cartCount' => count($cart)]);
    }
    public function update(Request $request)
    {
        $action = $request->input('action');
        $id = $request->input('id');

        $cart = session('cart', []);

        if (!isset($cart[$id])) {
            return response()->json(['status' => 'error', 'message' => 'Item tidak ditemukan'], 404);
        }

        switch ($action) {
            case 'increase':
                $cart[$id]['quantity'] += 1;
                break;
            case 'decrease':
                $cart[$id]['quantity'] = max(1, $cart[$id]['quantity'] - 1);
                break;
            case 'remove':
                unset($cart[$id]);
                break;
        }

        session(['cart' => $cart]);

        return response()->json([
            'status' => 'success',
            'cart' => $cart,
            'total' => collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']),
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Meja;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderMenu;
use App\Models\Payment;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $nomorMeja = session('nomor_meja');

        if (!$nomorMeja) {
            abort(403, 'Nomor meja tidak ditemukan.');
        }

        $meja = Meja::where('nomor_meja', $nomorMeja)->firstOrFail();
        $categories = Category::all();

        $menusByCategory = [];
        foreach ($categories as $cat) {
            $menusByCategory[$cat->name_category] = Menu::whereHas('categories', function ($query) use ($cat) {
                $query->where('name_category', $cat->name_category);
            })->get();
        }

        $cartCount = collect(session('cart'))->sum('quantity') ?? 0;

        return view('pelanggan.menu', compact('menusByCategory', 'meja', 'cartCount', 'categories'));
    }



    public function cart()
    {
        //
    }

    public function order(Request $request)
    {
        $orderMenus = json_decode($request->get("order_menus"));
        $total = 0;

        foreach ($orderMenus as $menu) {
            $total += $menu->price * $menu->quantity;
        }

        $prepare_order = [
            "table_number" => $request->get("table_number"),
            "total" => $total
        ];

        try {
            $order = Order::create($prepare_order);

            foreach ($orderMenus as $menu) {
                OrderMenu::create([
                    "order_id" => $order->id,
                    "menu_id" => $menu->id,
                    "quantity" => $menu->quantity,
                    "price" => $menu->price,
                ]);
            }

            return redirect("payment/$order->id");
        } catch (\Throwable $th) {
            return redirect("cart")->with("alert-failed", "Data failed to create!" . $th->getMessage())->withInput();
        }
    }

    public function payment(Order $order)
    {
        return view("payment", ["order" => $order]);
    }

    public function handlePayment(Request $request)
    {
        try {
            $payment = Payment::create($request->all());
            return redirect("receipt/$payment->id");
        } catch (\Throwable $th) {
            return redirect("cart")->with("alert-failed", "Data failed to create!" . $th->getMessage())->withInput();
        }
    }

    public function receipt(Payment $payment)
    {
        return view("receipt", ["data" => $payment]);
    }
}

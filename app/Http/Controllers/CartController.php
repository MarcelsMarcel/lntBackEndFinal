<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Invoice;

class CartController extends Controller
{
    public function add($id)
    {
        $userId = Auth::id();
        $cart = session()->get("cart.$userId", []);


        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $product = Product::findOrFail($id);
            $cart[$id] = [
                "name" => $product->name,
                "price" => $product->price,
                "quantity" => 1,
                "image" => $product->image
            ];
        }

        session()->put("cart.$userId", $cart);

        return redirect()->back()->with('success', 'Book added to cart!');
    }


public function buy($id)
    {
        $product = Product::findOrFail($id);
        $user = Auth::user();

        if ($user->money < $product->price) {
            return redirect()->back()->with('error', 'Insufficient balance.');
        }

        // Deduct the user's balance
        $user->money -= $product->price;
        $user->save();

        Invoice::create([
            'user_id' => $user->id,
            'product_id' => $product->id,
            'quantity' => 1,
            'total_price' => $product->price
        ]);

        return redirect()->route('user.home')->with('success', 'Book purchased successfully!');
    }

    public function view()
    {
        $userId = Auth::id();
        $cart = session()->get("cart.$userId", []);

        return view('cart.index', compact('cart'));
    }

    public function remove($id)
    {
        $userId = Auth::id();
        $cart = session()->get("cart.$userId", []);


        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put("cart.$userId", $cart);
        }

        return redirect()->route('cart.view')->with('success', 'Item removed from cart.');
    }

    public function checkout()
    {
        $user = Auth::user();
        $userId = $user->id;
        $cart = session()->get("cart.$userId", []);

        if (empty($cart)) {
            return redirect()->route('cart.view')->with('error', 'Cart is empty.');
        }

        $total = 0;
        foreach ($cart as $productId => $item) {
            $total += $item['price'] * $item['quantity'];
        }

        if ($user->money < $total) {
            return redirect()->route('cart.view')->with('error', 'Insufficient balance.');
        }

        $user->money -= $total;
        $user->save();

        foreach ($cart as $productId => $item) {
            Invoice::create([
                'user_id' => $user->id,
                'product_id' => $productId,
                'quantity' => $item['quantity'],
                'total_price' => $item['price'] * $item['quantity']
            ]);
        }

        session()->forget("cart.$userId");

        return redirect()->route('user.home')->with('success', 'Checkout successful! Total deducted: Rp' . $total);
    }
    public function invoices()
    {
        $invoices = Invoice::where('user_id', Auth::id())->with('product')->latest()->get();
        return view('cart.invoices', compact('invoices'));
    }
}

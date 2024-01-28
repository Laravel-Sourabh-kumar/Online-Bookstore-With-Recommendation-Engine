<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Cart;
use Illuminate\Http\Request;
class ShoppingCartController extends Controller
{
    public function add_to_cart(Request $request)
    {
        $book = Book::findOrFail($request->book_id);

        if ($book->quantity >= $request->quantity){

            if ($request->quantity >= 1)
            {
                $cartItem = Cart::add([
                    'id' => $book->id,
                    'name' => $book->title,
                    'price' => $book->price,
                    'quantity' => $request->quantity,
                    'weight' => 0,
                    'options' => [
                        'image' => $book->image
                    ]
                ]);
                return redirect()->back();
            }
            else
                {
                return redirect()->back()
                    ->with('cart_alert', "Quantity must be larger than 0");
                }

        }
        else {
            return redirect()->back()
                ->with('cart_alert', "We don't have that much quantity.");
        }

    }

    public function cart()
    {
        return view('public.cart');
    }

    public function cart_delete($id)
    {
        Cart::remove($id);
        return redirect()->back();
    }
    public function cart_increment($id, $quantity, $book_id)
    {

     // dd($quantity);  
        $book = Book::findOrFail($book_id);

        if($book->quantity > $quantity)
        {
            // Cart::update($id, $quantity+1);
            Cart::update($id,[
                'quantity' => $quantity+1
                ]);
            return redirect()->back();
        }
        else
        {
            return redirect()->back()
                ->with('cart_alert', "No more quantity left in stock for this book");
        }

    }


    public function cart_decrement($id, $quantity)
    {
       // dd($quantity);  
         Cart::update($id,[
            'quantity' => $quantity-1
            ]);
        return redirect()->back();
    }
}

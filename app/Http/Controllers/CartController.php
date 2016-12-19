<?php
/**
 * Created by PhpStorm.
 * User: lenskart
 * Date: 16/12/16
 * Time: 17:49
 */

namespace App\Http\Controllers;


use App\Cart;
use Laravel\Lumen\Routing\Controller;
use Illuminate\Http\Request;

/**
 * Class CartController
 * @package App\Http\Controllers
 */
class CartController extends Controller
{


    /**
     * CartController constructor.
     */
    public function __construct()
    {
        //only for logged in user
        $this->middleware('auth:api');
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        $carts = Cart::all();
        return response()->json($carts);
    }

    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getCart($id)
    {
        $cart = Cart::find($id);
        return response()->json($cart);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function createCart(Request $request)
    {

        $this->validate($request, [
            'product_id' => 'required',
            'user_id' => 'required',
            'product_quantity' => 'required',
        ]);


        $cart = Cart::create($request->all());
        return response()->json($cart);
    }

    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function deleteCart($id)
    {
        $cart = Cart::find($id);
        $cart->delete();
        return response()->json('deleted');
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function updateCart(Request $request, $id)
    {
        $cart = Cart::find($id);
        $cart->product_quantity = $request->input('product_quantity');
        $cart->save();
        return response()->json($cart);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function removeCart(Request $request)
    {

        $this->validate($request, [
            'product_id' => 'required',
            'user_id' => 'required',
        ]);

        $cart = Cart::where('product_id', $request->input('product_id'))
            ->where('user_id', $request->input('user_id'))
            ->where('status', 'in_cart')
            ->get();

        if (empty($cart))
            return response()->json('no record found');

        list($cart) = $cart;

        $cart->status = 'removed_from_cart';
        $cart->save();
        return response()->json($cart);
    }


}
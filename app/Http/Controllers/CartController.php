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
use Symfony\Component\HttpFoundation\Request;

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

}
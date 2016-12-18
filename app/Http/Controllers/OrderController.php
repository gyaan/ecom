<?php
/**
 * Created by PhpStorm.
 * User: lenskart
 * Date: 15/12/16
 * Time: 13:58
 */

namespace App\Http\Controllers;


use App\Order;
use Laravel\Lumen\Routing\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class OrderController
 * @package App\Http\Controllers
 */
class OrderController extends Controller
{
    /**
     * OrderController constructor.
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
        $orders = Order::all();
        return response()->json($orders);
    }

    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getOrder($id)
    {
        $order = Order::find($id);
        return response()->json($order);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function createOrder(Request $request)
    {
        $order = Order::create($request->all());
        return response()->json($order);
    }

    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function deleteOrder($id)
    {
        $order = Order::find($id);
        $order->delete();
        return response()->json('deleted');
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function updateOrder(Request $request, $id)
    {
        $order = Order::find($id);
        $order->title = $request->input('total_amount');
        $order->author = $request->input('total_items');
        $order->save();
        return response()->json($order);
    }
}
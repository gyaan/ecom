<?php
/**
 * Created by PhpStorm.
 * User: lenskart
 * Date: 15/12/16
 * Time: 09:27
 */

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

/**
 * Class ProductController
 * @package App\Http\Controllers
 */
class ProductController extends Controller
{
    /**
     * ProductController constructor.
     */
    public function __construct()
    {
        //only for logged in user
        $this->middleware('admin', ['only' => [
            'createProduct',
            'deleteProduct',
            'updateProduct',
        ]]);

    }


    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        $products = Product::all();
        return response()->json($products);
    }

    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getProduct($id)
    {
        $product = Product::find($id);
        return response()->json($product);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function createProduct(Request $request)
    {

        $this->validate($request, [
            'sku' => 'required',
            'cost_price' => 'required',
            'selling_price' => 'required',
            'quantity' => 'required',
        ]);

        //check if product already exist
        $existingProduct = Product::where(array('sku' => $request->input('sku')))->get();
        if (empty($existingProduct))
            return response()->json('product already exist');

        //lets do some modification
        $requestArray = $request->all();
        $requestArray['cost_price'] = (float)$requestArray['cost_price'];
        $requestArray['selling_price'] = (float)$requestArray['selling_price'];
        $requestArray['is_feature'] = $requestArray['is_feature'] == true ? 1 : 0;

        $product = Product::create($requestArray);
        return response()->json($product);
    }

    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function deleteProduct($id)
    {
        $product = Product::find($id);
        $product->delete();
        return response()->json('deleted');
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function updateProduct(Request $request, $id)
    {
        $product = Product::find($id);
        $product->title = $request->input('name');
        $product->author = $request->input('sku');
        $product->isbn = $request->input('selling_price');
        $product->save();
        return response()->json($product);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getLatestFeaturedProducts()
    {

        $product = Product::where('is_active', 1)
            ->where('is_feature', 1)
            ->orderBy('created_at', 'desc')
            ->take(env('LATEST_FEATURED_PRODUCTS'))
            ->get();
        return response()->json($product);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getLatestProducts()
    {
        $products = Product::where('is_active', 1)
            ->orderBy('created_at', 'desc')
            ->take(env('LATEST_PRODUCT_COUNT'))
            ->get();
        return response()->json($products);
    }

}
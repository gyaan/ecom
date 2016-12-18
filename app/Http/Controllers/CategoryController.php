<?php
/**
 * Created by PhpStorm.
 * User: lenskart
 * Date: 17/12/16
 * Time: 22:24
 */

namespace App\Http\Controllers;

use Symfony\Component\HttpKernel\Tests\Controller;

class CategoryController extends Controller
{
    /**
     * CategoryController constructor.
     */
    public function __construct()
    {
    }

    public function getProducts($id)
    {
        //get the products from relationship
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: lenskart
 * Date: 15/12/16
 * Time: 15:23
 */

namespace App\Http\Controllers;


use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/**
 * Class UserController
 * @package App\Http\Controllers
 */
class UserController extends Controller
{


    /**
     * UserController constructor.
     */
    public function __construct()
    {
//        $this->middleware('auth:api');
//        $this->middleware('admin');
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getUser($id)
    {
        $user = User::find($id);
        return response()->json($user);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function createUser(Request $request)
    {

        $userDetails = $request->all();
        $userDetails['password'] = Hash::make($userDetails['password']);
        $user = User::create($userDetails);
        return response()->json($user);

    }

    /**
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function updateUser(Request $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->input('name');
        $user->save();
        return response()->json($user);

    }

    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function deleteUser($id)
    {
        $user = User::find($id);
        $user->delete();
        return response()->json('deleted');
    }

}
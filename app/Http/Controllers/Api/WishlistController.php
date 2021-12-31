<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Helpers\Helper;
use App\Models\Prodcut;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\WishlistRequest;

class WishlistController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $wishlists = Auth::user()->wishlist;

            if (count($wishlists) == 0) {
                return Helper::error("There's no prodcuts in wishlist");
            }

            return Helper::successWithData('All prodcuts in wishlist', 'Wishlist', $wishlists);
        } catch (Exception $e) {
            return Helper::error('an error occured');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WishlistRequest $request)
    {
        try {
            if (Auth::user()->inWishlist($request->validated())) {
                return Helper::error('Prodcut already in wishlist');
            }

            Auth::user()->wishlist()->attach($request->validated());

            return Helper::success('Prodcut added successfully to wishlist');
        } catch (Exception $e) {
            return Helper::error('an error occured');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            if (!Auth::user()->inWishlist($id)) {
                return Helper::error('Prodcut not found in wishlist');
            }

            Auth::user()->wishlist()->detach($id);

            return Helper::success('Prodcut deleted successfully from wishlist');
        } catch (Exception $e) {
            return Helper::error('an error occured');
        }
    }

    public function clear()
    {
        try {
            if (count(Auth::user()->wishlist) == 0) {
                return Helper::error("There's no prodcuts in wishlist");
            }

            Auth::user()->wishlist()->detach();

            return Helper::success('All prodcut deleted successfully from wishlist');
        } catch (Exception $e) {
            return Helper::error('an error occured');
        }
    }
}

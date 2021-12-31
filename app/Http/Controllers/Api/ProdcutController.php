<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Helper;
use App\Models\Prodcut;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProdcutRequest;

class ProdcutController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:sanctum', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $prodcuts = Prodcut::all();
            return Helper::successWithData('All Prodcuts', 'Prodcuts', $prodcuts);
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
    public function store(ProdcutRequest $request)
    {
        try {
            $prodcut = Prodcut::create($request->validated());
            return Helper::successWithData('Prodcut created successfully', 'Prodcut', $prodcut);
        } catch (Exception $e) {
            return Helper::error('an error occured');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Prodcut  $prodcut
     * @return \Illuminate\Http\Response
     */
    public function show(Prodcut $prodcut)
    {
        try {
            return Helper::successWithData('Prodcut ' . $prodcut->id, 'Prodcut', $prodcut);
        } catch (Exception $e) {
            return Helper::error('an error occured');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Prodcut  $prodcut
     * @return \Illuminate\Http\Response
     */
    public function update(ProdcutRequest $request, Prodcut $prodcut)
    {
        try {
            $prodcut->update($request->validated());
            return Helper::successWithData('Prodcut updated successfully', 'Prodcut', $prodcut);
        } catch (Exception $e) {
            return Helper::error('an error occured');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Prodcut  $prodcut
     * @return \Illuminate\Http\Response
     */
    public function destroy(Prodcut $prodcut)
    {
        try {
            $prodcut->delete();
            return Helper::success('Prodcut deleted successfully');
        } catch (Exception $e) {
            return Helper::error('an error occured');
        }
    }
}

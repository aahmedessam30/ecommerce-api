<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Helper;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SubCategoryRequest;

class SubCategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:sanctum', ['except' => ['index', 'show', 'prodcut']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $sub_categories = SubCategory::all();
            return Helper::successWithData('All sub categories', 'Categories', $sub_categories);
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
    public function store(SubCategoryRequest $request)
    {
        try {
            $sub_category = SubCategory::create($request->validated());
            return Helper::successWithData('SubCategory created successfully', 'SubCategory', $sub_category);
        } catch (Exception $e) {
            return Helper::error('an error occured');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function show(SubCategory $subCategory)
    {
        try {
            return Helper::successWithData('SubCategory ' . $subCategory->id, 'SubCategory', $subCategory);
        } catch (Exception $e) {
            return Helper::error('an error occured');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function update(SubCategoryRequest $request, SubCategory $subCategory)
    {
        try {
            $subCategory->update($request->validated());
            return Helper::successWithData('SubCategory updated successfully', 'SubCategory', $subCategory);
        } catch (Exception $e) {
            return Helper::error('an error occured');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubCategory $subCategory)
    {
        try {
            $subCategory->delete();
            return Helper::success('SubCategory deleted successfully');
        } catch (Exception $e) {
            return Helper::error('an error occured');
        }
    }

    public function prodcut(SubCategory $subCategory)
    {
        try {
            return Helper::successWithData('All prodcuts for subcategory ' . $subCategory->id, 'Category', $subCategory->prodcuts);
        } catch (Exception $e) {
            return Helper::error('an error occured');
        }
    }
}

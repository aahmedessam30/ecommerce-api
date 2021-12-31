<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Exception;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:sanctum', ['except' => ['index', 'show', 'subCategory']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $categories = Category::all();
            return Helper::successWithData('All categories', 'Categories', $categories);
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
    public function store(CategoryRequest $request)
    {
        try {
            $category = Category::create($request->validated());
            return Helper::successWithData('Category created successfully', 'Category', $category);
        } catch (Exception $e) {
            return Helper::error('an error occured');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        try {
            return Helper::successWithData('Category ' . $category->id, 'Category', $category);
        } catch (Exception $e) {
            return Helper::error('an error occured');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, Category $category)
    {
        try {
            $category->update($request->validated());
            return Helper::successWithData('Category updated successfully', 'Category', $category);
        } catch (Exception $e) {
            return Helper::error('an error occured');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        try {
            $category->delete();
            return Helper::success('Category deleted successfully');
        } catch (Exception $e) {
            return Helper::error('an error occured');
        }
    }

    public function subCategory(Category $category)
    {
        try {
            return Helper::successWithData('All sub categories for category ' . $category->id, 'Category', $category->subCategories);
        } catch (Exception $e) {
            return Helper::error('an error occured');
        }
    }
}

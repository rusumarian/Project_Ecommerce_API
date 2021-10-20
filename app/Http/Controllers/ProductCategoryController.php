<?php namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        return response()->json(ProductCategory::all());
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate(['name' => ['required','string','max:255','unique:product_categories,name']]);
        $category = ProductCategory::create($validated);
        return response()->json($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return JsonResponse
     */
    public function update(Request $request, $id)
    {
        $category = ProductCategory::findOrFail($id);
        $validated = $request->validate(['name' => ['required','max:255','string']]);
        $category->update($validated);
        return response()->json($category);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $category = ProductCategory::findOrFail($id);
        $category->delete();
        return response(['message' => 'Category deleted!']);
    }
}

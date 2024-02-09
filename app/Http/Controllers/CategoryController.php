<?php

namespace App\Http\Controllers;

use App\Database\Eloquent\CategoryEloquent;
use App\Exports\Excel\CategoriesExport;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Maatwebsite\Excel\Facades\Excel;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = CategoryEloquent::getDataModel();

        return CategoryResource::collection($categories);
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreCategoryRequest $request
     */
    public function store(StoreCategoryRequest $request)
    {
        $category = Category::create($request->all());

        return new CategoryResource($category);
    }

    /**
     *  Display the specified resource.
     *  @param Category $category
     */
    public function show(Category $category)
    {
        return new CategoryResource($category);
    }

    /**
     *  Update the specified resource in storage.
     *  @param Category $category
     *  @param UpdateCategoryRequest $request
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->fill($request->all())->save();

        return new CategoryResource($category);
    }

    /**
     *  Remove the specified resource from storage.
     *  @param Category $category
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return new CategoryResource($category);
    }

    /**
     * Función exportar Excel.
     */
    public function export()
    {
        return Excel::download(new CategoriesExport, 'categories.xlsx');
    }

    /**
     *  Funcion expoertar PDF.
     *  @param Category $category
     */
    public function categoriesPdf(Category $category)
    {
        $categories= Category::all();
        $pdf = FacadePdf::loadView('pdf.categories', compact('categories'))->setPaper('A4');

        return $pdf->stream('categories.pdf');
    }
}

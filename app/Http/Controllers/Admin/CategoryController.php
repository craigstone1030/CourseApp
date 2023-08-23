<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreCategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        if (! Gate::allows('category_access')) {
            return abort(401);
        }

        $result = Category::where("parent_id", 0)->get();

        $categories =  array();

        foreach(collect($result)->toArray() as $row){
            array_push($categories, $row);
            $subcategory = collect(Category::where("parent_id", $row['id'])->get())->toArray();
            foreach($subcategory as $subrow){
                array_push($categories, $subrow);
            }
        }

        //dump($categories);exit;
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
    */

    public function create()
    {
        if (! Gate::allows('category_create')) {
            return abort(401);
        }

        $categories = Category::where("parent_id",  0)->get();

        return view('admin.categories.create', compact("categories"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        $data = $request->all();

        $data['category_image'] = $request->file('category_image')->store(
            'images/categories', 'public'
        );

        Category::create($data);

        return redirect()->route('admin.categories.index');
    }

    public function show( $id ) {

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCategoryRequest $request, Category $category)
    {
        $data = $request->all();

        if($request->has('category_image')){
            Storage::disk('public')->delete($category->category_image);

            $data['category_image'] = $request->file('category_image')->store(
                'images/categories', 'public'
            );
        }

        $category->update($data);

        return redirect()->route('admin.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy(Category $category)
    {
        if (! Gate::allows('category_delete')) {
            return abort(401);
        }

        if( $category->parent_id == 0 ) {
            $collection = Category::where('parent_id',$category->id)->get(['id']);
            Category::destroy($collection->toArray());
        }

        $category->delete();

        return redirect()->route('admin.categories.index');
    }

}

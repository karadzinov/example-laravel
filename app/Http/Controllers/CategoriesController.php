<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Categories::getTree();
        $data = ['categories' => $categories];
        return view('dashboard.categories.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $categories = Categories::getList();
        $data = ['categories' => $categories];
        return view('dashboard.categories.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $parent_id = $request->has('parent_id') ? $request->get('parent_id') : null;
        $category = Categories::create([
            'name' => $request->get('name'),
            'parent_id' => $parent_id
        ]);

        if(!$parent_id) {
            $category->saveAsRoot();
        }


        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Categories $category)
    {
        $categories = Categories::getList();

        $data = ['category' => $category, 'categories' => $categories];

        return view('dashboard.categories.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $name = $request->get('name');
        $category = Categories::FindOrFail($id);
        $parent_id = $request->has('parent_id') ? $request->get('parent_id') : null;

        if(!$parent_id) {
            $category->name = $name;
            $category->saveAsRoot();
            $category->save();
            return redirect()->back();
        }

        $input['name'] = $name;
        $input['parent_id'] = $parent_id;
        $category->fill($input)->save();
        return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Categories::FindOrFail($id);
        $category->delete();
        Categories::fixTree();
        return redirect()->route('categories.index');
    }
}

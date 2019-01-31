<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Products, App\Section;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $products = Products::where('name', 'LIKE', "%$keyword%")
                ->orWhere('description', 'LIKE', "%$keyword%")
                ->orWhere('section_id', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $products = Products::latest()->paginate($perPage);
        }

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $sections = Section::get()->pluck('name', 'id');

        return view('admin.products.create', compact('sections'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'id_number' => 'required',
            'first_name' => 'required',
            'last_name' => 'required'
        ]);
        $requestData = $request->all();
        
        Products::create($requestData);

        return redirect('admin/products')->with('flash_message', 'Products added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $section = Products::findOrFail($id);

        return view('admin.products.show', compact('section'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $section = Products::findOrFail($id);
        $sections = Section::get()->pluck('name', 'id');

        return view('admin.products.edit', compact('section'))->with('sections', $sections);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required'
        ]);
        $requestData = $request->all();
        
        $section = Products::findOrFail($id);
        $section->update($requestData);

        return redirect('admin/products')->with('flash_message', 'Products updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Products::destroy($id);

        return redirect('admin/products')->with('flash_message', 'Products deleted!');
    }

    public function list()
    {
        $products = Products::get();

        $return_array = [];

        foreach($products as $section) {
            $return_array[] = [
                'id' => $section->id,
                'name' => $section->name,
                'description' => $section->description,
            ];
        }

        return response()->json(['data' => $return_array]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Section, App\Location, App\Product;
use Illuminate\Http\Request;

class SectionsController extends Controller
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
            $sections = Section::where('name', 'LIKE', "%$keyword%")
                ->orWhere('description', 'LIKE', "%$keyword%")
                ->orWhere('location_id', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $sections = Section::latest()->paginate($perPage);
        }

        return view('admin.sections.index', compact('sections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $locations = Location::get()->pluck('name', 'id');
        // dd($locations);
        return view('admin.sections.create', compact('locations'));
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
			'name' => 'required',
			'description' => 'required'
		]);
        $requestData = $request->all();
        
        Section::create($requestData);

        return redirect('admin/sections')->with('flash_message', 'Section added!');
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
        $section = Section::findOrFail($id);

        // $products = Section::join('products', 'sections.id', '=', 'products.section_id')
        //     ->where('sections.id', $id)
        //     ->get();

        $products = Product::with('section')
            ->where('section_id', $id)
            ->get();

        // return $products;

        // return $products;

        return view('admin.sections.show', compact('section'))->with('products', $products);
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
        $section = Section::findOrFail($id);
        $locations = Section::get()->pluck('name', 'id');

        return view('admin.sections.edit', compact('section'))->with('locations', $locations);
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
        
        $section = Section::findOrFail($id);
        $section->update($requestData);

        return redirect('admin/sections')->with('flash_message', 'Section updated!');
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
        Section::destroy($id);

        return redirect('admin/sections')->with('flash_message', 'Section deleted!');
    }
}

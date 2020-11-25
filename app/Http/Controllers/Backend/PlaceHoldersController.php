<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Placeholder;
use Illuminate\Http\Request;
use App\User;

class PlaceHoldersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Placeholder::all();
        return view('admin.placeholder.index', compact('items'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.placeholder.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, Placeholder::rules());

        Placeholder::create($request->all());

        return back()->withSuccess(trans('app.success_store'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Placeholder::findOrFail($id);
        return view('admin.placeholder.edit', compact('item'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, Placeholder::rules());
        $items = Placeholder::findOrFail($id);
        $items->update($request->all());
        return redirect()->route(ADMIN . '.placeholders.index')->withSuccess(trans('app.success_update'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Placeholder::destroy($id);
        return back()->withSuccess(trans('app.success_destroy'));
    }
}

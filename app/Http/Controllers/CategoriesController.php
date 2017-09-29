<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Category;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use Session;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Builder $htmlBuilder)
    {
        if ($request->ajax()) {
            $categories = Category::all();
            return Datatables::of($categories)
                ->addColumn('action', function($category){
                    return view('datatable._action', [
                        'model'           => $category,
                        'form_url'        => route('categories.destroy', $category->id),
                        'edit_url'        => route('categories.edit', $category->id),
                        'confirm_message' => 'Yakin akan menghapus ' . $category->nama . '?'
                    ]);
                })->make(true);
        }

        $html = $htmlBuilder
            ->addColumn(['data' => 'nama', 'name'=>'nama', 'title'=>'Nama'])
            ->addColumn(['data' => 'initial', 'name'=>'initial', 'title'=>'Initial'])
            ->addColumn(['data' => 'action', 'name'=>'action', 'title'=>'', 'orderable'=>false, 'searchable'=>false]);

        return view('categories.index')->with(compact('html'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['nama' => 'required|unique:categories', 'initial' => 'required|unique:categories']);
        $category = Category::create($request->all());
        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil menyimpan $category->nama"
        ]);
        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        return view('categories.edit')->with(compact('category'));
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
        $this->validate($request, ['nama' => 'required|unique:categories,nama,'. $id, 'initial' => 'required|unique:categories,initial,'. $id]);
        $category = Category::find($id);
        $category->update($request->only('nama','initial'));
        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil menyimpan $category->nama"
        ]);

        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!Category::destroy($id)) return redirect()->back();

        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Kategori berhasil dihapus"
        ]);

        return redirect()->route('categories.index');
    }
}

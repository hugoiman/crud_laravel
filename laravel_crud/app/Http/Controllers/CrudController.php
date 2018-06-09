<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\Crud;

class CrudController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      //$cruds = Crud::all();

      //jika memakai query builder
      //$cruds = DB::table('crud')->paginate(1);

      // jika memakai eloquent
      $cruds = Crud::paginate(2);
      return view('crud.index',['cruds' => $cruds]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('crud.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $validatedData = $request->validate([
        'title' => 'required',
        'subject' => 'required|min:1',
      ]);

      $crud = new Crud;
        // jika insert satu-satu
        // $crud->title = $request->title;
        // $crud->subject = $request->subject;

        // jika insert langsung beberapa
        $crud->fill([
          'title' => $request->title,
          'subject' => $request->subject,
          'slug' => str_slug($request->title,'-')
        ]);
        $crud->save();

        return redirect('/crud')->with('message','Berhasil tambah data!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($title)
    {
      //$crud = Crud::find($id);
      //$crud = Crud::where('title',$title)->first();
      $crud = Crud::where('slug',$title)->first();
      if(!$crud){
        abort(404);
      }
      return view('crud.single')->with('crud',$crud);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $crud = Crud::find($id);
      if(!$crud){
        abort(404);
      }
      return view('crud.edit')->with('crud',$crud);
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
      $validatedData = $request->validate([
        'title' => 'required',
        'subject' => 'required|min:1',
      ]);

      $crud = Crud::find($id);
      $crud->fill([
        'title' => $request->title,
        'subject' => $request->subject,
        'slug' => str_slug($request->title,'-')
      ]);
      $crud->save();

      return redirect('/crud')->with('message','Berhasil di update!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $crud = Crud::find($id);
      $crud->delete();
      return redirect('/crud')->with('message','Berhasil di delete!');
    }
}

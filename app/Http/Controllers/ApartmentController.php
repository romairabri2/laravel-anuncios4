<?php

namespace App\Http\Controllers;

use Laravel\Jetstream\Features;

use Illuminate\Http\Request;

use App\Models\Apartment;

use App\Models\User;

use Inertia\Inertia;

use Redirect;

use Auth;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $apartment = Apartment::all();
        //return Inertia::render('Apartments/index', ['apartments' => $apartments]);
        return response($apartment);
    }

     /**
     *Display a listing of the resource.
     *  
     * @return \Inertia\Response
     */
    public function create(): \Inertia\Response
    {
        return Inertia::render('Apartments/Create');
    }

    public function edit($id)
    {
        $apartment = Apartment::findOrFail($id);
        return Inertia::render('Apartments/Update', [
            'apartment' => $apartment
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'title' => 'required|string',
            'body'  => 'required|string'
        ]);

        /*Apartment::create([
            'title' => $request->title,
            'body' => $request->body,
            'user_id' => $request->user_id
        ]);
        */

        $apartment=Apartment::create([
            'title' => $request->title,
            'body' => $request->body,
            'user_id' => Auth::id()
        ]);

        return response("El Apartamento ha sido creado correctamente", 201);
        //return Redirect::route('apartaments.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $apartment = Apartment::findOrFail($id);
        return response($apartment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id): \Illuminate\Http\RedirectResponse
    {
        $apartment = Apartment::findOrFail($id);
        $apartment->update($request->all());
        $apartment->save();

        return response("El apartamento ha sido actualizado correctamente");
        //return Redirect::route('apartments.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Apartment::findOrFail($id)->delete();
        return response("El apartamento ha sido eliminado correctamente");
        //return response("El apartamento ha sido eliminado correctamente");
    }
}

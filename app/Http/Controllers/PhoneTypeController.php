<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PhoneType;

class PhoneTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payload['phonetype'] = PhoneType::all();
        return view('phonetype.index', $payload);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate
        $validated = $request->validate([
            'name' => 'required|string|max:50|unique:phone_types'
        ]);

        $type = PhoneType::create( $request->all() );

        if( !$type ) return redirect('phonetype')->with('fail', 'Can not create type. Something Wrong!');

        return redirect('phonetype')->with('success', 'Type Created Successfully!');
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
    public function edit(PhoneType $phonetype)
    {
        $payload['phonetype'] = $phonetype;
        return view('phonetype.edit', $payload);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PhoneType $phonetype)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100'
        ]);

        $phonetype->name = $request->name;
        $phonetype->save();

        if( !$phonetype ) return redirect('phonetype')->with('fail', 'Can not update. Something wrong!');

        return redirect('phonetype')->with('success', 'Phonetype Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $phonetype = PhoneType::findOrFail( $request->type_id );

        if( $phonetype ) {
            $phonetype->delete();
            return redirect('phonetype')->with('success', 'Phone Type Deleted Successfully!');
        }

        return redirect('phonetype')->with('fail', 'Can not delete. Something wrong!');
    }
}

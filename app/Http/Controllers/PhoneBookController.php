<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PhoneBook;
use App\Models\PhoneType;

class PhoneBookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payload['contacts'] = PhoneBook::orderBy('last_name')->get();
        $payload['phone_type'] = PhoneType::all();
        return view('phonebook.index', $payload);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('phonebook.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate Data
        $validated = $request->validate([
            'first_name' => 'nullable|string|max:100',
            'last_name' => 'nullable|string|max:100',
            'phone_type' => 'required|numeric|max:10',
            'phone_number' => 'required|string|min:10'
        ]);

        // Create Record
        $contact = new PhoneBook();
        $contact->first_name = $request->first_name ? $request->first_name : 'unknown';
        $contact->last_name = $request->last_name ? $request->last_name : 'unknown';
        $contact->phone_type = $request->phone_type;
        $contact->phone_number = $request->phone_number;
        $contact->save();

        if( !$contact ) return redirect('phonebook')->with('fail', 'Something wrong! Contact can not created.');
        
        return redirect('phonebook')->with('success', 'Contact created succesfully!');
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
    public function edit( PhoneBook $phonebook )
    {
        $payload['phone_type'] = PhoneType::all();
        $payload['contact'] = $phonebook;
        return view('phonebook.edit', $payload);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PhoneBook $phonebook)
    {
        // Validate Data
        $validated = $request->validate([
            'first_name' => 'nullable|string|max:100',
            'last_name' => 'nullable|string|max:100',
            'phone_type' => 'required|numeric|max:10',
            'phone_number' => 'required|string|min:10'
        ]);

        $phonebook->first_name = $request->first_name ? $request->first_name : 'unknown'; // for an unknown reason $request->input('field_name', 'default_value_if_null') not working.
        $phonebook->last_name = $request->last_name ? $request->last_name : 'unknown';
        $phonebook->phone_type = $request->phone_type;
        $phonebook->phone_number = $request->phone_number;
        $phonebook->save();

        if( !$phonebook ) return redirect('phonebook')->with('fail', 'Can not update. Something wrong!');

        return redirect('phonebook')->with('success', 'Contact updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $contact = PhoneBook::findOrFail( $request->contact_id );

        if( $contact ) {
            $contact->delete();
            return redirect('phonebook')->with('success', 'Contact Deleted Successfully!');
        }

        return redirect('phonebook')->with('fail', 'Can not delete. Something wrong!');
    }
}

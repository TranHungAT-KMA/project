<?php

namespace App\Http\Controllers;
use App\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts =  Contact::all();
        return view('contacts.index', compact('contacts'));
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contacts.create');
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
        $request->validate(['first_name'=>'required',
            'last_name'=>'required',
            'email'=>'required']
            );

        $contacts = new Contact([
            'first_name'=>$request->get('first_name'),
            'last_name'=>$request->get('last_name'),
            'email'=>$request->get('email'),
            'job_city'=>$request->get('job_city'), 
            'city'=>$request->get('city'),
            'contry'=>$request->get('contry'),

                        ]);

        $contacts->save();
        return redirect('/contact')->with('success','Contact saved!');
        //
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

        $contacts = Contact::find($id);
        return view('contacts.edit', compact('contacts'));
        //
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
        $request->validate([
            'first_name'=>'required',
            'last_name'=>'required',
            'email'=>'required'


        ]);
        $contacts = Contact::find($id);
        $contacts->first_name = $request->get('first_name');
        $contacts->last_name = $request->get('last_name');
        $contacts->email = $request->get('email');
        $contacts->job_city = $request->get('job_city');
        $contacts->city = $request->get('city');
        $contacts->contry = $request->get('contry');
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)

    {
        $contacts = Contact::find($id);
        return redirect('/contacts')->with('success','Contact deleted!');

        //
    }
}

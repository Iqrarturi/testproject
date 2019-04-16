<?php

namespace App\Http\Controllers;

use App\Phonebook;
use App\Http\Requests\PhoneBookRequest;
use Illuminate\Http\Request;

class PhonebookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('phonebook');
    }
    public function getData(){
        $list=Phonebook::orderBy('name','DESC')->get();
        return $list;
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
    public function store(PhoneBookRequest $request)
    {   $message="";
        $pb=new Phonebook();
        $pb->name=$request->name;
        $pb->phone=$request->phone;
        $pb->email=$request->email;
        if($pb->save()){
            return $pb;
        }
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Phonebook  $phonebook
     * @return \Illuminate\Http\Response
     */
    public function show(Phonebook $phonebook)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Phonebook  $phonebook
     * @return \Illuminate\Http\Response
     */
    public function edit(Phonebook $phonebook)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Phonebook  $phonebook
     * @return \Illuminate\Http\Response
     */
    public function update(PhoneBookRequest $request)
    {
        $record=Phonebook::find($request->id);
        $record->name=$request->name;
        $record->phone=$request->phone;
        $record->email=$request->email;
        if($record->save()){
            return "updated successfully...";
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Phonebook  $phonebook
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record=Phonebook::find($id);
        if($record->delete()){
            return "deleted successfully";
        }
    }
}

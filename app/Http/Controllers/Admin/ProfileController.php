<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $profile = Profile::find($id);
        if( $profile->hide === 0){
            $profile->hide = 1;
            $profile->save();
            return redirect()->back()->withSuccess('Member was hide');
        }else {
            $profile->hide = 0;
            $profile->save();
            return redirect()->back()->withSuccess('Member was show');
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return string
     */
    public function update(Request $request, Profile $profile)
    {
        $profile->company = $request->company;
        $profile->position = $request->position;
        $profile->aboutme = $request->aboutme;
        $profile->memberid = $profile->member['id'];
        $photo = $request->file('photo');
        if ($photo != null) {
            $profile->photo = $photo->store('uploads', 'public');
        } else {
            $profile->photo = $profile->photo;
        }

        $validation = $request->validate([
            'company' => 'max:100',
            'position' => 'max:100',
            'aboutme' => 'max:500',
            'photo' => 'size:2048|mimes:png,jpg|image'
        ]);

        $profile->save();

        return redirect()->back()->withSuccess('Member was successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

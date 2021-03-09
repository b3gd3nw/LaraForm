<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Member;
use App\Models\Profile;
use Illuminate\Http\Request;

class MembersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profiles = Profile::orderBy('created_at', 'desc')->get();
        $members = [];
        foreach ($profiles as $profile) {
            $profile_member_arr = $profile;
            $profile_member_arr['member'] = $profile->member;
            $members [] = $profile_member_arr;
        }
        $countries = Country::all();
        return view('admin.members.index', [
            'members' => $members,
            'countries' => $countries
        ]);
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
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function show(Member $member)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function edit(Member $member)
    {
        $profile = $member->profile;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Member $member
     * @param Profile $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Member $member)
    {
        $member->firstname = $request->firstname;
        $member->lastname = $request->lastname;
        $member->birthdate = $request->birthdate;
        $member->reportsubject = $request->reportsubject;
        $member->countryId = $request->countryId;
        $member->phone = $request->phone;
        $member->email = $request->email;

        $validation = $request->validate([
            'firstname' => 'required|max:100',
            'lastname' => 'required|max:100',
            'birthdate' => 'required|date|before:now',
            'reportsubject' => 'required|max:100',
            'countryId' => 'required',
            'email' => 'required|regex:/^[^@\s]+@[^@\s]+\.[^@\s]+$/',
            'phone' => 'required'

        ]);

        $member->save();

        return redirect()->back()->withSuccess('Member was successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy(Member $member)
    {
        $member->delete();

        return redirect()->back()->withSuccess('Delete Success!');
    }
}

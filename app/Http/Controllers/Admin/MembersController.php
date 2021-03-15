<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MemberRequest;
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
        $members = Member::orderBy('created_at', 'desc')->get();
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
//        $member = Profile::find($member);
        if ($member->hide === 0) {
            $member->hide = 1;
            $member->save();
            return redirect()->back()->withSuccess('Member was hide');
        } else {
            $member->hide = 0;
            $member->save();
            return redirect()->back()->withSuccess('Member was show');
        }
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
    public function update(MemberRequest $request, Member $member)
    {
        $member->firstname = $request->firstname;
        $member->lastname = $request->lastname;
        $member->birthdate = $request->birthdate;
        $member->reportsubject = $request->reportsubject;
        $member->countryId = $request->countryId;
        $member->phone = $request->phone;
        $email = $member->email;
        $member->email = $request->email;
        $member->company = $request->company;
        $member->position = $request->position;
        $member->aboutme = $request->aboutme;
        $photo = $request->file('photo');
        if ($photo != null) {
            $member->photo = $photo->store('uploads', 'public');
        } else {
            $member->photo = $member->photo;
        }

        if ( $email != $request->email ) {
            $validation = $request->validate([
               'email' => 'unique:members'
            ]);
        }

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

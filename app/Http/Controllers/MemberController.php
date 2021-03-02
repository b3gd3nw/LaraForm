<?php

namespace App\Http\Controllers;

use App\Http\Requests\MemberRequest;
use App\Http\Requests\ProfileRequest;
use App\Models\Member;
use App\Models\Profile;
use Illuminate\Http\Request;

class MemberController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addMember(MemberRequest $request)
    {
        $member = new Member();
        $member->firstname = $request->input('firstname');
        $member->lastname = $request->input('lastname');
        $member->birthdate = $request->input('birthdate');
        $member->reportsubject = $request->input('reportsubject');
        $member->countryId = $request->input('country');
        $member->phone = $request->input('phone');
        $member->email = $request->input('email');

        $member->save();

        setcookie('userid', $member->id, 0, '/');

        return http_response_code(200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addProfile(ProfileRequest $request)
    {

        dd($request->get('company'));
//        $profile = new Profile();
//        $profile->company = $request->input('company');
//        $profile->position = $request->input('position');
//        $profile->aboutme = $request->input('aboutme');
//        $path = $request->file('photo')->store('uploads', 'public');
//        $profile->photo = $path;
//        $profile->memberid = $_COOKIE['userid'];
//
//        $profile->save();
//        return $profile->memberid;
    }

}

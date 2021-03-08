<?php

namespace App\Http\Controllers;

use App\Http\Requests\MemberRequest;
use App\Http\Requests\ProfileRequest;
use App\Models\Member;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MemberController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addMember(MemberRequest $request)
    {
        $member = new Member();
        $member->firstname = $request->firstname;
        $member->lastname = $request->lastname;
        $member->birthdate = $request->birthdate;
        $member->reportsubject = $request->reportsubject;
        $member->countryId = $request->countryId;
        $member->phone = $request->phone_number;
        $member->email = $request->email;

        $email = DB::table('members')->where('email', $request->email)->first();

        if ($email) {
            return response()->json(['exists' => true]);
        } else {
            $member->save();
            setcookie('userid', $member->id, 0, '/');
            return response()->json(['exists' => false]);
        }

//        $member->save();

//        setcookie('userid', $member->id, 0, '/');
//
//        return http_response_code(200);
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
        $profile = new Profile();
        $profile->company = $request->company;
        $profile->position = $request->position;
        $profile->aboutme = $request->aboutme;
        $photo = $request->file('photo');
        if ($photo != null) {
            $profile->photo = $photo->store('uploads', 'public');
        } else {
            $profile->photo = null;
        }

        $profile->memberid = $_COOKIE['userid'];

        $profile->save();

        return http_response_code(200);
    }

    public function allMembers()
    {
        $members_count = Member::all()->count();
        return response()->json($members_count)->setStatusCode(200);
    }

    public function getMembers()
    {
        $profiles = Profile::orderBy('created_at', 'desc')->get();
        $profile_arr = [];
        foreach ($profiles as $profile) {
            $profile_member_arr = $profile;
            $profile_member_arr['member'] = $profile->member;
            $profile_arr [] = $profile_member_arr;
        }
        return response()->json($profile_arr)->setStatusCode(200);
    }

    public function getCSRF()
    {
        return csrf_token();
    }

}

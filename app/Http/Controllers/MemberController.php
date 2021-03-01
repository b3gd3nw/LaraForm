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
    public function store(MemberRequest $request)
    {
        $member = new Member();
        $member->firstname = $request->input('firstname');
        $member->lastname = $request->input('lastname');
        $member->birthdate = $request->input('birthdate');
        $member->reportsubject = $request->input('reportsubject');
        $member->country = $request->input('country');
        $member->phone = $request->input('phone');
        $member->email = $request->input('email');

        $member->save();

        setcookie('userid', $member->id, 0,'/');

        return http_response_code(200);
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProfileRequest $request)
    {
        $profile = new Profile();
        $profile->company = $request->input('company');
        $profile->position = $request->input('postion');
        $profile->aboutme = $request->input('aboutme');
        $profile->photo = $request->input('photo');
        $profile->userid = $_COOKIE['userid'];

        $profile->save();
        return $profile->userid;
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

    public function getCSRF()
    {
        return csrf_token();
    }
}

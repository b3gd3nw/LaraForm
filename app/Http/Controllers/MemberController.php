<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members_count = Member::all()->count();
        return response()->json($members_count)->setStatusCode(200);
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
    public function update(Request $request, $id)
    {
        $member = Member::find($id);
        $member->company = $request->company;
        $member->position = $request->position;
        $member->aboutme = $request->aboutme;
        $photo = $request->file('photo');
        if ($photo != null) {
            $member->photo = $photo->store('uploads', 'public');
        } else {
            $member->photo = null;
        }

        $member->save();

        return http_response_code(200);

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

    public function all_members()
    {
        $members = Member::orderBy('created_at', 'desc')->get();

        return response()->json($members)->setStatusCode(200);

    }
}

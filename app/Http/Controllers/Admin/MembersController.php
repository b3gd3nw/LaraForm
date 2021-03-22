<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MemberRequest;
use App\Models\Country;
use App\Models\Member;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
    public function update(MemberRequest $request, $id)
    {
        // Email check
        $member= Member::find($id);
        $email = $member->email;
        if ($email != $request->email) {
            $validation = $request->validate([
                'email' => 'unique:members'
            ]);
        }


        $data = $request->except(['_method', '_token']);
        $photo = $request->file('photo');
        if ($photo != null) {
            $data['photo'] = $photo->store('uploads', 'public');
        } else {
            $data['photo'] = $member->photo;
        }

        $member = Member::where('id', $id)->update($data);

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

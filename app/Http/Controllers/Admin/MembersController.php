<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MemberRequest;
use App\Models\Country;
use App\Models\Member;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;


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
        $countries = Country::all();
        $data = [
            'view' => View::make('admin.members.modal')
                ->with('member', $member)
                ->with('countries', $countries)
                ->render()
        ];
//        $data = view('admin.members.modal', [
//            'member' => $member,
//        ]);
        return response()->json($data, 200);
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
        } else if (session('delete_photo') == 'true' ) {
            $data['photo'] = null;
            session(['delete_photo' => 'false']);
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

    public function getPhoto($id)
    {
        $member = Member::find($id);
        $data = $member->photo;
        if ($data){
          return response()->json($data, 200);
        } else {
          $data = false;
          return response()->json($data, 200);
        }
    }

    public function deletePhoto($id)
    {
//        $member = Member::find($id);
//
//        if ($member->photo == null) {
//            return redirect()->back()->withErrors('Photo not installed');
//        }
//
//        $member->photo = null;
//        $member->save();
//        return redirect()->withSuccess('Photo was successfully deleted');
        session(['delete_photo' => 'true']);

    }
}

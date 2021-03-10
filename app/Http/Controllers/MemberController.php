<?php

namespace App\Http\Controllers;

use App\Models\Member;
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
        $idMember = Member::incrementId();
        $member = Member::where('nama', 'not like', '%Customer-%')->get();
        return view('admin.member.daftarmember', [
            'idMember' => $idMember,
            'member' => $member,
            'sideTitle' => 'member'
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
        $member = new Member;
        $member->kode_member = Member::incrementId();
        $member->jenis_member = $request->jenis_member;
        $member->nama = $request->nama;
        $member->unit = $request->unit;
        $member->telepon = $request->telepon;
        $member->alamat = $request->alamat;
        $member->save();
        return redirect('/daftar-member');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function show(Member $member, $kode)
    {
        $data = $member->find(['kode_member' => $kode]);
        if ($data->count() > 0) {
            return response()->json([
                'message' => 'success',
                'member' => $data
            ]);
        } else {
            return response()->json([
                'message' => 'failed'
            ]);
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Member $member)
    {
        $member->where('kode_member', $request->kode_member_edit)
            ->update([
                'jenis_member' => $request->jenis_member_edit,
                'nama' => $request->nama_edit,
                'unit' => $request->unit_edit,
                'telepon' => $request->telepon_edit,
                'alamat' => $request->alamat_edit
            ]);
        if ($member) {
            return redirect('/daftar-member');
        } else {
            return redirect('/daftar-member');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function delete(Member $member, $kode)
    {
        if ($member->where('kode_member', $kode)->delete()) {
            return response()->json([
                'message' => 'success'
            ], 200);
        } else {
            return response()->json([
                'message' => 'failed'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy(Member $member)
    {
        //
    }

    public function member_search()
    {
        $member = Member::with(['transaksi'])->where('jenis_member', 'customer')->get();
        return response()->json([
            'message' => 'success',
            'data' => $member
        ]);
    }
}

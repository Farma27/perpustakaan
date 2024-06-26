<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMemberRequest;
use App\Http\Requests\UpdateMemberRequest;
use App\Models\Card;
use App\Models\User;
use App\Mail\MemberCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Picqer\Barcode\BarcodeGeneratorPNG;

class MemberController extends Controller
{
    private $title = 'Member';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['title'] = str($this->title)->plural();
        return view('pages.member.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['title'] = 'New ' . $this->title;
        return view('pages.member.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMemberRequest $request)
    {
        try {
            DB::beginTransaction();
            $member = new User();
            $member->name = $request->name;
            $member->username = $request->username;
            $member->email = $request->email;
            $member->address = $request->address;
            $member->password = fake()->word();
            $member->save();
            $member->assignRole(User::ROLE_ANGGOTA);

            $card = new Card();
            $card->user_id = $member->getKey();
            $card->number = str($member->getKey())->padLeft(5, '0');
            $card->start_date = now();
            $card->end_date = now()->addYear();
            $card->save();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error(
                $th->getMessage(),
                [
                    'action' => 'Store member',
                    'data' => $request->all()
                ]
            );
            return to_route('member.index')->withToastError($th->getMessage());
        }

        return to_route('member.index')->withToastSuccess($this->title . ' created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $member)
    {
        return self::edit($member);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $member)
    {
        $data['title'] = 'Edit ' . $this->title;
        $data['member'] = $member;
        return view('pages.member.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMemberRequest $request, User $member)
    {
        DB::beginTransaction();
        try {
            $member->name = $request->name;
            $member->username = $request->username;
            $member->email = $request->email;
            $member->address = $request->address;
            $member->save();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error(
                $th->getMessage(),
                [
                    'action' => 'Delete member',
                    'data' => $member
                ]
            );
            return to_route('member.index')->withToastError($th->getMessage());
        }
        return to_route('member.index')->withToastSuccess($this->title . ' updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $member)
    {
        try {
            DB::beginTransaction();
            $member->forceDelete();
            DB::commit();

            return response()->json([
                'msg' => $this->title . ' deleted successfully!'
            ], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error(
                $th->getMessage(),
                [
                    'action' => 'Delete member',
                    'data' => $member
                ]
            );

            return response()->json([
                'msg' => $th->getMessage()
            ]);
        }
    }
}

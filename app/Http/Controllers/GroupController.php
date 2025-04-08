<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\group;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $messages = group::with('user')->orderBy('created_at', 'asc')->get();
        $my_id = request()->user()->id;
        return view('group.index', compact('messages', 'my_id'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $message = group::create([
            'user_id' => request()->user()->id,
            'msg' => $request->message,
        ]);
        $message->load('user'); // get user data

        broadcast(new MessageSent($message))->toOthers();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(group $group)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(group $group)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, group $group)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(group $group)
    {
        //
    }
}

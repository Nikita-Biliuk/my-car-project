<?php

namespace App\Http\Controllers;

use App\Models\Owner;
use Illuminate\Http\Request;
use App\Http\Requests\OwnerRequest;

class OwnerController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Owner::class, 'owner');
    }

    public function index()
    {
        $this->authorize('viewAny', Owner::class);
        $owners = Owner::all();
        return view('owners.index', compact('owners'));
    }



    public function create()
    {
        return view('owners.create');
    }

    public function store(OwnerRequest $request)
    {
        $owner = Owner::create($request->all());
        $owner->user_id = $request->user()->id;
        $owner->save();
        return redirect()->route('owners.index');
    }

    public function edit(Owner $owner)
    {
        $this->authorize('update', $owner);
        return view('owners.edit', compact('owner'));
    }

    public function update(OwnerRequest $request, Owner $owner)
    {
        $this->authorize('update', $owner);
        $owner->update($request->all());
        return redirect()->route('owners.index');
    }

    public function destroy(Owner $owner)
    {
        $this->authorize('delete', $owner);
        $owner->delete();
        return redirect()->route('owners.index')->with('success', 'Savininkas sekmingai pašalintas.');
    }
}

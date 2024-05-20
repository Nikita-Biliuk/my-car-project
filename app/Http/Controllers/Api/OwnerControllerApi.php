<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Owner;

class OwnerControllerApi extends Controller
{
    public function index()
    {
        return Owner::all();
    }

    public function store(Request $request)
    {
        return Owner::create($request->all());
    }

    public function show($id)
    {
        return Owner::find($id);
    }

    public function update(Request $request, $id)
    {
        $owner = Owner::find($id);
        $owner->update($request->all());
        return $owner;
    }

    public function destroy($id)
    {
        return Owner::destroy($id);
    }
}

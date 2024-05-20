<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Car;

class CarControllerApi extends Controller
{
    public function index()
    {
        return Car::all();
    }

    public function store(Request $request)
    {
        return Car::create($request->all());
    }

    public function show($id)
    {
        return Car::find($id);
    }

    public function update(Request $request, $id)
    {
        $car = Car::find($id);
        $car->update($request->all());
        return $car;
    }

    public function destroy($id)
    {
        return Car::destroy($id);
    }
}

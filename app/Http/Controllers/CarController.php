<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Http\Requests\OwnerRequest;
use App\Models\Car;
use App\Http\Requests\CarRequest;
use App\Models\Owner;
use Illuminate\Http\Request;

class CarController extends Controller
{

    public function __construct(){
        $this->authorizeResource(Car::class, 'car');
    }
    public function index()
    {
        $carsWithOwners = Car::all();
        $owners = Owner::all();

        return view('cars.index', [
            'cars' => $carsWithOwners,
            'owners' => $owners,
        ]);
    }
    public function create()
    {

        return view('cars.create', [
            'owners'=>Owner::all()
        ]);

    }

    public function save(CarRequest $request, Car $car)
    {
        $car->reg_number = $request->reg_number;
        $car->brand = $request->brand;
        $car->model = $request->model;
        $car->owner_id = $request->owner_id;
        $car->save();


        if($request->has('images')){
            foreach ($request->file('images') as $image){
                $imageName = $request->reg_number . '-image-'.time().rand(1,1000). '.'.$image->extension();
                $image->move(public_path('images'), $imageName);
                $imageModel = Image::create([
                    'car_id' => $car->id,
                    'image' => $imageName
                ]);
            }
        }

        return redirect()->route('cars.index');
    }
    public function edit($id)
    {
        $car = Car::findOrFail($id);
        $owners = Owner::all();
        $images = $car->images;

        return view('cars.edit', compact('car', 'owners', 'images'));
    }

    public function update(CarRequest $request, Car $car)
    {
        $car->reg_number = $request->reg_number;
        $car->brand = $request->brand;
        $car->model = $request->model;
        $car->owner_id = $request->owner_id;
        $car->save();


        if($request->has('images')){
            foreach ($request->file('images') as $image){
                $imageName = $request->reg_number . '-image-'.time().rand(1,1000). '.'.$image->extension();
                $image->move(public_path('images'), $imageName);
                $imageModel = Image::create([
                    'car_id' => $car->id,
                    'image' => $imageName
                ]);
            }
        }

        return redirect()->route('cars.index');
    }
    public function destroy(Car $car)
    {
        foreach($car->images as $image){
            if(file_exists(public_path('images/'.$image->image))){
                unlink(public_path('images/'.$image->image));
            }
        }
        $car->images()->delete();
        $car->delete();
        return redirect()->route('cars.index');
    }

    public function photoDelete($id)
    {
        $image = Image::findOrFail($id);

        if(file_exists(public_path('images/'.$image->image))){
            unlink(public_path('images/'.$image->image));
        }
        $image->delete();

        return redirect()->route('cars.edit', $image->car_id);
    }
    public function specific($id)
    {
        $car = Car::findOrFail($id);
        $images = $car->images;
        return view('cars.specific', compact('car', 'images'));
    }


    public function images($id){
        $car = Car::find($id);
        if(!$car) abort(404);
        $images = $car->images;
        return view('images', compact('car', 'images'));
    }
}

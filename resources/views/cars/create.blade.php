@extends('layouts.app')

@section("content")
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        {{__("Add new car")}}
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('cars.save') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">{{__("Licence plate number")}}</label>
                                <input type="text" class="form-control @error('reg_number') is-invalid @enderror" name="reg_number">
                                @error('reg_number') {{$message}} @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">{{__("Car brand")}}</label>
                                <select name="brand" class="form-select">
                                        <?php
                                        $cars = array("Volvo", "BMW", "Toyota", "Honda", "Audi", "Volkswagen");
                                        foreach ($cars as $car) {
                                            echo "<option value='$car'>$car</option>";
                                        }
                                        ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">{{__("Model")}}</label>
                                <input type="text" class="form-control @error('model') is-invalid @enderror" name="model">
                                @error('model') {{$message}} @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">{{__("Owner")}}</label>
                                <select name="owner_id" class="form-select">
                                    @foreach($owners as $owner)
                                        <option value="{{ $owner->id }}">{{ $owner->name }} {{ $owner->surname }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">{{__("Photos")}}</label>
                                <input
                                    type="file"
                                    class="form-control @error('photo') is-invalid @enderror"
                                    name="images[]"
                                    accept="image/*"
                                    multiple>
                                @error('photo') {{$message}} @enderror
                            </div>

                            <button type="submit" class="btn btn-success">{{__("Add")}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

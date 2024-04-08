<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreHolidayRequest;
use App\Http\Requests\UpdateHolidayRequest;
use App\Models\Holiday;

class HolidayController extends Controller
{
    public function index()
    {
        return Holiday::orderBy('date')
            ->orderBy('name')
            ->get();
    }

    public function show($id)
    {
        return Holiday::findOrFail($id);
    }

    public function store(StoreHolidayRequest $request)
    {
        return Holiday::create($request->all());
    }

    public function update(UpdateHolidayRequest $request, $id)
    {
        $holiday = Holiday::findOrFail($id);

        $holiday->fill($request->all());

        if ($holiday->isDirty()) {
            $holiday->save();
        }

        return $holiday;
    }

    public function destroy($id)
    {
        Holiday::findOrFail($id)
            ->delete();

        return response()->json([], 204);
    }
}

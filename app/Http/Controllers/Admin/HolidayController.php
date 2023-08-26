<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Holiday\HolidayCollection;
use App\Models\Holiday;
use App\Traits\RespondsWithJson;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HolidayController extends Controller
{
    use RespondsWithJson;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new HolidayCollection(
            Holiday::cursor(),
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            // 'code' => 'required|unique:holidays',
            'description' => 'required',
            'arabic_description' => 'required',
            'is_recurring' => 'required',
            'from_date' => 'required',
            'to_date' => 'required|after_or_equal:from_date',
        ]);
        try {
            Holiday::create([
                'user_id' => Auth::id(),
                // 'code' => $request->code,
                'description' => $request->description,
                'arabic_description' => $request->arabic_description,
                'is_recurring' => $request->is_recurring,
                'from_date' => $request->from_date,
                'to_date' => $request->to_date,
            ]);
            return $this->success('Record Added Successfully');
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // dd($request->all(), $id);
        $request->validate([
            // 'code' => 'required|unique:holidays,code,' . $id,
            'description' => 'required',
            'arabic_description' => 'required',
            'is_recurring' => 'required',
            'from_date' => 'required',
            'to_date' => 'required|after_or_equal:from_date',
        ]);
        $record = Holiday::findOrFail($id);
        try {
            $record->update([
                // 'code' => $request->code,
                'description' => $request->description,
                'arabic_description' => $request->arabic_description,
                'is_recurring' => $request->is_recurring,
                'from_date' => $request->from_date,
                'to_date' => $request->to_date,
            ]);
            return $this->success('Record Updated Successfully');
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $record = Holiday::findOrFail($id);
        try {
            $record->delete();
            return $this->success('Record Deleted Successfully');
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }
}

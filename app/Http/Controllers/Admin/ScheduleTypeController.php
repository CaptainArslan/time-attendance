<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\ScheduleType\ScheduleTypeCollection;
use App\Models\ScheduleType;
use App\Traits\RespondsWithJson;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScheduleTypeController extends Controller
{
    use RespondsWithJson;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new ScheduleTypeCollection(
            ScheduleType::cursor()
        );
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required',
            'arabic_description' => 'required'
        ]);
        try {
            ScheduleType::create([
                'user_id' => Auth::id(),
                'description' => $request->description,
                'arabic_description' => $request->arabic_description
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
        $request->validate([
            'description' => 'required',
            'arabic_description' => 'required'
        ]);
        $record = ScheduleType::findOrFail($id);
        //dd($request->all());
        try {
            $record->update([
                'description' => $request->description,
                'arabic_description' => $request->arabic_description
            ]);
            return $this->success("Record Updated Successfully");
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $record = ScheduleType::findOrFail($id);
        try {
            $record->delete();
            return $this->success("Record Deleted Successfully");
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }
}

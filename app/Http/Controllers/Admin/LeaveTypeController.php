<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\LeaveType\LeaveTypeCollection;
use App\Models\LeaveType;
use App\Traits\RespondsWithJson;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeaveTypeController extends Controller
{
    use RespondsWithJson;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new LeaveTypeCollection(
            LeaveType::cursor(),
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:leave_types',
            'description' => 'required',
            'arabic_description' => 'required',
            'is_official' => 'required',
            'is_need_approval' => 'required',
        ]);
        try {
            LeaveType::create([
                'user_id' => Auth::id(),
                'code' => $request->code,
                'description' => $request->description,
                'arabic_description' => $request->arabic_description,
                'is_official' => $request->is_official,
                'is_need_approval' => $request->is_need_approval,
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
            'code' => 'required|unique:leave_types,code,' . $id,
            'description' => 'required',
            'arabic_description' => 'required',
            'is_official' => 'required',
            'is_need_approval' => 'required',
        ]);
        $record = LeaveType::findOrFail($id);
        try {
            $record->update([
                'code' => $request->code,
                'description' => $request->description,
                'arabic_description' => $request->arabic_description,
                'is_official' => $request->is_official,
                'is_need_approval' => $request->is_need_approval,
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
        $record = LeaveType::findOrFail($id);
        try {
            $record->delete();
            return $this->success('Record Deleted Successfully');
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }
}

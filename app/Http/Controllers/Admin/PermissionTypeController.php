<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\PermissionType\PermissionTypeCollection;
use App\Models\PermissionType;
use App\Traits\RespondsWithJson;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PermissionTypeController extends Controller
{
    use RespondsWithJson;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new PermissionTypeCollection(
            PermissionType::with('reason')->cursor(),
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:permission_types',
            'description' => 'required',
            'arabic_description' => 'required',
            'max_permission' => 'required|integer',
            'max_minute' => 'required|integer',
            'is_official' => 'required',
            'is_group_apply' => 'required',
            'reason_id' => 'required',
        ]);
        try {
            PermissionType::create([
                'user_id' => Auth::id(),
                'reason_id' => $request->reason_id,
                'code' => $request->code,
                'description' => $request->description,
                'arabic_description' => $request->arabic_description,
                'max_permission' => $request->max_permission,
                'max_minute' => $request->max_minute,
                'is_official' => $request->is_official,
                'is_group_apply' => $request->is_group_apply,
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
            'code' => 'required|unique:permission_types,code,' . $id,
            'description' => 'required',
            'arabic_description' => 'required',
            'max_permission' => 'required',
            'max_minute' => 'required',
            'is_official' => 'required',
            'is_group_apply' => 'required',
            'reason_id' => 'required',
        ]);
        $record = PermissionType::findOrFail($id);
        try {
            $record->update([
                'reason_id' => $request->reason_id,
                'code' => $request->code,
                'description' => $request->description,
                'arabic_description' => $request->arabic_description,
                'max_permission' => $request->max_permission,
                'max_minute' => $request->max_minute,
                'is_official' => $request->is_official,
                'is_group_apply' => $request->is_group_apply,
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
        $record = PermissionType::findOrFail($id);
        try {
            $record->delete();
            return $this->success('Record Deleted Successfully');
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }
}

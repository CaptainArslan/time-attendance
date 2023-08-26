<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Organization\OrganizationCollection;
use App\Models\Organization;
use App\Models\OrganizationType;
use App\Traits\RespondsWithJson;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrganizationController extends Controller
{
    use RespondsWithJson;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new OrganizationCollection(
            Organization::with('organizationType', 'mainOrganization')->cursor(),
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:organizations',
            'description' => 'required',
            'arabic_description' => 'required',
            'organization_type_id' => 'required',
        ]);
        try {
            Organization::create([
                'user_id' => Auth::id(),
                'organization_type_id' => $request->organization_type_id,
                'code' => $request->code,
                'description' => $request->description,
                'arabic_description' => $request->arabic_description,
                'parent_id' => $request->parent_id,
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
            'code' => 'required|unique:organizations,code,' . $id,
            'description' => 'required',
            'arabic_description' => 'required',
            'organization_type_id' => 'required',
        ]);
        $record = Organization::findOrFail($id);
        try {
            $record->update([
                'code' => $request->code,
                'organization_type_id' => $request->organization_type_id,
                'description' => $request->description,
                'arabic_description' => $request->arabic_description,
                'parent_id' => $request->parent_id,
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
        $record = Organization::findOrFail($id);
        try {
            $record->delete();
            return $this->success('Record Deleted Successfully');
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }
}

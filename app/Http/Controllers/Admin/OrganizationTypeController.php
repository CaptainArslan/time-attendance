<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrganizationType\OrganizationTypeCollection;
use App\Models\OrganizationType;
use App\Traits\RespondsWithJson;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrganizationTypeController extends Controller
{
    use RespondsWithJson;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new OrganizationTypeCollection(
            OrganizationType::cursor(),
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            // 'code' => 'required|unique:organization_types',
            'description' => 'required',
            'arabic_description' => 'required',
        ]);
        try {
            OrganizationType::create([
                'user_id' => Auth::id(),
                // 'code' => $request->code,
                'description' => $request->description,
                'arabic_description' => $request->arabic_description,
            ]);
            return $this->success('Record Added Successfully');
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(OrganizationType $organizationType)
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
            // 'code' => 'required|unique:organization_types,code,' . $id,
            'description' => 'required',
            'arabic_description' => 'required',
        ]);
        $record = OrganizationType::findOrFail($id);
        try {
            $record->update([
                // 'code' => $request->code,
                'description' => $request->description,
                'arabic_description' => $request->arabic_description,
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
        $record = OrganizationType::findOrFail($id);
        try {
            $record->delete();
            return $this->success('Record Deleted Successfully');
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }
}

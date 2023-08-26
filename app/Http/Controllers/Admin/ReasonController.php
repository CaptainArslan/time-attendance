<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Reason\ReasonCollection;
use App\Http\Resources\Region\RegionCollection;
use App\Models\Reason;
use App\Traits\RespondsWithJson;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReasonController extends Controller
{
    use RespondsWithJson;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new ReasonCollection(
            Reason::cursor(),

        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:reasons',
            'description' => 'required',
            'arabic_description' => 'required',
            'reason_mode' => 'required',
            'prompt_message' => 'required',
            'is_web_punch' => 'required',
        ]);
        try {
            Reason::create([
                'user_id' => Auth::id(),
                'code' => $request->code,
                'description' => $request->description,
                'arabic_description' => $request->arabic_description,
                'reason_mode' => $request->reason_mode,
                'prompt_message' => $request->prompt_message,
                'is_web_punch' => $request->is_web_punch,
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
            'code' => 'required|unique:reasons,code,' . $id,
            'description' => 'required',
            'arabic_description' => 'required',
            'reason_mode' => 'required',
            'prompt_message' => 'required',
            'is_web_punch' => 'required',
        ]);
        $record = Reason::findOrFail($id);
        try {
            $record->update([
                'code' => $request->code,
                'description' => $request->description,
                'arabic_description' => $request->arabic_description,
                'reason_mode' => $request->reason_mode,
                'prompt_message' => $request->prompt_message,
                'is_web_punch' => $request->is_web_punch,
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
        $record = Reason::findOrFail($id);
        try {
            $record->delete();
            return $this->success('Record Deleted Successfully');
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }
}

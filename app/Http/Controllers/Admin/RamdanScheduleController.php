<?php

namespace App\Http\Controllers\Admin;
use App\Models\RamdanSchedule;


use App\Http\Controllers\Controller;
use App\Http\Resources\PermissionType\PermissionTypeCollection;
// use App\Http\Resources\RamdanCollection;
use App\Http\Resources\RamdanScheduleCollection;
use App\Models\PermissionType;
use App\Traits\RespondsWithJson;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RamdanScheduleController extends Controller
{
    use RespondsWithJson;
    /**
     *
     * Display a listing of the resource.
     */
    public function index()
    {

        $ramadanTimings = RamdanSchedule::all();
        return [
            'status'=>true,
            'message'=>'Record Found',
            'data'=>$ramadanTimings,
        ];

        // return new RamdanScheduleCollection(
        //     RamdanSchedule::cursor()
        // );
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'description'=>'required',
            'arabic_description'=>'required',
            'from_date'=>'required',
            'to_date'=>'required|after:from_date'
        ]);
        try{
            RamdanSchedule::create([
                'user_id'=>Auth::id(),
                'description'=>$request->description,
                'arabic_description'=>$request->arabic_description,
                'from_date'=>$request->from_date,
                'to_date'=>$request->to_date
            ]);
            return $this->success('Record Added Successfully');
        }
        catch(Exception $e){
            return $this->error($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(RamdanSchedule $ramdanSchedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RamdanSchedule $ramdanSchedule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'description'=>'required',
            'arabic_description'=>'required',
            'from_date'=>'required',
            'to_date'=>'required|after:from_date'
        ]);
        $record=RamdanSchedule::findOrfail($id);
        try{
            $record->update([
                'description'=>$request->description,
                'arabic_description'=>$request->arabic_description,
                'from_date'=>$request->from_date,
                'to_date'=>$request->to_date
            ]);
            return $this->success('Record Updated Successfully');
        }
        catch(Exception $e){
            return $this->error($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $record=RamdanSchedule::findOrfail($id);
        try{
            $record->delete();
            return $this->success('Record Deleted Successfully');
        }
        catch(Exception $e){
            return $this->error($e->getMessage());
        }
    }
}

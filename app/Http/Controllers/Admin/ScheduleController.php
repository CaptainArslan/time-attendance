<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\ScheduleLocation\ScheduleLocationCollection;
use App\Http\Resources\Schedule\ScheduleCollection;
use App\Models\ScheduleLocation;
use App\Models\Schedule;
use App\Traits\RespondsWithJson;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\TryCatch;

class ScheduleController extends Controller
{
    use RespondsWithJson;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new ScheduleCollection(
            Schedule::cursor(),
        );
    }

    public function store(Request $request)
    {
        $request->validate([

            'user_id' => 'required',
            'organization_id' => 'required',
            'from_date' => 'required',
            'to_date'    => 'required',
            'required_work_hour' => 'required',
            'is_open_shift'    => 'required',
            'is_night_shift'    => 'required',
        ]);
        try {
            Schedule::create([
                'user_id' => Auth::id(),
                'organization_id' => $request->organization_id,
                'from_date' => $request->from_date,
                'to_date' => $request->to_date,
                'required_work_hour' => $request->required_work_hour,
                'is_open_shift' => $request->is_open_shift,
                'is_night_shift' => $request->is_night_shift

            ]);
            // var_dump($rec);
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

            'from_date' => 'required',
            'to_date'    => 'required',
            'required_work_hour' => 'required',
            'is_open_shift'    => 'required',
            'is_night_shift'    => 'required',
        ]);
        $record = Schedule::findOrFail($id);
        try {
            $record->update([
                'user_id' => Auth::id(),
                'organization_id' => $request->organization_id,
                'from_date' => $request->from_date,
                'to_date' => $request->to_date,
                'required_work_hour' => $request->required_work_hour,
                'is_open_shift' => $request->is_open_shift,
                'is_night_shift' => $request->is_night_shift
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
        $record = Schedule::findOrFail($id);
        try {
            $record->delete();
            return $this->success('Record Deleted Successfully');
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }
}

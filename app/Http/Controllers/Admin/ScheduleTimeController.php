<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\ScheduleLocation\ScheduleLocationCollection;
use App\Http\Resources\ScheduleTime\ScheduleTimeCollection;
use App\Models\ScheduleLocation;
use App\Models\ScheduleTime;
use App\Models\ScheduleTimeDetail;
use App\Traits\RespondsWithJson;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\TryCatch;

class ScheduleTimeController extends Controller
{
    use RespondsWithJson;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return new ScheduleLocationCollection(
        //     ScheduleTime::cursor(),
        // );

        return new ScheduleTimeCollection(
            ScheduleTime::cursor(),

        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'organization_id' => 'required',
            'schedule_location_id' => 'required',
            'code' => 'required|unique:schedule_times',
            'color' => 'required',
            'grace_in' => 'nullable|integer',
            'grace_out' => 'nullable|integer',
            'flexible' => 'nullable|integer',

            'scheduleTimeDetail.*.time_in' => 'required',
            'scheduleTimeDetail.*.time_out' => 'required|after_or_equal:scheduleTimeDetail.*.time_in',
            'scheduleTimeDetail.*.is_night_shift' => 'required',
            'scheduleTimeDetail.*.is_open_shift' => 'required',
            'scheduleTimeDetail.*.required_work_hour' => 'required',
        ]);
        try {
            $record = ScheduleTime::create([
                'user_id' => Auth::id(),
                'organization_id' => $request->organization_id,
                'schedule_location_id' => $request->schedule_location_id,
                'code' => $request->code,
                'color' => $request->color,
                'grace_in' => $request->grace_in,
                'grace_out' => $request->grace_out,
                'flexible' => $request->flexible,
            ]);

            if (isset($request->scheduleTimeDetail)) {

                $rawString = str_replace('"',"'",$request->scheduleTimeDetail);
                $pureString = str_replace("'",'"',$rawString);
                $arrSchedules = json_decode($pureString, true);
                
                foreach ($arrSchedules as $scheduleTimeDetail) {
                  
                    ScheduleTimeDetail::create([
                        'schedule_time_id' => $record->id,
                        'time_in' => $scheduleTimeDetail['time_in'],
                        'time_out' => $scheduleTimeDetail['time_out'],
                        'required_work_hour' => $scheduleTimeDetail['required_work_hour'],
                        'is_open_shift' => $scheduleTimeDetail['is_open_shift'],
                        'is_night_shift' => $scheduleTimeDetail['is_night_shift'],
                    ]);
                } 
            }

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
    public function saveMeta2($request, $id)
    {
        foreach ($request as $scheduleTimeDetail) {
            $record = ScheduleTimeDetail::create([
                'schedule_time_id' => $id,
                'time_in' => $scheduleTimeDetail['time_in'],
                'time_out' => $scheduleTimeDetail['time_out'],
                'required_work_hour' => $scheduleTimeDetail['required_work_hour'],
                'is_open_shift' => $scheduleTimeDetail['is_open_shift'],
                'is_night_shift' => $scheduleTimeDetail['is_night_shift'],
            ]);
        }
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'organization_id' => 'required',
            'schedule_location_id' => 'required',
            'code' => 'required|unique:schedule_times,code,' . $id,
            'color' => 'required',
            'grace_in' => 'nullable|integer',
            'grace_out' => 'nullable|integer',
            'flexible' => 'nullable|integer',
            'scheduleTimeDetail.*.time_in' => 'required',
            'scheduleTimeDetail.*.time_out' => 'required|after_or_equal:scheduleTimeDetail.*.time_in',
            'scheduleTimeDetail.*.is_night_shift' => 'required',
            'scheduleTimeDetail.*.is_open_shift' => 'required',
            'scheduleTimeDetail.*.required_work_hour' => 'required',
        ]);
        try {
            $record = ScheduleTime::find($id);
            $old_child_schedule_time_detail = ScheduleTimeDetail::whereIn('schedule_time_id', $record->id)
                ->get();
            $current_child_time_detail = collect($request['scheduleTimeDetail']);
            $old_child_current_schedule_time_detail_id = $old_child_schedule_time_detail->pluck('id');
            $current_schedule_time_detail_id_distict = $current_child_time_detail->pluck('schedule_time_detail_id');
            $schedule_time_detail_id = ScheduleTimeDetail::whereIn('id', $current_schedule_time_detail_id_distict)->pluck('id');
            $current_schedule_time_detail_id_all = ScheduleTimeDetail::whereIn('id', $schedule_time_detail_id)->pluck('id');
            $delete_packages_id = array_diff($old_child_current_schedule_time_detail_id->all(), $current_schedule_time_detail_id_all->all());
            $this->deleteScheduleTime($delete_packages_id);
            $current_time_detail_after_deletes = ScheduleTimeDetail::whereIn('id', $old_child_current_schedule_time_detail_id)->get();
            $record->update([
                'organization_id' => $request->organization_id,
                'schedule_location_id' => $request->schedule_location_id,
                'code' => $request->code,
                'color' => $request->color,
                'grace_in' => $request->grace_in,
                'grace_out' => $request->grace_out,
                'flexible' => $request->flexible,
            ]);
            $data = [];
            foreach ($current_time_detail_after_deletes as $current_record_after_delete) {
                $exists_packages = ScheduleTimeDetail::where('id', $current_record_after_delete->id)->get();
                foreach ($exists_packages as $key => $pg) {
                    //  these records commings in requests
                    $rec = $current_child_time_detail->whereIn('schedule_time_detail_id', $exists_packages->pluck('id'))->first();
                    $pg->update([
                        'time_in' => isset($rec['time_in']) ? $rec['time_in'] : $pg->time_in,
                        'time_out' => isset($rec['time_out']) ? $rec['time_out'] : $pg->time_out,
                        'required_work_hour' => isset($rec['required_work_hour']) ? $rec['required_work_hour'] : $pg->required_work_hour,
                        'is_open_shift' => isset($rec['is_open_shift']) ? $rec['is_open_shift'] : $pg->is_open_shift,
                        'is_night_shift' => isset($rec['is_night_shift']) ? $rec['is_night_shift'] : $pg->is_night_shift,
                    ]);
                }
                $data = $this->findKey($current_child_time_detail, 'schedule_time_detail_id');
            }
            $new_time_details = $current_time_detail_after_deletes->unique('schedule_time_detail_id');
            if ($data != []) {
                foreach ($new_time_details as $new_time_detail) {
                    $this->saveMeta2($data, $new_time_detail->schedule_time_id);
                }
            }

            return $this->success('Record Update Successfully');
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $record = ScheduleTime::findOrFail($id);
        try {
            $record->delete();
            return $this->success('Record Deleted Successfully');
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }
    public function deleteScheduleTime($ids)
    {
        $records = ScheduleTimeDetail::whereIn('id', $ids)->get();
        if (!$records->isEmpty()) {
            ScheduleTimeDetail::whereIn('id', $ids)->delete();
            return 1;
        }
    }
}

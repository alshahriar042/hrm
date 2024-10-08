<?php

namespace App\Http\Controllers\Backend;

use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Models\Reconciliation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ReconciliationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('reconciliations.index');

        $user = Auth::user();

        if ($user->role_id == 2) {
            $reconciliations = Reconciliation::where('employee_id', $user->emp_id)->orderBy('id', 'DESC')->get();
            return view('backend.reconciliation.index', compact('reconciliations'));
        } else {
            $reconciliations = Reconciliation::where('approval_status', '!=', 'pending')->orderBy('id', 'DESC')->get();
            return view('backend.reconciliation.index', compact('reconciliations'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('reconciliations.create');
        return view('backend.reconciliation.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('reconciliations.create');

        $this->validate($request, [

            'date'     => 'required|date_format:Y-m-d',
        ]);

        try {
            Reconciliation::create([
                'date'  => date('Y-m-d', strtotime($request->date)),
                'in_time' => $request->in_time,
                'out_time'  => $request->out_time,
                'employee_id' => Auth::user()->emp_id,
                'reason' => $request->reason
            ]);

            notify()->success('Reconciliation Created Successfully', 'Success');
            return redirect()->route('reconciliations.index');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            notify()->error('Reconciliation Create Failed', 'Error');
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function pendingReconciliation()
    {
        Gate::authorize('pending.reconciliation');

        $pending_reconciliations = Reconciliation::where('approval_status', 'pending')->orderBy('id', 'DESC')->get();
        return view('backend.reconciliation.pending-reconciliation', compact('pending_reconciliations'));
    }

    public function approveReconciliation($id)
    {
        Gate::authorize('approve.reconciliation');

        DB::beginTransaction();

        try {
            $reconciliation = Reconciliation::findOrFail($id);

            $attendance = DB::table('machine_attendances')
                ->where('user_id', $reconciliation->employee_id)
                ->where('date', $reconciliation->date)
                ->first();

            if ($attendance != null) {
                $checkInDateTime = null;
                $checkOutDateTime = null;

                if ($reconciliation->in_time == null && $reconciliation->out_time != null) {
                    $checkInDateTime = $attendance->check_in;
                    $checkOutDateTime = $reconciliation->date . ' ' . $reconciliation->out_time;
                } elseif ($reconciliation->in_time != null && $reconciliation->out_time == null) {
                    $checkInDateTime = $reconciliation->date . ' ' . $reconciliation->in_time;
                    $checkOutDateTime =  $attendance->check_out;
                } elseif ($reconciliation->in_time != null && $reconciliation->out_time != null) {
                    $checkInDateTime = $reconciliation->date . ' ' . $reconciliation->in_time;
                    $checkOutDateTime = $reconciliation->date . ' ' . $reconciliation->out_time;
                }

                $this->updateAttendanceAndReconciliation($attendance->id, $checkInDateTime, $checkOutDateTime, $reconciliation);
            } else {
                notify()->warning('Date Not Found', 'Warning');
                return back();
            }

            DB::commit();

            notify()->success('Reconciliation Approved Successfully', 'Success');
            return back();
        } catch (\Throwable $th) {
            DB::rollback();
            Log::error($th->getMessage());
            notify()->error('Reconciliation Approve Failed', 'Error');
            return back();
        }
    }

    function updateAttendanceAndReconciliation($attendanceId, $checkInDateTime, $checkOutDateTime, $reconciliation)
    {
        DB::table('machine_attendances')
            ->where('id', $attendanceId)
            ->update([
                'check_in' => $checkInDateTime,
                'check_out' => $checkOutDateTime,
            ]);

        $reconciliation->update([
            'action_by' => Auth::user()->emp_id,
            'approval_status' => "approved"
        ]);
    }

    public function rejectReconciliation(Request $request)
    {
        Gate::authorize('reject.reconciliation');

        try {
            $reconciliation = Reconciliation::findOrFail($request->reconciliation_id);
            $reconciliation->update([
                'action_by' => Auth::user()->emp_id,
                'remark' => $request->remark,
                'approval_status' => "rejected"
            ]);

            notify()->success('Reconciliation Rejected Successfully', 'Success');
            return back();
        } catch (\Throwable $th) {
            DB::rollback();
            Log::error($th->getMessage());
            notify()->error('Reconciliation Reject Failed', 'Error');
            return back();
        }
    }

    public function reconciliationsRemark($id)
    {
        $user = Auth::user();
        $reconciliation = Reconciliation::where('id', $id)->first();

        if ($user->role_id == 2) {
            return $reconciliation->remark;
        } else {
            return $reconciliation->reason;
        }
    }
}

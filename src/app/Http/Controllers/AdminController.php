<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\AttendanceRecord;
use App\Models\Application;
use Carbon\Carbon;


class AdminController extends Controller
{
    public function list(Request $request)
    {
        $users = User::all();
        $date = Carbon::parse($request->query('date', Carbon::now()));
        $attendanceRecords = AttendanceRecord::whereDate('date', $date)->whereIn('user_id', $users->pluck('id'))->get();

        return view('admin/admin-attendance-list', [
            'users' => $users,
            'attendanceRecords' => $attendanceRecords,
            'date' => $date,
            'previousDay' => $date->copy()->subDay()->format('Y-m-d'),
            'nextDay' => $date->copy()->addDay()->format('Y-m-d'),
        ]);
    }

    public function staffList()
    {
        $users = User::all();

        return view('admin/staff-list', compact('users'));
    }

    public function staffDetailList(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $date = Carbon::parse($request->query('date', Carbon::now()));

        $startOfMonth = $date->copy()->startOfMonth();
        $endOfMonth = $date->copy()->endOfMonth();

        $attendanceRecords = AttendanceRecord::where('user_id', $user->id)->whereBetween('date', [$startOfMonth, $endOfMonth])->get();

        $formattedAttendanceRecords = $attendanceRecords->map(function ($attendance) {
            $weekdays = ['日', '月', '火', '水', '木', '金', '土'];
            $date = Carbon::parse($attendance->date);
            $weekday = $weekdays[$date->dayOfWeek];
            return [
                'id' => $attendance->id,
                'date' => $date->format('m/d') . "($weekday)",
                'clock_in' => $attendance->clock_in ? Carbon::parse($attendance->clock_in)->format('H:i') : null,
                'clock_out' => $attendance->clock_out ? Carbon::parse($attendance->clock_out)->format('H:i') : null,
                'total_time' => $attendance->total_time,
                'total_break_time' => $attendance->total_break_time
            ];
        });

        return view('admin/staff-attendance-list',
        [
            'user' => $user,
            'date' => $date,
            'formattedAttendanceRecords' => $formattedAttendanceRecords,
            'previousMonth' => $date->copy()->subMonth()->format('Y-m'),
            'nextMonth' => $date->copy()->addMonth()->format('Y-m')
        ]);
    }

    public function detail($id)
    {
        $attendanceRecords = AttendanceRecord::findOrFail($id);
        $user = User::findOrFail($attendanceRecords->user_id);

        $application = Application::where('attendance_record_id', $attendanceRecords->id)->where('approval_status', '承認待ち')->get();


        $attendanceRecord = [
            'application' => $attendanceRecords->application,
            'id' => $attendanceRecords->id,
            'year' => $attendanceRecords->date ? Carbon::parse($attendanceRecords->date)->format('Y年') : null,
            'date' => $attendanceRecords->date ? Carbon::parse($attendanceRecords->date)->format('m月d日') : null,
            'clock_in' => $attendanceRecords->clock_in ? Carbon::parse($attendanceRecords->clock_in)->format('H:i') : null,
            'clock_out' => $attendanceRecords->clock_out ? Carbon::parse($attendanceRecords->clock_out)->format('H:i') : null,
            'break_in' => $attendanceRecords->break_in ? Carbon::parse($attendanceRecords->break_in)->format('H:i') : null,
            'break_out' => $attendanceRecords->break_out ? Carbon::parse($attendanceRecords->break_out)->format('H:i') : null,
            'break2_in' => $attendanceRecords->break2_in ? Carbon::parse($attendanceRecords->break2_in)->format('H:i') : null,
            'break2_out' => $attendanceRecords->break2_out ? Carbon::parse($attendanceRecords->break2_out)->format('H:i') : null,
            'comment' => $attendanceRecords->comment,
        ];

        return view('admin/admin-detail', compact('user', 'attendanceRecord', 'application'));
    }

    public function amendmentApplication(Request $request, $id)
    {
        $attendance = AttendanceRecord::findOrFail($id);
        $user = User::findOrFail($attendance->user_id);

        $amendment = new Application();
        $amendment->user_id = $user->id;
        $amendment->attendance_record_id = $attendance->id;
        $amendment->approval_status = "承認待ち";
        $amendment->application_date = now();
        $dateString = $request->new_date;
        $parsedDate = Carbon::createFromFormat('n月j日', $dateString)->year(now()->year)->format('Y-m-d');
        $amendment->new_date = $parsedDate;
        $amendment->new_clock_in = Carbon::parse($request->new_clock_in)->format('H:i');
        $amendment->new_clock_out = Carbon::parse($request->new_clock_out)->format('H:i');
        if ($request->new_break_in) {
        $amendment->new_break_in = Carbon::parse($request->new_break_in)->format('H:i');
    }
    
    if ($request->new_break_out) {
        $amendment->new_break_out = Carbon::parse($request->new_break_out)->format('H:i');
    }
    
    // break2のチェック
    if ($request->new_break2_in) {
        $amendment->new_break2_in = Carbon::parse($request->new_break2_in)->format('H:i');
    }
    
    if ($request->new_break2_out) {
        $amendment->new_break2_out = Carbon::parse($request->new_break2_out)->format('H:i');
    }
        $amendment->comment = $request->comment;
        $amendment->save();


        return redirect('/stamp_correction_request/list');
    }

    public function applicationList()
    {
        $user = User::all();
        $applications = Application::all();

        return view('admin/admin-application-list', compact('user', 'applications'));
    }

    public function approvalShow($id)
    {
        $application = Application::findOrFail($id);
        $user = User::findOrFail($application->user_id);

        $application->new_date = Carbon::parse($application->new_date);
        $application->new_clock_in = Carbon::parse($application->new_clock_in)->format('H:i');
        $application->new_clock_out = Carbon::parse($application->new_clock_out)->format('H:i');
        $application->new_break_in = Carbon::parse($application->new_break_in)->format('H:i');
        $application->new_break_out = Carbon::parse($application->new_break_out)->format('H:i');
        $application->new_break2_in = Carbon::parse($application->new_break2_in)->format('H:i');
        $application->new_break2_out = Carbon::parse($application->new_break2_out)->format('H:i');

        return view('admin/admin-application-detail', compact('user', 'application'));
    }

    public function approval($id)
    {
        $application = Application::findOrFail($id);
        $user = User::findOrFail($application->user_id);
        $attendanceRecord = AttendanceRecord::findOrFail($application->attendance_record_id);

        $application->approval_status = "承認済み";
        $application->save();

        $attendanceRecord->date = $application->new_date;
        $attendanceRecord->clock_in = $application->new_clock_in;
        $attendanceRecord->clock_out = $application->new_clock_out;
        $attendanceRecord->break_in = $application->new_break_in;
        $attendanceRecord->break_out = $application->new_break_out;
        $attendanceRecord->break2_in = $application->new_break2_in;
        $attendanceRecord->break2_out = $application->new_break2_out;
        $attendanceRecord->comment = $application->comment;

        $clockIn = Carbon::parse($attendanceRecord->clock_in);
            $clockOut = Carbon::parse($attendanceRecord->clock_out);

        $totalBreakTime = 0;
            if ($attendanceRecord->break_in && $attendanceRecord->break_out) {
                $breakIn = Carbon::parse($attendanceRecord->break_in);
                $breakOut = Carbon::parse($attendanceRecord->break_out);
                $totalBreakTime += $breakIn->diffInMinutes($breakOut);
            }

            if ($attendanceRecord->break2_in && $attendanceRecord->break2_out) {
                $break2In = Carbon::parse($attendanceRecord->break2_in);
                $break2Out = Carbon::parse($attendanceRecord->break2_out);
                $totalBreakTime += $break2In->diffInMinutes($break2Out);
            }

            $totalBreakHours = floor($totalBreakTime / 60);$totalBreakMinutes = $totalBreakTime % 60;
            $attendanceRecord->total_break_time = sprintf('%02d:%02d', $totalBreakHours, $totalBreakMinutes);

            $totalWorkedMinutes = $clockIn->diffInMinutes($clockOut) - $totalBreakTime;

            $hours = floor($totalWorkedMinutes / 60);
            $minutes = $totalWorkedMinutes % 60;

            $attendanceRecord->total_time = sprintf('%02d:%02d', $hours, $minutes);


        $attendanceRecord->save();

        return redirect('/stamp_correction_request/list');
    }
}


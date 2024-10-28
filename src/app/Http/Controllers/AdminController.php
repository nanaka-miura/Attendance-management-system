<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\AttendanceRecord;
use Carbon\Carbon;


class AdminController extends Controller
{
    public function login()
    {
        return view('admin/admin-login');
    }

    public function doLogin(Request $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();

            if ($user->admin_status) {
                return redirect('admin/attendance/list');
            } else {
                Auth::logout();
                return redirect('/admin/login');
            }
        }
    }

    public function adminLogout()
    {
        Auth::logout();
        return redirect('/admin/login');
    }

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

    public function applicationList()
    {
        return view('admin/admin-application-list');
    }
}
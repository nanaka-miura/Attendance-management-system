<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\AttendanceRecord;
use Database\Seeders\DatabaseSeeder;

class AdminAttendanceTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(DatabaseSeeder::class);
    }

    /** @test */
    public function it_should_display_all_attendance_information_for_all_users()
    {
        $admin = User::where('admin_status', true)->first();
        $this->actingAs($admin);

        $response = $this->get('/admin/attendance/list');

        $today = now()->format('Y-m-d');
        $attendanceRecords = AttendanceRecord::whereDate('date', $today)->get();

        foreach ($attendanceRecords as $record) {
            $response->assertSee($record->user->name);
            $response->assertSee($record->clock_in);
            $response->assertSee($record->clock_out);
        }

        $response->assertStatus(200);

    }

    /** @test */
    public function it_should_display_current_date_when_navigated()
    {
        $admin = User::where('admin_status', true)->first();
        $this->actingAs($admin);

        $response = $this->get('/admin/attendance/list');

        $response->assertSee(now()->format('Y/m/d'));
    }

    /** @test */
    public function it_should_display_attendance_information_for_previous_day()
    {
        $admin = User::where('admin_status', true)->first();
        $this->actingAs($admin);

        $response = $this->get('/admin/attendance/list');

        $previousDay = now()->subDay();

        $attendanceRecords = AttendanceRecord::whereDate('date', $previousDay)->get();

        $response = $this->get('/attendance?date=' . $previousDay->format('Y年m月d日'));

        foreach ($attendanceRecords as $record) {
            $response->assertSee($record->user->name);
            $response->assertSee($record->clock_in);
            $response->assertSee($record->clock_out);
        }
        $response->assertStatus(200);

    }

    /** @test */
    public function it_should_display_attendance_information_for_next_day()
    {
        $admin = User::where('admin_status', true)->first();
        $this->actingAs($admin);

        $response = $this->get('/admin/attendance/list');

        $nextDay = now()->addDay();

        $attendanceRecords = AttendanceRecord::whereDate('date', $nextDay)->get();

        $response = $this->get('/attendance?date=' . $nextDay->format('Y年m月d日'));

        foreach ($attendanceRecords as $record) {
            $response->assertSee($record->user->name);
            $response->assertSee($record->clock_in);
            $response->assertSee($record->clock_out);
        }
        $response->assertStatus(200);

    }
}
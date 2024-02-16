<?php

namespace Modules\HumanResource\Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use Modules\HumanResource\Models\Leave;
use Modules\HumanResource\Models\LeaveType;
use Modules\HumanResource\Models\AnnualLeaveAllocation;
use Carbon\Carbon;

class LeavesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Retrieve leave types
        $leaveTypes = LeaveType::all();
        
        // Retrieve users
        $users = User::all();
        
        // Define sample leave data
        $leaveData = [
            [
                'user_id' => $users->random()->id,
                'leave_type_id' => $leaveTypes->random()->id,
                'start_date' => Carbon::now()->subDays(rand(1, 30)),
                'end_date' => Carbon::now()->subDays(rand(0, 30)),
                'number_of_days' => rand(1, 10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more sample leave data as needed
        ];

        // Populate the Leave table with sample data
        Leave::insert($leaveData);
    }
}

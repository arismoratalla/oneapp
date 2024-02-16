<?php

namespace Modules\HumanResource\Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use Modules\HumanResource\Models\LeaveType;
use Modules\HumanResource\Models\AnnualLeaveAllocation;

class AnnualLeaveAllocationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all users and leave types
        $users = User::all();
        $leaveTypes = LeaveType::all();

        // Iterate over each user and leave type to create annual leave allocations
        foreach ($users as $user) {
            foreach ($leaveTypes as $leaveType) {
                // Example logic to calculate allocation based on accumulation rate (1.25 days per month)
                $currentYear = date('Y');
                $allocation = $user->id % 2 == 0 ? 15 : 10; // Example: Even user IDs get 15 days, odd user IDs get 10 days

                // Create or update annual leave allocation record
                AnnualLeaveAllocation::updateOrCreate(
                    [
                        'user_id' => $user->id,
                        'leave_type_id' => $leaveType->id,
                        'year' => $currentYear,
                    ],
                    [
                        'allocation' => $allocation,
                    ]
                );
            }
        }
    }
}

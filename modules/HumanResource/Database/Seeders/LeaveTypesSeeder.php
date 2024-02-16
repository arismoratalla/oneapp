<?php

namespace Modules\HumanResource\Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Modules\HumanResource\Models\LeaveType;

class LeaveTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $leaveTypes = [
            ['name' => 'Vacation Leave', 'description' => 'Sec. 51, Rule XVI, Omnibus Rules Implementing E.O. No. 292'],
            ['name' => 'Mandatory/Forced Leave', 'description' => 'Sec. 25, Rule XVI, Omnibus Rules Implementing E.O. No. 292'],
            ['name' => 'Sick Leave', 'description' => 'Sec. 43, Rule XVI, Omnibus Rules Implementing E.O. No. 292'],
            ['name' => 'Maternity Leave', 'description' => 'R.A. No. 11210 / IRR issued by CSC, DOLE and SSS'],
            ['name' => 'Paternity Leave', 'description' => 'R.A. No. 8187 / CSC MC No. 71, s. 1998, as amended'],
            ['name' => 'Special Privilege Leave', 'description' => 'Sec. 21, Rule XVI, Omnibus Rules Implementing E.O. No. 292'],
            ['name' => 'Solo Parent Leave', 'description' => 'RA No. 8972 / CSC MC No. 8, s. 2004'],
            ['name' => 'Study Leave', 'description' => 'Sec. 68, Rule XVI, Omnibus Rules Implementing E.O. No. 292'],
            ['name' => '10-Day VAWC Leave', 'description' => 'RA No. 9262 / CSC MC No. 15, s. 2005'],
            ['name' => 'Rehabilitation Privilege', 'description' => 'Sec. 55, Rule XVI, Omnibus Rules Implementing E.O. No. 292'],
            ['name' => 'Special Leave Benefits for Women', 'description' => 'RA No. 9710 / CSC MC No. 25, s. 2010'],
            ['name' => 'Special Emergency (Calamity) Leave', 'description' => 'CSC MC No. 2, s. 2012, as amended'],
            ['name' => 'Adoption Leave', 'description' => 'R.A. No. 8552']
        ];

        foreach ($leaveTypes as $leaveType) {
            LeaveType::create($leaveType);
        }
    }
}

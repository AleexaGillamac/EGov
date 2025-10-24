<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OfficeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('offices')->insert([
            [
                'name' => 'Office of the Mayor',
                'code' => 'MAYOR',
                'description' => 'Responsible for overseeing the overall governance, administration, and development programs of the Municipality of Sta. Maria.',
                'email' => 'mayor@stamaria.gov.ph',
                'phone' => '(044) 641-4444',
            ],
            [
                'name' => 'Office of the Vice Mayor',
                'code' => 'VICE-MAYOR',
                'description' => 'Assists the Mayor in local governance and presides over the Sangguniang Bayan sessions.',
                'email' => 'vicemayor@stamaria.gov.ph',
                'phone' => '(044) 641-4445',
            ],
            [
                'name' => 'Municipal Planning and Development Office',
                'code' => 'MPDO',
                'description' => 'Formulates and monitors the implementation of development plans and investment programs for the municipality.',
                'email' => 'mpdo@stamaria.gov.ph',
                'phone' => '(044) 641-4446',
            ],
            [
                'name' => 'Municipal Engineering Office',
                'code' => 'ENGR',
                'description' => 'Handles infrastructure planning, design, and maintenance of public facilities and roads.',
                'email' => 'engineering@stamaria.gov.ph',
                'phone' => '(044) 641-4447',
            ],
            [
                'name' => 'Municipal Health Office',
                'code' => 'MHO',
                'description' => 'Provides healthcare services, disease prevention, and public health education to residents.',
                'email' => 'health@stamaria.gov.ph',
                'phone' => '(044) 641-4448',
            ],
            [
                'name' => 'Municipal Social Welfare and Development Office',
                'code' => 'MSWDO',
                'description' => 'Implements social welfare programs and assists marginalized individuals and families in need.',
                'email' => 'mswdo@stamaria.gov.ph',
                'phone' => '(044) 641-4449',
            ],
            [
                'name' => 'Municipal Treasurer’s Office',
                'code' => 'MTO',
                'description' => 'Collects taxes, fees, and other revenues, and manages municipal funds and financial transactions.',
                'email' => 'treasury@stamaria.gov.ph',
                'phone' => '(044) 641-4450',
            ],
            [
                'name' => 'Municipal Budget Office',
                'code' => 'MBO',
                'description' => 'Prepares and monitors the annual municipal budget and ensures fiscal discipline.',
                'email' => 'budget@stamaria.gov.ph',
                'phone' => '(044) 641-4451',
            ],
            [
                'name' => 'Municipal Human Resource Management Office',
                'code' => 'HRMO',
                'description' => 'Oversees recruitment, personnel management, and employee welfare within the LGU.',
                'email' => 'hrmo@stamaria.gov.ph',
                'phone' => '(044) 641-4452',
            ],
            [
                'name' => 'Municipal Environment and Natural Resources Office',
                'code' => 'MENRO',
                'description' => 'Manages environmental programs, waste management, and conservation projects in Sta. Maria.',
                'email' => 'menro@stamaria.gov.ph',
                'phone' => '(044) 641-4453',
            ],
        ]);
    }
}

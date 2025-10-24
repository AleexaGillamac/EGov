<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get office IDs using their codes
        $mayorsOfficeId = DB::table('offices')->where('code', 'MAYOR')->value('id');
        $viceMayorOfficeId = DB::table('offices')->where('code', 'VICE-MAYOR')->value('id');
        $MPDO = DB::table('offices')->where('code', 'MPDO')->value('id');
        $ENGR = DB::table('offices')->where('code', 'ENGR')->value('id');
        $MHO = DB::table('offices')->where('code', 'MHO')->value('id');
        $MSWDO = DB::table('offices')->where('code', 'MSWDO')->value('id');
        $MTO = DB::table('offices')->where('code', 'MTO')->value('id');
        $MBO = DB::table('offices')->where('code', 'MBO')->value('id');
        $HRMO = DB::table('offices')->where('code', 'HRMO')->value('id');
        $MENRO = DB::table('offices')->where('code', 'MENRO')->value('id');

        DB::table('categories')->insert([
            // Mayor's Office
            [
                'office_id' => $mayorsOfficeId,
                'name' => 'no_response',
                'label' => 'No Response to Public Complaints',
                'description' => 'Failure to respond promptly or at all to public concerns or complaints.',
            ],
            [
                'office_id' => $mayorsOfficeId,
                'name' => 'delay_in_assistance',
                'label' => 'Delay in Approving Assistance Requests',
                'description' => 'Prolonged processing or approval of citizen assistance requests.',
            ],
            [
                'office_id' => $mayorsOfficeId,
                'name' => 'unclear_projects',
                'label' => 'Unclear Project Updates',
                'description' => 'Lack of transparency or unclear communication regarding municipal projects.',
            ],
            [
                'office_id' => $mayorsOfficeId,
                'name' => 'unaccommodating_staff',
                'label' => 'Staff Not Accommodating Visitors',
                'description' => 'Reports of unhelpful or unaccommodating staff when assisting citizens.',
            ],
            [
                'office_id' => $mayorsOfficeId,
                'name' => 'poor_communication',
                'label' => 'Poor Communication with Citizens',
                'description' => 'Inadequate communication channels or failure to provide updates to the public.',
            ],

            // Vice Mayor's Office
            [
                'office_id' => $viceMayorOfficeId,
                'name' => 'no_response',
                'label' => 'No Response to Public Requests',
                'description' => 'Failure to reply or acknowledge public concerns or requests.',
            ],
            [
                'office_id' => $viceMayorOfficeId,
                'name' => 'unclear_plans',
                'label' => 'Unclear Project Plans',
                'description' => 'Lack of transparency in project or initiative planning.',
            ],
            [
                'office_id' => $viceMayorOfficeId,
                'name' => 'low_visibility',
                'label' => 'Lack of Visibility or Community Presence',
                'description' => 'Limited engagement or visibility in the community.',
            ],
            [
                'office_id' => $viceMayorOfficeId,
                'name' => 'poor_coordination',
                'label' => 'Poor Coordination with Departments',
                'description' => 'Inefficient coordination with other municipal offices or departments.',
            ],
            [
                'office_id' => $viceMayorOfficeId,
                'name' => 'disrespectful_handling',
                'label' => 'Disrespectful Handling of Citizens’ Concerns',
                'description' => 'Citizens report rude or unprofessional behavior from staff.',
            ],

            // Municipal Engineering Office
            [
                'office_id' => $ENGR,
                'name' => 'poor_quality_infra',
                'label' => 'Poor Quality of Roads or Infrastructure',
                'description' => 'Substandard construction quality or quickly deteriorating infrastructure.',
            ],
            [
                'office_id' => $ENGR,
                'name' => 'delayed_projects',
                'label' => 'Delay in Construction or Repair Projects',
                'description' => 'Projects not completed on schedule or with excessive delays.',
            ],
            [
                'office_id' => $ENGR,
                'name' => 'no_warning_signs',
                'label' => 'No Warning Signs During Roadwork',
                'description' => 'Failure to install safety or warning signs during construction.',
            ],
            [
                'office_id' => $ENGR,
                'name' => 'lack_of_maintenance',
                'label' => 'Lack of Inspection and Maintenance',
                'description' => 'Failure to maintain or inspect roads and public structures regularly.',
            ],
            [
                'office_id' => $ENGR,
                'name' => 'unsafe_practices',
                'label' => 'Unsafe Construction Practices',
                'description' => 'Reports of unsafe or non-compliant construction methods.',
            ],

            // Municipal Environment and Natural Resources Office
            [
                'office_id' => $MENRO,
                'name' => 'poor_collection',
                'label' => 'Poor Garbage Collection Schedule',
                'description' => 'Irregular or inconsistent garbage collection affecting cleanliness.',
            ],
            [
                'office_id' => $MENRO,
                'name' => 'improper_disposal',
                'label' => 'Improper Waste Disposal in Public Areas',
                'description' => 'Failure to properly manage waste in public places.',
            ],
            [
                'office_id' => $MENRO,
                'name' => 'dirty_surroundings',
                'label' => 'Dirty Rivers or Surroundings',
                'description' => 'Polluted or unmaintained water bodies and surroundings.',
            ],
            [
                'office_id' => $MENRO,
                'name' => 'lack_programs',
                'label' => 'Lack of Tree Planting or Cleanup Programs',
                'description' => 'Few or no initiatives for environmental restoration or cleanliness.',
            ],
            [
                'office_id' => $MENRO,
                'name' => 'unresponsive_pollution',
                'label' => 'Unresponsive to Pollution Complaints',
                'description' => 'No immediate action or investigation after reports of pollution.',
            ],

            // Municipal Health Office
            [
                'office_id' => $MHO,
                'name' => 'long_waiting_time',
                'label' => 'Long Waiting Time in Health Centers',
                'description' => 'Patients experience long queues and delays in service.',
            ],
            [
                'office_id' => $MHO,
                'name' => 'no_medicines',
                'label' => 'No Available Medicines or Vaccines',
                'description' => 'Stockouts or lack of essential medicines and vaccines.',
            ],
            [
                'office_id' => $MHO,
                'name' => 'rude_staff',
                'label' => 'Rude or Inattentive Staff',
                'description' => 'Reports of unprofessional or neglectful staff behavior.',
            ],
            [
                'office_id' => $MHO,
                'name' => 'unclean_facilities',
                'label' => 'Unclean or Crowded Facilities',
                'description' => 'Unsanitary or overcrowded conditions in municipal health centers.',
            ],
            [
                'office_id' => $MHO,
                'name' => 'no_health_updates',
                'label' => 'Lack of Updates on Health Programs',
                'description' => 'Failure to inform citizens about ongoing or new health initiatives.',
            ],

            // Municipal Social Welfare and Development Office
            [
                'office_id' => $MSWDO,
                'name' => 'aid_delay',
                'label' => 'Delay in Cash or Food Aid',
                'description' => 'Prolonged or inconsistent distribution of aid to beneficiaries.',
            ],
            [
                'office_id' => $MSWDO,
                'name' => 'unfair_distribution',
                'label' => 'Unfair Distribution of Assistance',
                'description' => 'Favoritism or unequal distribution among recipients.',
            ],
            [
                'office_id' => $MSWDO,
                'name' => 'unclear_requirements',
                'label' => 'Unclear Requirements for Beneficiaries',
                'description' => 'Lack of clear information regarding application requirements.',
            ],
            [
                'office_id' => $MSWDO,
                'name' => 'unhelpful_staff',
                'label' => 'Staff Not Entertaining Inquiries',
                'description' => 'Failure to assist citizens seeking information or support.',
            ],
            [
                'office_id' => $MSWDO,
                'name' => 'no_response_applications',
                'label' => 'No Response to Social Assistance Applications',
                'description' => 'Applications go unanswered or unresolved for long periods.',
            ],

            // Municipal Treasury Office
            [
                'office_id' => $MTO,
                'name' => 'wrong_computation',
                'label' => 'Wrong Tax Computation',
                'description' => 'Errors in calculating taxes or fees.',
            ],
            [
                'office_id' => $MTO,
                'name' => 'receipt_delay',
                'label' => 'Delay in Releasing Receipts',
                'description' => 'Late issuance of receipts after payment.',
            ],
            [
                'office_id' => $MTO,
                'name' => 'overcharging',
                'label' => 'Overcharging of Fees',
                'description' => 'Charging higher than the prescribed or official amount.',
            ],
            [
                'office_id' => $MTO,
                'name' => 'long_queues',
                'label' => 'Long Lines for Payment',
                'description' => 'Inefficient payment process causing long queues.',
            ],
            [
                'office_id' => $MTO,
                'name' => 'unhelpful_staff',
                'label' => 'Unhelpful Staff During Payment',
                'description' => 'Staff not providing assistance or guidance during transactions.',
            ],
        ]);
    }
}

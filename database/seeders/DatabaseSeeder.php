<?php

namespace Database\Seeders;

use App\Models\AcademicYear;
use App\Models\User;
use App\Models\College;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Program;
use App\Models\Student;
use App\Models\Violation;
use App\Models\OffenseLevel;
use App\Models\PenaltyAction;
use App\Models\Semester;
use App\Models\Status;
use Illuminate\Database\Seeder;
use App\Models\ViolationCategory;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $colleges = [
            [
                "id" => 1,
                "code" => "CA",
                "name" => "College of Agriculture",
                "programs" => [
                    ["id" => 22, "code" => "BSA", "name" => "Bachelor of Science in Agriculture"],
                    ["id" => 37, "code" => "BSDC", "name" => "Bachelor of Science in Development Communication"]
                ]
            ],
            [
                "id" => 2,
                "code" => "COED",
                "name" => "College of Education",
                "programs" => [
                    ["id" => 13, "code" => "BSED", "name" => "Bachelor of Secondary Education"],
                    ["id" => 14, "code" => "BEED", "name" => "Bachelor of Elementary Education"],
                    ["id" => 45, "code" => "BPE", "name" => "Bachelor of Physical Education"]
                ]
            ],
            [
                "id" => 3,
                "code" => "CAFES",
                "name" => "College of Agroforestry and Environmental Studies",
                "programs" => [
                    ["id" => 25, "code" => "BSAF", "name" => "Bachelor of Science in Agro-Forestry"],
                    ["id" => 26, "code" => "BSES", "name" => "Bachelor of Science in Environmental Science"]
                ]
            ],
            [
                "id" => 4,
                "code" => "CBAA",
                "name" => "College of Business Administration and Accountancy",
                "programs" => [
                    ["id" => 8, "code" => "BSACC", "name" => "Bachelor of Science in Accountancy"],
                    ["id" => 15, "code" => "BSBA", "name" => "Bachelor of Science in Business Administration"],
                    ["id" => 17, "code" => "BSOA", "name" => "Bachelor of Science in Office Administration"]
                ]
            ],
            [
                "id" => 5,
                "code" => "CCJE",
                "name" => "College of Criminal Justice Education",
                "programs" => [
                    ["id" => 9, "code" => "BSCRIM", "name" => "Bachelor of Science in Criminology"],
                    ["id" => 10, "code" => "BFS", "name" => "Bachelor of Forensic Science"]
                ]
            ],
            [
                "id" => 6,
                "code" => "CEIT",
                "name" => "College of Engineering and Information Technology",
                "programs" => [
                    ["id" => 27, "code" => "BSIT", "name" => "Bachelor of Science in Information Technology"],
                    ["id" => 28, "code" => "BSCpE", "name" => "Bachelor of Science in Computer Engineering"],
                    ["id" => 29, "code" => "BSCE", "name" => "Bachelor of Science in Civil Engineering"],
                    ["id" => 30, "code" => "BSABE", "name" => "Bachelor of Science in Agricultural & Biosystems Engineering"],
                    ["id" => 32, "code" => "BSMATH", "name" => "Bachelor of Science in Mathematics"],
                    ["id" => 35, "code" => "BSEE", "name" => "Bachelor of Science in Electrical Engineering"]
                ]
            ],
            [
                "id" => 7,
                "code" => "CETHM",
                "name" => "College of Entrepreneurship, Tourism and Hospitality Management",
                "programs" => [
                    ["id" => 11, "code" => "BSHM", "name" => "Bachelor of Science in Hospitality Management"],
                    ["id" => 16, "code" => "BSENTREP", "name" => "Bachelor of Science in Entrepreneurship"],
                    ["id" => 36, "code" => "BSTM", "name" => "Bachelor of Science in Tourism Management"]
                ]
            ],
            [
                "id" => 8,
                "code" => "COF",
                "name" => "College of Forestry",
                "programs" => [
                    ["id" => 24, "code" => "BSF", "name" => "Bachelor of Science in Forestry"]
                ]
            ],
            [
                "id" => 9,
                "code" => "CLASS",
                "name" => "College of Liberal Arts and Social Sciences",
                "programs" => [
                    ["id" => 1, "code" => "PHDEV", "name" => "Doctor of Philosophy in Development Education"],
                    ["id" => 2, "code" => "PHDCD", "name" => "Doctor of Philosophy in Community Development"],
                    ["id" => 19, "code" => "AB-HIST", "name" => "Bachelor of Arts in History"],
                    ["id" => 20, "code" => "AB-ENG", "name" => "Bachelor of Arts in English Language"],
                    ["id" => 34, "code" => "BSSW", "name" => "Bachelor of Science in Social Work"],
                    ["id" => 38, "code" => "BAPoS", "name" => "Bachelor of Arts in Political Science"]
                ]
            ],
            [
                "id" => 10,
                "code" => "CHNS",
                "name" => "College of Health and Natural Sciences",
                "programs" => [
                    ["id" => 12, "code" => "BSMID", "name" => "Bachelor of Science in Midwifery"],
                    ["id" => 33, "code" => "BSBIO", "name" => "Bachelor of Science in Biology"],
                    ["id" => 41, "code" => "DMID", "name" => "Diploma in Midwifery"],
                    ["id" => 47, "code" => "BSPHAR", "name" => "Bachelor of Science in Pharmacy"]
                ]
            ],
            [
                "id" => 11,
                "code" => "CPAIG",
                "name" => "College of Public Administration and Indigenous Governance",
                "programs" => [
                    ["id" => 4, "code" => "MPA", "name" => "Master in Public Administration"],
                    ["id" => 21, "code" => "BPA", "name" => "Bachelor of Public Administration"]
                ]
            ],
            [
                "id" => 12,
                "code" => "COL",
                "name" => "College of Law",
                "programs" => [
                    ["id" => 7, "code" => "JD", "name" => "Juris Doctor"]
                ]
            ]
        ];

        foreach($colleges as $college) {
            $col = College::create([
                'code' => $college['code'],
                'description' => $college['name']
            ]);

            foreach($college['programs'] as $program) {
                Program::create([
                    'college_id' => $col['id'],
                    'code' => $program['code'],
                    'description' => $program['name']
                ]);
            }
        }

        $offenseLevels = [
            ['name' => '1st Offense'],
            ['name' => '2nd Offense'],
            ['name' => '3rd Offense'],
        ];

        foreach ($offenseLevels as $level) {
            OffenseLevel::create($level);
        }

        $penaltyActions = [
            ['name' => 'Verbal Warning'],
            ['name' => 'Written Warning'],
            ['name' => 'Community Service'],
            ['name' => 'Suspension'],
            ['name' => 'Expulsion'],
        ];

        foreach ($penaltyActions as $action) {
            PenaltyAction::create($action);
        }

        $violationCategories = [
            ['name' => 'Minor Offenses'],
            ['name' => 'Major Offenses'],
            ['name' => 'Academic Integrity Violations'],
            ['name' => 'Disciplinary Infractions'],
            ['name' => 'Campus Policy Violations'],
        ];

        foreach ($violationCategories as $category) {
            ViolationCategory::create($category);
        }

        // Fetch all categories with their IDs
        $violationCategories = ViolationCategory::all()->keyBy('name');

        // Define violations with their corresponding categories
        $violations = [
            // Minor Offenses
            [
                'code' => 'MIN-001',
                'name' => 'Littering',
                'description' => 'Throwing garbage in unauthorized areas within campus.',
                'violation_category_id' => $violationCategories['Minor Offenses']->id ?? null,
            ],
            [
                'code' => 'MIN-002',
                'name' => 'Dress Code Violation',
                'description' => 'Failure to comply with the university’s dress code policy.',
                'violation_category_id' => $violationCategories['Minor Offenses']->id ?? null,
            ],

            // Major Offenses
            [
                'code' => 'MAJ-001',
                'name' => 'Vandalism',
                'description' => 'Defacing school property such as walls, desks, or books.',
                'violation_category_id' => $violationCategories['Major Offenses']->id ?? null,
            ],
            [
                'code' => 'MAJ-002',
                'name' => 'Physical Altercation',
                'description' => 'Engaging in fights or causing harm to others.',
                'violation_category_id' => $violationCategories['Major Offenses']->id ?? null,
            ],

            // Academic Integrity Violations
            [
                'code' => 'AIV-001',
                'name' => 'Plagiarism',
                'description' => 'Copying work from others without proper attribution.',
                'violation_category_id' => $violationCategories['Academic Integrity Violations']->id ?? null,
            ],
            [
                'code' => 'AIV-002',
                'name' => 'Cheating',
                'description' => 'Using unauthorized materials during exams.',
                'violation_category_id' => $violationCategories['Academic Integrity Violations']->id ?? null,
            ],

            // Disciplinary Infractions
            [
                'code' => 'DIS-001',
                'name' => 'Disrespect to Faculty',
                'description' => 'Showing verbal or physical disrespect to teachers or staff.',
                'violation_category_id' => $violationCategories['Disciplinary Infractions']->id ?? null,
            ],
            [
                'code' => 'DIS-002',
                'name' => 'Unauthorized Protest',
                'description' => 'Engaging in protests without proper authorization.',
                'violation_category_id' => $violationCategories['Disciplinary Infractions']->id ?? null,
            ],

            // Campus Policy Violations
            [
                'code' => 'CPV-001',
                'name' => 'Smoking in Campus',
                'description' => 'Smoking in prohibited areas inside the university.',
                'violation_category_id' => $violationCategories['Campus Policy Violations']->id ?? null,
            ],
            [
                'code' => 'CPV-002',
                'name' => 'Unauthorized Entry',
                'description' => 'Entering restricted areas without permission.',
                'violation_category_id' => $violationCategories['Campus Policy Violations']->id ?? null,
            ],
        ];

        // Insert violations into the database
        foreach ($violations as $violation) {
            if ($violation['violation_category_id']) {
                Violation::create($violation);
            }
        }

        $users = [
            [
                'name' => 'John Doe',
                'email' => 'admin@admin.com',
                'password' => bcrypt('1234567890'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'John Doe',
                'email' => 'user@user.com',
                'password' => bcrypt('1234567890'),
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];

        foreach($users as $user) {
            DB::table('users')->insert($user);
        }


        foreach (range(1, 50) as $index) {
            Student::create([
                'id_number' => fake()->unique()->numerify('2025####'),
                'first_name' => fake()->firstName,
                'middle_name' => fake()->firstName,
                'last_name' => fake()->lastName,
                'ext_name' => fake()->randomElement(['Jr.', 'Sr.', 'III', null]),
                'address' => fake()->address,
                'contact_number' => fake()->phoneNumber,
                'email_address' => fake()->unique()->safeEmail,
                'program_id' => \App\Models\Program::inRandomOrder()->first()->id ?? 1,
            ]);
        }

        $status = [
            'New',
            'Open',
            'Closed',
            'Resolved',
            'Escalated'
        ];

        foreach($status as $stat) {
            Status::create([
                'name' => $stat
            ]);
        }

        $semesters = [
            'First Semester',
            'Second Semester',
            'Midyear Semester'
        ];

        foreach($semesters as $sem) {
            Semester::create([
                'name' => $sem
            ]);
        }

        foreach(range(2017, 2025) as $index)
        {
            $semester = Semester::all();

            foreach($semester as $sem) {
                AcademicYear::create([
                    'code' => $index,
                    'year' => $index,
                    'semester_id' => $sem->id
                ]);
            }

        }



    }
}

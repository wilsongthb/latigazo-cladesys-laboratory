<?php

use Illuminate\Database\Seeder;
use \App\Models\LaboratoryJobs;
use \DB as DB;
use Faker\Factory;

class LaboratoryJobsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        $rows = [];

        for($i = 0; $i < 100; $i++){
            $rows[] = [
                'user_id' => 1,
                'description' => $faker->text(12),
                'observation' => $faker->text,
                'charge' => $faker->dateTimeBetween(
                    '2017-01-01 00:00:00',
                    'now'
                ),
                'deliver' => $faker->dateTimeBetween(
                    'now',
                    '2018-06-06 00:00:00'
                ),
                'clinic_patient_name' => $faker->name,
                'clinic_doctor_name' => 'Dr. '.$faker->name,
                'type_id' => $faker->randomElement([1,2])
            ];
            
        }

        // dd($rows);
        DB::table('laboratory_jobs')->insert($rows);
        // dd('Exito :D');
    }
}

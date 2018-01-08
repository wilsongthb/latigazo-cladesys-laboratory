<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use \DB as DB;

class LabJobStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        for($i = 1; $i <= 100; $i++){
            $status = [];
            $status[] = ['user_id' => 1, 'status_id' => 2, 'laboratory_job_id' => $i];
            $status_quantity = $faker->numberBetween(0, 5);
            for($j = 0; $j < $status_quantity; $j++){
                $status[] = ['user_id' => 1, 'status_id' => 3, 'laboratory_job_id' => $i];
            }
            $status[] = ['user_id' => 1, 'status_id' => 4, 'laboratory_job_id' => $i];

            print_r($status);
            DB::table('laboratory_job_status')->insert($status);
        }
        
    }
}

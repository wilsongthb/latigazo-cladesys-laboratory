<?php

use Illuminate\Database\Seeder;
use \DB as DB;
use \App\Models\LaboratoryJobTypes;
use \App\Models\LaboratoryJobs;

class BasicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('users')->insert([
            'name' => 'ROOT',
            'email' => 'root@root.root',
            'password' => bcrypt('root')
        ]);

        DB::table('laboratory_job_types')->insert([
            ['user_id' => '1', 'value' => 'TRABAJO INTERNO'],
            ['user_id' => '1', 'value' => 'TRABAJO EXTERNO'],
        ]);
    }
}

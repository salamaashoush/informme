<?php

use Illuminate\Database\Seeder;

class GovernoratesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('governorates')->insert([
            'name' =>'Alexandria',
            'capital' => 'Alexandria' ,
            'area' => 2300 ,
            'cities' => 2 ,
            'districts' => 7 ,
            'divisions' => 1 ,
            'units' => null ,
            'governor' => 'Tarek Mahdy Abdel Towab' ,
            'population' => 4716078,
            'p_density_rate' => 1600 ,
            'creation_date' => \Carbon\Carbon::create(332)  ,
            'national_day' => \Carbon\Carbon::create(332) ,
            'description' => 'the capital of egypt',
        ]);
    }
}

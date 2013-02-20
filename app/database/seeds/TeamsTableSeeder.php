<?php

class TeamsTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = array(
           
           array(
            'id' => 1,
            'lead' => 1,
            'companion' => 1,
            'steward' => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime,
            ),

           array(
            'id' => 2,
            'lead' => 2,
            'companion' => 2,
            'steward' => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime,
            ),

        );

        DB::table('teams')->insert($items);
    }

}
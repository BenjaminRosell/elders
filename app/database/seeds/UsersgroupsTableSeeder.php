<?php

class UsersgroupsTableSeeder extends Seeder {

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
            'user_id' => 1,
            'group_id' => 2
            ),

           array(
            'id' => 2,
            'user_id' => 2,
            'group_id' => 1
            ),
        );

        DB::table('users_groups')->insert($items);
    }

}
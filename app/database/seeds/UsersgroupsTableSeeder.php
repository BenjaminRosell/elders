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
            'user_id' => 1,
            'group_id' => 2
            ),

           array(
            'user_id' => 2,
            'group_id' => 1
            ),
        );

        DB::table('users_groups')->insert($items);
    }

}
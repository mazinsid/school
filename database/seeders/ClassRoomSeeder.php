<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassRoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('class_rooms')->insert([
            'name' => 'الصف الاول',
          
            ]);

        DB::table('class_rooms')->insert([
            'name' => 'الصف الثاني',
          
            ]);
        DB::table('class_rooms')->insert([
            'name' => 'الصف الثالث',
          
            ]);
            DB::table('class_rooms')->insert([
            'name' => 'الصف الرابع',
          
            ]);
            DB::table('class_rooms')->insert([
                'name' => 'الصف الخامس',
              
                ]);
                DB::table('class_rooms')->insert([
                    'name' => 'الصف السادس',
                  
                    ]);
                    DB::table('class_rooms')->insert([
                        'name' => 'الصف السابع',
                      
                        ]);

                        DB::table('class_rooms')->insert([
                            'name' => 'الصف الثامن',
                          
                            ]);
    }
}

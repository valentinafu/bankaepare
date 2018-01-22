<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('faculties')->insert([
            ['name' => 'Fakulteti i Shkencave të Natyrës'],
            ['name' => 'Fakulteti i Historisë dhe i Filologjisë'],
            ['name' => 'Fakulteti i Ekonomisë'],
            ['name' => 'Fakulteti i Drejtësisë'],
            ['name' => 'Fakulteti i Gjuhëve të Huaja'],
            ['name' => 'Fakulteti i Shkencave Sociale']
        ]);
        // Mbase Politekniku, Mjekesori etj

        $this->call(DegreesTableSeeder::class);
        $this->call(SubjectsTableSeeder::class);

        DB::table('users')->insert([
            [
                'name' => 'Sara Tanku',
                'email' => 'sara.tanku@gmail.com',
                'google_id' => '112993409013064542088',
                'role' => '3',
                'active' => '1',
                'created_at' => '2018-01-07 10:56:11',
                'updated_at' => '2018-01-07 10:56:11'
            ],
            [
                'name' => 'Mariglen Jahollari',
                'email' => 'mariglen.jahollari@fshnstudent.info',
                'google_id' => '103948016993609272847',
                'role' => '2',
                'active' => '1',
                'created_at' => '2018-01-07 14:03:13',
                'updated_at' => '2018-01-07 14:03:13'
            ]
        ]);

        DB::table('moderator_degrees')->insert([
            [
                'moderator_id' => '2',
                'degree_id' => '1'
            ],
            [
                'moderator_id' => '2',
                'degree_id' => '5'
            ]
        ]);
    }
}

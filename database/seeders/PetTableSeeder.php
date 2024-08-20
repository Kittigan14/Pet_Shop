<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PetTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pet')->insert(array(
            [
                'code' => 'PET001',
                'name' => 'Persian',
                'category_id' => 2,
                'price' => 8000
            ],
            [
                'code' => 'PET002',
                'name' => 'Siamese',
                'category_id' => 2,
                'price' => 7000
            ],
            [
                'code' => 'PET003',
                'name' => 'Maine Coon',
                'category_id' => 2,
                'price' => 15000
            ],
            [
                'code' => 'PET004',
                'name' => 'Bengal',
                'category_id' => 2,
                'price' => 12000
            ],
            [
                'code' => 'PET005',
                'name' => 'Scottish Fold',
                'category_id' => 2,
                'price' => 9000
            ],
        ));
    }
}

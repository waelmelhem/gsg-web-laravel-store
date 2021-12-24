<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //SQL
        // INSERT INTO CATEGORIES (parent_id,NAME,SLUG,DESCRIPTION,image)
        //values (null,"Clothes,null,null)

        //Query Builder 

        DB::table('categories')->insert([
                'parent_id' => null,
                'name' => 'Clothes',
                "slug" => 'clothes',
                'description' => null,
                'image' => null,
            ]);
            // DB::statement('INSERT INTO categories
            // (parent_id , name , slug ,description,image)
            // values
            // (1,"Kids","kids",null,null)');
        
    }
}

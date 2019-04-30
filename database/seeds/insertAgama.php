<?php

use Illuminate\Database\Seeder;

class insertAgama extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$agama = ['Islam', 'Hindu', 'Budha', 'Kristen', 'Konghucu'];
		for($i=0; $i<count($agama); $i++){
			\App\Agama::create([
				'agama'  => $agama[$i]
			]);
		}
    }
}

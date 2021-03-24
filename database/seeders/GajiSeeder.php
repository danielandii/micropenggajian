<?php


namespace Database\Seeders;

use App\Models\gaji;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facedes\App;


class GajiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data = [
            'gaji_pokok' => '4.000.000',
            'tunjangan' => '1.000.000',
            'potongan' => '7.00.000',
            'rekening' => 'BCA-2938661933'
        ];

        gaji::create($data);
    }
}

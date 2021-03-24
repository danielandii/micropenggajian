<?php

namespace Database\Seeders;

use App\Models\histori_gaji;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facedes\App;

class HistoriGajiSeeder extends Seeder
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
            'user' => 'firman',
            'tanggal' => '02-November-2020',
            'gaji_pokok' => '4.000.000',
            'tunjangan' => '1.000.000',
            'potongan' => '7.00.000',
            'rekening' => 'BCA-2938661933'
        ];
    
        histori_gaji::create($data);
    }
}

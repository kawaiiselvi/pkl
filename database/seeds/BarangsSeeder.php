<?php

use Illuminate\Database\Seeder;
use App\Penanggung;
use App\Barang;
use App\User;
use App\BorrowLog;
use App\Kategori;

class BarangsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kat1 = Kategori::create(['nama'=>'Hardware']);
        $kat2 = Kategori::create(['nama'=>'Elektronik']);

        $penanggung1=Penanggung::create(['name'=>'Firman']);
        $penanggung2=Penanggung::create(['name'=>'Agung']);

        

        
    }
}

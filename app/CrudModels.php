<?php

namespace App;

use GuzzleHttp\Psr7\Request;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Model;

class CrudModels extends Model
{
    protected $table = 'crud';

    // mass assigment
    protected $guarded = ['id'];

    public function kode_urut()
    {
        // no registrasi otomatis dari sistem dan sifatnya unique

        $bulan = date('m');
        $tahun = date('y');
        $nama = "KODE-";
        $config = [
            'table' => 'crud',
            'length' => 8,
            'prefix' => 'UHO-'
        ];

        $id = IdGenerator::generate($config);
        // $kode = $nama . $bulan . "-" . $tahun . "-" . $id;
        return $id;
    }
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class DataBarangModel extends Model
{
    protected $table = 'tblbarang';
    protected $primaryKey = 'idBarang';
    protected $allowedFields = [
        'idBarang',
        'idJenis',
        'namaBarang',
        'harga',
        'hargaJual'
    ];
    protected $returnType = 'object';

    // Tambahan
    protected $column_order = ['idBarang', ' idJenis', 'namaBarang', 'harga', 'hargaJual'];
    protected $column_search = ['idBarang', ' idJenis', 'namaBarang', 'harga', 'hargaJual'];
    protected $order = ['idBarang' => 'DESC'];
    protected $request;
    protected $db;
    protected $dt;


    function kategoriDisplay($katakunci = null, $start = 0, $length = 0, $columns = NULL, $orders = NULL)
    {
        // $db = \Config\Database::connect();
        // $builder = $db->table('tblbarang');
        $builder = $this->db->table('tblbarang');
        $builder->join('tbljenis', 'tbljenis.idJenis =  tblbarang.idJenis');
        if ($katakunci) {
            $arr_katakunci = explode(" ", $katakunci);
            for ($x = 0; $x < count($arr_katakunci); $x++) {
                $builder = $builder->orLike('idBarang', $arr_katakunci[$x]);
                // $builder = $builder->orLike('idJenis', $arr_katakunci[$x]);
                $builder = $builder->orLike('namaBarang', $arr_katakunci[$x]);
                $builder = $builder->orLike('harga', $arr_katakunci[$x]);
            }
        }
        if ($start != 0 or $length != 0) {
            $builder = $builder->limit($length, $start);
        }
        if ($orders && $columns) {
            for ($i = 0; $i < count($orders); $i++) {
                $builder = $builder->orderBy($columns[$orders[$i]['column']]['data'], $orders[$i]['dir']);
            }
        }
        return $builder->get()->getResult();
    }
}

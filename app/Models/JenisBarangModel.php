<?php

namespace App\Models;

use CodeIgniter\Model;

class JenisBarangModel extends Model
{
    protected $table = 'tbljenis';
    protected $primaryKey = 'idJenis';
    protected $allowedFields = [
        'idJenis',
        'jenisBarang'
    ];
    protected $returnType = 'object';

    // Tambahan
    protected $column_order = ['idJenis', 'jenisBarang'];
    protected $column_search = ['idJenis', 'jenisBarang'];
    protected $order = ['idJenis' => 'DESC'];
    protected $request;
    protected $db;
    protected $dt;

    function kategoriDisplay($katakunci = null, $start = 0, $length = 0, $columns = NULL, $orders = NULL)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('tbljenis');
        if ($katakunci) {
            $arr_katakunci = explode(" ", $katakunci);
            for ($x = 0; $x < count($arr_katakunci); $x++) {
                $builder = $builder->orLike('idJenis', $arr_katakunci[$x]);
                $builder = $builder->orLike('jenisBarang', $arr_katakunci[$x]);
            }
        }
        if ($start != 0 or $length != 0) {
            $builder = $builder->limit($length, $start);
        }
        // $builder = $builder->where('username', session()->get('username'));
        if ($orders && $columns) {
            for ($i = 0; $i < count($orders); $i++) {
                $builder = $builder->orderBy($columns[$orders[$i]['column']]['data'], $orders[$i]['dir']);
            }
        }
        return $builder->get()->getResult();
    }
}

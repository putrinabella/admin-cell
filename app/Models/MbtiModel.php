<?php

namespace App\Models;

use CodeIgniter\Model;

class MbtiModel extends Model
{
    protected $table = 'tblmbti';
    protected $primaryKey = 'idPertanyaan';
    protected $allowedFields = [
        'idPertanyaan',
        'pertanyaan'
    ];
    protected $returnType = 'object';

    // Tambahan
    protected $column_order = ['idPertanyaan', 'pertanyaan'];
    protected $column_search = ['idPertanyaan', 'pertanyaan'];
    protected $order = ['idPertanyaan' => 'DESC'];
    protected $request;
    protected $db;
    protected $dt;

    function mbtiDisplay($katakunci = null, $start = 0, $length = 0, $columns = NULL, $orders = NULL)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('tblmbti');
        if ($katakunci) {
            $arr_katakunci = explode(" ", $katakunci);
            for ($x = 0; $x < count($arr_katakunci); $x++) {
                $builder = $builder->orLike('idPertanyaan', $arr_katakunci[$x]);
                $builder = $builder->orLike('pertanyaan', $arr_katakunci[$x]);
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

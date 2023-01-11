<?php

namespace App\Models;

use CodeIgniter\Model;

class OperatorModel extends Model
{
    protected $table = 'tbloperator';
    protected $primaryKey = 'idOperator';
    protected $allowedFields = [
        'idOperator',
        'namaOperator'
    ];
    protected $returnType = 'object';

    // Tambahan
    protected $column_order = ['idOperator', 'namaOperator'];
    protected $column_search = ['idOperator', 'namaOperator'];
    protected $order = ['idOperator' => 'DESC'];
    protected $request;
    protected $db;
    protected $dt;

    function kategoriDisplay($katakunci = null, $start = 0, $length = 0, $columns = NULL, $orders = NULL)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('tbloperator');
        if ($katakunci) {
            $arr_katakunci = explode(" ", $katakunci);
            for ($x = 0; $x < count($arr_katakunci); $x++) {
                $builder = $builder->orLike('idOperator', $arr_katakunci[$x]);
                $builder = $builder->orLike('namaOperator', $arr_katakunci[$x]);
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

    public function updateData($id, $data)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('tbloperator');
        $builder->where('idOperator', $id);
        // return $builder->update($data);
        return $builder->update([
            'namaOperator' => $data['namaOperator']
        ]);
    }
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiModel extends Model
{
    protected $table = 'tbltransaksipembelian';
    protected $primaryKey = 'idTransaksi';
    protected $allowedFields = [
        'idTransaksi',
        'nohp',
        'idOperator',
        'idPaket',
        'username'
    ];
    protected $returnType = 'object';

    // Tambahan
    protected $column_order = ['idTransaksi', ' nohp', 'idOperator', 'idPaket', 'username'];
    protected $column_search = ['idTransaksi', ' nohp', 'idOperator', 'idPaket', 'username'];
    protected $order = ['idTransaksi' => 'DESC'];
    protected $request;
    protected $db;
    protected $dt;


    function kategoriDisplay($katakunci = null, $start = 0, $length = 0, $columns = NULL, $orders = NULL)
    {
        $db = \Config\Database::connect();
        // $builder = $db->table('tbltransaksipembelian');

        $builder = $this->db->table('tbltransaksipembelian');

        $builder->join('tbloperator', 'tbloperator.idOperator =  tbltransaksipembelian.idOperator');
        $builder->join('tblpaket', 'tblpaket.idPaket =  tbltransaksipembelian.idPaket');
        $builder->join('tbluser', 'tbluser.username =  tbltransaksipembelian.username');

        if ($katakunci) {
            $arr_katakunci = explode(" ", $katakunci);
            for ($x = 0; $x < count($arr_katakunci); $x++) {
                $builder = $builder->orLike('idTransaksi', $arr_katakunci[$x]);
                $builder = $builder->orLike('nohp', $arr_katakunci[$x]);
                // $builder = $builder->orLike('idOperator', $arr_katakunci[$x]);
                // $builder = $builder->orLike('idPaket', $arr_katakunci[$x]);
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
        $builder = $db->table('tbltransaksipembelian');
        $builder->where('idTransaksi', $id);
        // return $builder->update($data);
        return $builder->update([
            'nohp' => $data['nohp'],
            'idOperator' => $data['idOperator'],
            'idPaket' => $data['idPaket']
        ]);
    }
}

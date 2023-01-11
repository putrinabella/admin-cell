<?php

namespace App\Models;

use CodeIgniter\Model;

class PaketModel extends Model
{
    protected $table = 'tblpaket';
    protected $primaryKey = 'idPaket';
    protected $allowedFields = [
        'idPaket',
        'idOperator',
        'namaPaket',
        'deskripsi',
        'harga',
        'hargaJual',
        'keuntungan'
    ];
    protected $returnType = 'object';

    // Tambahan
    protected $column_order = ['idPaket', ' idOperator', 'namaPaket', 'deskripsi', 'harga', 'hargaJual', 'keuntungan'];
    protected $column_search = ['idPaket', ' idOperator', 'namaPaket', 'deskripsi', 'harga', 'hargaJual', 'keuntungan'];
    protected $order = ['idPaket' => 'DESC'];
    protected $request;
    protected $db;
    protected $dt;


    function kategoriDisplay($katakunci = null, $start = 0, $length = 0, $columns = NULL, $orders = NULL)
    {
        // $db = \Config\Database::connect();
        // $builder = $db->table('tblpaket');
        $builder = $this->db->table('tblpaket');
        $builder->join('tbloperator', 'tbloperator.idOperator =  tblpaket.idOperator');
        if ($katakunci) {
            $arr_katakunci = explode(" ", $katakunci);
            for ($x = 0; $x < count($arr_katakunci); $x++) {
                $builder = $builder->orLike('idPaket', $arr_katakunci[$x]);
                // $builder = $builder->orLike('idOperator', $arr_katakunci[$x]);
                $builder = $builder->orLike('namaPaket', $arr_katakunci[$x]);
                $builder = $builder->orLike('harga', $arr_katakunci[$x]);
                $builder = $builder->orLike('hargaJual', $arr_katakunci[$x]);
                $builder = $builder->orLike('keuntungan', $arr_katakunci[$x]);
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
        $builder = $db->table('tblpaket');
        $builder->where('idPaket', $id);
        // return $builder->update($data);
        return $builder->update([

            'namaPaket' => $data['namaPaket'],
            'harga' => $data['harga'],
            'hargaJual' => $data['hargaJual'],
            'keuntungan' => $data['keuntungan']
        ]);
    }
}

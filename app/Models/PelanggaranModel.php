<?php

namespace App\Models;

use CodeIgniter\Model;

class PelanggaranModel extends Model
{
    protected $table = 'tblpelanggaran';
    protected $primaryKey = 'idPelanggaran';
    protected $allowedFields = [
        'idPelanggaran',
        'idPelaku',
        'bentukPelanggaran',
        'denda'
    ];
    protected $returnType = 'object';

    // Tambahan
    protected $column_order = ['idPelanggaran', ' idPelaku', 'bentukPelanggaran', 'denda'];
    protected $column_search = ['idPelanggaran', ' idPelaku', 'bentukPelanggaran', 'denda'];
    protected $order = ['idPelanggaran' => 'DESC'];
    protected $request;
    protected $db;
    protected $dt;


    // function getAll()
    // {
    //     $builder = $this->db->table('tblpelanggaran');
    //     $builder->join('tblpelaku', 'tblpelaku.idPelaku =  tblpelanggaran.idPelaku');
    //     $builder = $builder->get();
    //     return $builder->getResult();
    // }


    function kategoriDisplay($katakunci = null, $start = 0, $length = 0, $columns = NULL, $orders = NULL)
    {
        // $db = \Config\Database::connect();
        // $builder = $db->table('tblpelanggaran');
        $builder = $this->db->table('tblpelanggaran');
        $builder->join('tblpelaku', 'tblpelaku.idPelaku =  tblpelanggaran.idPelaku');
        if ($katakunci) {
            $arr_katakunci = explode(" ", $katakunci);
            for ($x = 0; $x < count($arr_katakunci); $x++) {
                $builder = $builder->orLike('idPelanggaran', $arr_katakunci[$x]);
                // $builder = $builder->orLike('idPelaku', $arr_katakunci[$x]);
                $builder = $builder->orLike('bentukPelanggaran', $arr_katakunci[$x]);
                $builder = $builder->orLike('denda', $arr_katakunci[$x]);
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

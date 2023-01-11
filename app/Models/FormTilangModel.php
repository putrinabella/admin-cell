<?php

namespace App\Models;

use CodeIgniter\Model;

class FormTilangModel extends Model
{
    protected $table = 'tblform';
    protected $primaryKey = 'idForm';
    protected $allowedFields = [
        'idForm',
        'namaPelanggar',
        'jenisId',
        'noId',
        'jenisKelamin',
        'noHp',
        'jenisKendaraan',
        'merek',
        'plat',
        'noRangka',
        'noMesin',
        'bentukPelanggaran',
        'denda',
        'foto'
    ];
    protected $returnType = 'object';

    // Tambahan
    protected $column_order = [
        'idForm', ' namaPelanggar', 'jenisId', 'noId', 'jenisKelamin', 'noHp', 'jenisKendaraan', 'merek', 'plat', 'noRangka', 'noMesin',
        'bentukPelanggaran', 'denda', 'foto'
    ];
    protected $column_search = [
        'idForm', ' namaPelanggar', 'jenisId', 'noId', 'jenisKelamin', 'noHp', 'jenisKendaraan', 'merek', 'plat', 'noRangka', 'noMesin',
        'bentukPelanggaran', 'denda', 'foto'
    ];
    protected $order = ['idForm' => 'DESC'];
    protected $request;
    protected $db;
    protected $dt;


    // function getAll()
    // {
    //     $builder = $this->db->table('tblform');
    //     $builder->join('tblpelaku', 'tblpelaku.namaPelanggar =  tblform.namaPelanggar');
    //     $builder = $builder->get();
    //     return $builder->getResult();
    // }


    function kategoriDisplay($katakunci = null, $start = 0, $length = 0, $columns = NULL, $orders = NULL)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('tblform');
        if ($katakunci) {
            $arr_katakunci = explode(" ", $katakunci);
            for ($x = 0; $x < count($arr_katakunci); $x++) {
                // $builder = $builder->orLike('username', $arr_katakunci[$x]);
                // $builder = $builder->orLike('password', $arr_katakunci[$x]);
                // $builder = $builder->orLike('nama', $arr_katakunci[$x]);
                // $builder = $builder->orLike('role', $arr_katakunci[$x]);
                $builder = $builder->orLike('namaPelanggar', $arr_katakunci[$x]);
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

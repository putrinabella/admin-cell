<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'tbluser';
    protected $primaryKey = 'username';
    protected $allowedFields = [
        'username',
        'password',
        'nama',
        'role'
    ];
    protected $returnType = 'object';

    // Tambahan
    protected $column_order = ['username', 'password', 'nama', 'role'];
    protected $column_search = ['username', 'password', 'nama', 'role'];
    protected $order = ['username' => 'DESC'];
    protected $request;
    protected $db;
    protected $dt;

    public function insertData($data)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('tbluser');
        return $builder->insert($data);
    }

    function userDisplay($katakunci = null, $start = 0, $length = 0, $columns = NULL, $orders = NULL)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('tbluser');
        if ($katakunci) {
            $arr_katakunci = explode(" ", $katakunci);
            for ($x = 0; $x < count($arr_katakunci); $x++) {
                $builder = $builder->orLike('username', $arr_katakunci[$x]);
                $builder = $builder->orLike('password', $arr_katakunci[$x]);
                $builder = $builder->orLike('nama', $arr_katakunci[$x]);
                $builder = $builder->orLike('role', $arr_katakunci[$x]);
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

    function kategoriDisplay($katakunci = null, $start = 0, $length = 0, $columns = NULL, $orders = NULL)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('tblkategori');
        if ($katakunci) {
            $arr_katakunci = explode(" ", $katakunci);
            for ($x = 0; $x < count($arr_katakunci); $x++) {
                $builder = $builder->orLike('idKategori', $arr_katakunci[$x]);
                $builder = $builder->orLike('namaKategori', $arr_katakunci[$x]);
                $builder = $builder->orLike('tglInput', $arr_katakunci[$x]);
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

    public function updateData($id, $data)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('tbluser');
        $builder->where('username', $id);
        // return $builder->update($data);
        return $builder->update([
            'role' => $data['role']
        ]);
    }

    // function searchAndDisplay2($katakunci = null, $start = 0, $length = 0)
    // {
    //     $db = \Config\Database::connect();
    //     $builder = $db->table('tbluser');
    //     if ($katakunci) {
    //         $arr_katakunci = explode(" ", $katakunci);
    //         for ($x = 0; $x < count($arr_katakunci); $x++) {
    //             $builder = $builder->orLike('username', $arr_katakunci[$x]);
    //             $builder = $builder->orLike('password', $arr_katakunci[$x]);
    //             $builder = $builder->orLike('nama', $arr_katakunci[$x]);
    //             $builder = $builder->orLike('role', $arr_katakunci[$x]);
    //         }
    //     }
    //     if ($start != 0 or $length != 0) {
    //         $builder = $builder->limit($length, $start);
    //     }
    //     return $builder->orderBy("username")->get()->getResult();
    // }


    // public function button()
    // {
    //     $action_button = function ($row) {
    //         return '
    // 			<button type="button" name="edit" class="btn btn-warning btn-sm edit" data-id="' . $row['username'] . '">Edit</button>
    // 			&nbsp;
    // 			<button type="button" class="btn btn-danger btn-sm delete" data-id="' . $row['username'] . '">Delete</button>
    // 			';
    //     };

    //     return $action_button;
    // }
}

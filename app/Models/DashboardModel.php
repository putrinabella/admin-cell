<?php

namespace App\Models;

use CodeIgniter\Model;
use LDAP\Result;

class DashboardModel extends Model
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
    protected $column_order = ['username', ' password', 'nama', 'role'];
    protected $column_search = ['username', ' password', 'nama', 'role'];
    protected $order = ['username' => 'DESC'];
    protected $request;
    protected $db;
    protected $dt;

    public function countUser()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('tbluser');
        $builder->like('role', 'User');
        return $builder->countAllResults();
    }

    public function countaAdmin()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('tbluser');
        $builder->like('role', 'Admin');
        return $builder->countAllResults();
    }

    public function countPemasukan()
    {
        $db = \Config\Database::connect();
        $builder = $this->db->table('tbltransaksipembelian');
        $builder->join('tblpaket', 'tblpaket.idPaket =  tbltransaksipembelian.idPaket');
        $builder->selectSum('hargaJual');
        $query = $builder->get();
        $result = $query->getRow();
        // return json_encode($result);
        $json = json_decode(json_encode($result), true);
        return $json['hargaJual'];
    }

    public function countPengeluaran()
    {
        $db = \Config\Database::connect();
        $builder = $this->db->table('tbltransaksipembelian');
        $builder->join('tblpaket', 'tblpaket.idPaket =  tbltransaksipembelian.idPaket');
        $builder->selectSum('harga');
        $query = $builder->get();
        $result = $query->getRow();
        $json = json_decode(json_encode($result), true);
        return $json['harga'];
    }

    public function countKeuntungan()
    {
        $db = \Config\Database::connect();
        $builder = $this->db->table('tbltransaksipembelian');
        $builder->join('tblpaket', 'tblpaket.idPaket =  tbltransaksipembelian.idPaket');
        $builder->selectSum('keuntungan');
        $query = $builder->get();
        $result = $query->getRow();
        $json = json_decode(json_encode($result), true);
        return $json['keuntungan'];
    }

    public function countTransaksi()
    {
        $db = \Config\Database::connect();
        $builder = $this->db->table('tbltransaksipembelian');
        return $builder->countAllResults();
    }
}

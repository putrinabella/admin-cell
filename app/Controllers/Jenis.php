<?php

namespace App\Controllers;

use App\Models\JenisBarangModel;
use App\Models\DataBarangModel;

class Jenis extends BaseController
{
    public $db;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->barangM = new DataBarangModel();
        $this->jenisM = new JenisBarangModel();
    }


    public function index()
    {;
        $data['jenisM'] = $this->jenisM->findAll();
        return view('home/dataBarang', $data);
    }


    public function data()
    {
        $params['draw'] = $_REQUEST['draw'];
        $start = $_REQUEST['start'];
        $length = $_REQUEST['length'];
        $search_value = $_REQUEST['search']['value'];
        $orders = $_REQUEST['order'];
        $columns = $_REQUEST['columns'];

        $dataKategori = new DataBarangModel();
        $data = $dataKategori->kategoriDisplay($search_value, $start, $length, $columns, $orders);
        $total_count = $dataKategori->kategoriDisplay($search_value);

        $json_data = array(
            'draw' => intval($params['draw']),
            'recordsTotal' => count($total_count),
            'recordsFiltered' => count($total_count),
            'data' => $data
        );
        echo json_encode($json_data);
    }

    function hapusData()
    {
        $id_delete = $this->request->getPost('id');
        $load = new DataBarangModel();
        $delete = $load->where('idBarang', $id_delete)->delete();
        $res["status"] = false;
        $res["msg"] = "Gagal dihapus";
        if ($delete) {
            $res["status"] = true;
            $res["msg"] = "Berhasil dihapus";
        }
        echo json_encode($res);
    }

    function simpan()
    {
        $post = $this->request->getPost();
        $load = new DataBarangModel();
        $dataload = $load->find($post["idBarang"]);

        if ($dataload == NULL) {
            // load tidak ditemukan
            $simpan = $load->insert($post, false);
            if ($simpan) {
                $res["status"] = true;
                $res["msg"] = "Berhasil ditambahakan";
            } else {
                $res["status"] = false;
                $res["msg"] = "Gagal menambahkan";
            }
            // return view('login/index', $data);   
        } else {
            $res["status"] = false;
            $res["msg"] = "ID sudah digunakan";
        }
        echo json_encode($res);
    }
}

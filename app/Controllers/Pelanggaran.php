<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

use App\Models\PelakuModel;
use App\Models\PelanggaranModel;

class Pelanggaran extends BaseController
{
    public $db;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        // $this->pelanggaranM = new PelanggaranModel();
        $this->pelakuM = new PelakuModel();
    }

    public function jenispelanggaran()
    {
        return view('pelanggaran/jenisPelanggaran');
    }

    public function index()
    {
        // $data['pelanggaranM'] = $this->pelanggaranM->getAll();
        // return view('home/jenisPelanggaran', $data);
        $data['pelakuM'] = $this->pelakuM->findAll();
        return view('home/jenisPelanggaran', $data);
    }
    // public function new()
    // {
    //     $data['pelakuM'] = $this->pelakuM->findAll();
    //     return view('home/jenisPelanggaran', $data);
    // }

    public function datajenispelanggaran()
    {
        $params['draw'] = $_REQUEST['draw'];
        $start = $_REQUEST['start'];
        $length = $_REQUEST['length'];
        $search_value = $_REQUEST['search']['value'];
        $orders = $_REQUEST['order'];
        $columns = $_REQUEST['columns'];

        $dataKategori = new PelanggaranModel();
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

    function hapusjenispelanggaran()
    {
        $id_delete = $this->request->getPost('id');
        $load = new PelanggaranModel();
        $delete = $load->where('idPelanggaran', $id_delete)->delete();
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
        $load = new PelanggaranModel();
        $dataload = $load->find($post["idPelanggaran"]);

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

<?php

namespace App\Controllers;

use App\Models\JenisBarangModel;
use App\Models\DataBarangModel;


class Barang extends BaseController
{
    public $db;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->jenisM = new JenisBarangModel();
        $this->barangM = new DataBarangModel();
    }


    // public function jenispelanggaran()
    // {
    //     return view('pelanggaran/jenisPelanggaran');
    // }

    public function index()
    {
        $data['jenisM'] = $this->jenisM->findAll();
        return view('home/jenisPelanggaran', $data);
    }



    public function datajenis()
    {
        $params['draw'] = $_REQUEST['draw'];
        $start = $_REQUEST['start'];
        $length = $_REQUEST['length'];
        $search_value = $_REQUEST['search']['value'];
        $orders = $_REQUEST['order'];
        $columns = $_REQUEST['columns'];

        $dataKategori = new JenisBarangModel();
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

    function hapusJenis()
    {
        $id_delete = $this->request->getPost('id');
        $user = new JenisBarangModel();
        $delete = $user->where('idJenis', $id_delete)->delete();
        $res["status"] = false;
        $res["msg"] = "Gagal dihapus";
        if ($delete) {
            $res["status"] = true;
            $res["msg"] = "Berhasil dihapus";
        }
        echo json_encode($res);
    }

    function simpanJenis()
    {
        $post = $this->request->getPost();
        $user = new JenisBarangModel();
        $dataUser = $user->find($post["idJenis"]);

        if ($dataUser == NULL) {
            $simpan = $user->insert($post, false);
            if ($simpan) {
                $res["status"] = true;
                $res["msg"] = "Berhasil ditambahakan";
            } else {
                $res["status"] = false;
                $res["msg"] = "Gagal menambahkan";
            }
        } else {
            $res["status"] = false;
            $res["msg"] = "ID sudah digunakan";
        }
        echo json_encode($res);
    }

    public function databarang()
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

    function hapusBarang()
    {
        $id_delete = $this->request->getPost('id');
        $user = new DataBarangModel();
        $delete = $user->where('idBarang', $id_delete)->delete();
        $res["status"] = false;
        $res["msg"] = "Gagal dihapus";
        if ($delete) {
            $res["status"] = true;
            $res["msg"] = "Berhasil dihapus";
        }
        echo json_encode($res);
    }

    function simpanBarang()
    {
        $post = $this->request->getPost();
        $user = new DataBarangModel();
        $dataUser = $user->find($post["idBarang"]);

        if ($dataUser == NULL) {
            $simpan = $user->insert($post, false);
            if ($simpan) {
                $res["status"] = true;
                $res["msg"] = "Berhasil ditambahakan";
            } else {
                $res["status"] = false;
                $res["msg"] = "Gagal menambahkan";
            }
        } else {
            $res["status"] = false;
            $res["msg"] = "ID sudah digunakan";
        }
        echo json_encode($res);
    }
}

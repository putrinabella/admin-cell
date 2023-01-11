<?php

namespace App\Controllers;


use App\Models\FormTilangModel;
use App\Models\PelanggaranModel;

class Form extends BaseController
{
    public $db;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->FormM = new FormTilangModel();
        $this->pelanggaranM = new PelanggaranModel();
    }

    public function formPelanggaran()
    {
        return view('form/formTilang');
    }

    public function index()
    {
        $data['pelanggaranM'] = $this->pelanggaranM->findAll();
        return view('home/formTilang', $data);
    }
    public function dataform()
    {
        $params['draw'] = $_REQUEST['draw'];
        $start = $_REQUEST['start'];
        $length = $_REQUEST['length'];
        $search_value = $_REQUEST['search']['value'];
        $orders = $_REQUEST['order'];
        $columns = $_REQUEST['columns'];

        $dataKategori = new FormTilangModel();
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

    function hapusform()
    {
        $id_delete = $this->request->getPost('id');
        $user = new FormTilangModel();
        $delete = $user->where('idForm', $id_delete)->delete();
        $res["status"] = false;
        $res["msg"] = "Gagal dihapus";
        if ($delete) {
            $res["status"] = true;
            $res["msg"] = "Berhasil dihapus";
        }
        echo json_encode($res);
    }

    function simpanform()
    {
        $post = $this->request->getPost();
        // $post["password"]=md5($post["password"]);
        $user = new FormTilangModel();
        $dataUser = $user->find($post["idForm"]);

        if ($dataUser == NULL) {
            // User tidak ditemukan
            $simpan = $user->insert($post, false);
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
            $res["msg"] = "Username sudah ada";
        }
        echo json_encode($res);
    }

    // public function dataAjax()
    // {
    //     $params['draw'] = $_REQUEST['draw'];
    //     $search_value = $_REQUEST['search']['value'];
    //     $denda = new FormTilangModel();
    //     $data = $denda->autofill($search_value);

    //     $json_data = array(
    //         'draw' => intval($params['draw']),
    //         'data' => $data
    //     );
    //     echo json_encode($json_data);
    // }


    // public function save()
    // {
    //     dd($this->request->getPost());
    // }

    public function pelaku()
    {
        $data['pelakuM'] = $this->pelakuM->findAll();
        return view('home/formTilang', $data);
    }
}

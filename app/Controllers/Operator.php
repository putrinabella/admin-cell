<?php

namespace App\Controllers;

use App\Models\OperatorModel;
use App\Models\PaketModel;

class Operator extends BaseController
{
    public $db;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->operatorM = new OperatorModel();
    }


    public function index()
    {
        $data['operatorM'] = $this->operatorM->findAll();
        return view('home/paketView', $data);
    }
    public function foruser()
    {
        $data['operatorM'] = $this->operatorM->findAll();
        return view('home/paketViewUser', $data);
    }

    public function data()
    {
        $params['draw'] = $_REQUEST['draw'];
        $start = $_REQUEST['start'];
        $length = $_REQUEST['length'];
        $search_value = $_REQUEST['search']['value'];
        $orders = $_REQUEST['order'];
        $columns = $_REQUEST['columns'];

        $dataKategori = new OperatorModel();
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

    function hapus()
    {
        $id_delete = $this->request->getPost('id');
        $load = new OperatorModel();
        $delete = $load->where('idOperator', $id_delete)->delete();
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
        $load = new OperatorModel();
        $dataload = $load->find($post["idOperator"]);

        if ($dataload == NULL) {
            $simpan = $load->insert($post, false);
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

    public function update($id)
    {
        $post = $this->request->getPost();
        $opM = new OperatorModel();
        $opM->updateData($id, $post);
        $rows = $this->db->affectedRows();
        if ($rows > 0) {
            $res["status"] = true;
            $res["msg"] = "Berhasil update";
        } else {
            $res["status"] = false;
            $res["msg"] = "Gagal update";
        }
        echo json_encode($res);
    }

    public function dataPaket()
    {
        $params['draw'] = $_REQUEST['draw'];
        $start = $_REQUEST['start'];
        $length = $_REQUEST['length'];
        $search_value = $_REQUEST['search']['value'];
        $orders = $_REQUEST['order'];
        $columns = $_REQUEST['columns'];

        $dataKategori = new PaketModel();
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

    function hapusPaket()
    {
        $id_delete = $this->request->getPost('id');
        $load = new PaketModel();
        $delete = $load->where('idPaket', $id_delete)->delete();
        $res["status"] = false;
        $res["msg"] = "Gagal dihapus";
        if ($delete) {
            $res["status"] = true;
            $res["msg"] = "Berhasil dihapus";
        }
        echo json_encode($res);
    }

    function simpanPaket()
    {
        $post = $this->request->getPost();
        $load = new PaketModel();
        $dataload = $load->find($post["idPaket"]);

        if ($dataload == NULL) {
            $simpan = $load->insert($post, false);
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

    public function updatePaket($id)
    {
        $post = $this->request->getPost();
        $opM = new PaketModel();
        $opM->updateData($id, $post);
        $rows = $this->db->affectedRows();
        if ($rows > 0) {
            $res["status"] = true;
            $res["msg"] = "Berhasil update";
        } else {
            $res["status"] = false;
            $res["msg"] = "Gagal update";
        }
        echo json_encode($res);
    }
}

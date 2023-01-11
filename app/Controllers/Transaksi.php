<?php

namespace App\Controllers;

use App\Models\OperatorModel;
use App\Models\PaketModel;
use App\Models\TransaksiModel;
use App\Models\TransaksiModelUser;

class Transaksi extends BaseController
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
        return view('home/transaksiView', $data);
    }

    public function database()
    {
        $data['operatorM'] = $this->operatorM->findAll();
        return view('home/dataTransaksiView', $data);
    }

    public function databaseUser()
    {
        $data['operatorM'] = $this->operatorM->findAll();
        return view('home/dataTransaksiViewUser', $data);
    }

    public function data()
    {
        $params['draw'] = $_REQUEST['draw'];
        $start = $_REQUEST['start'];
        $length = $_REQUEST['length'];
        $search_value = $_REQUEST['search']['value'];
        $orders = $_REQUEST['order'];
        $columns = $_REQUEST['columns'];

        $dataKategori = new TransaksiModel();
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

    public function dataUser()
    {
        $params['draw'] = $_REQUEST['draw'];
        $start = $_REQUEST['start'];
        $length = $_REQUEST['length'];
        $search_value = $_REQUEST['search']['value'];
        $orders = $_REQUEST['order'];
        $columns = $_REQUEST['columns'];

        $dataKategori = new TransaksiModelUser();
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
        $load = new TransaksiModel();
        $delete = $load->where('idTransaksi', $id_delete)->delete();
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
        $load = new TransaksiModel();
        $dataload = $load->find($post["idTransaksi"]);
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

    function simpandata()
    {
        $post = $this->request->getPost();
        $load = new TransaksiModel();
        $dataload = $load->find($post["idTransaksi"]);
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
        $opM = new TransaksiModel();
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


    public function loadPaket()
    {
        $dataPaket = new PaketModel();
        $idOperator = $this->request->getVar('idOperator');

        $paketload = $dataPaket->select('idPaket, namaPaket')->where(
            'idOperator',
            $idOperator
        )->orderBy('namaPaket')->findAll();
        $data = [];
        foreach ($paketload as $value) {
            $data[] = [
                'id' => $value->idPaket,
                'text' => $value->namaPaket
            ];
        }
        $response['data'] = $data;

        return $this->response->setJSON($response);
    }
}

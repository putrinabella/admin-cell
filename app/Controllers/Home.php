<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\KategoriModel;
use App\Models\MbtiModel;
use App\Models\PelakuModel;
use App\Models\PelanggaranModel;
use App\Models\DashboardModel;
use App\Models\DashboardModelUser;

class Home extends BaseController
{
    public $db;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->dashM = new DashboardModel();
        $this->dashU = new DashboardModelUser();
    }

    public function index()
    {
        $session = session();
        if ($session->get('role') == NULL) {
            return redirect()->to(base_url("public/Login"));
        }

        if ($session->get('role') == "Admin") {
            $data['countAdmin'] = $this->dashM->countaAdmin();
            $data['countUser'] = $this->dashM->countUser();
            $data['countPemasukan'] = $this->dashM->countPemasukan();
            $data['countPengeluaran'] = $this->dashM->countPengeluaran();
            $data['countKeuntungan'] = $this->dashM->countKeuntungan();
            $data['countTransaksi'] = $this->dashM->countTransaksi();
            return view('home/index', $data);
        } else if ($session->get('role') == "User") {
            $data['countPemasukan'] = $this->dashU->countPemasukan();
            $data['countPengeluaran'] = $this->dashU->countPengeluaran();
            $data['countKeuntungan'] = $this->dashU->countKeuntungan();
            $data['countTransaksi'] = $this->dashU->countTransaksi();
            return view('home/dashboardUser', $data);
        }
    }

    public function datauser()
    {
        return view('home/manajemenUserView');
    }

    public function jenisview()
    {
        return view('home/jenisBarang');
    }

    public function barangview()
    {
        return view('home/dataBarang');
    }

    public function namaoperator()
    {
        return view('home/operatorview');
    }

    public function formtransaksi()
    {
        return view('home/formTransaksiView');
    }


    public function mbti()
    {
        return view('home/mbti');
    }

    public function kategori()
    {
        return view('home/kategori');
    }

    public function kategoripelanggar()
    {
        return view('home/kategoriPelaku');
    }
    public function jenispelanggaran()
    {
        return view('home/jenisPelanggaran');
    }

    public function formtilang()
    {
        return view('home/formatTilang');
    }

    public function databaseform()
    {
        return view('home/database');
    }

    public function dataAjax()
    {
        $params['draw'] = $_REQUEST['draw'];
        $start = $_REQUEST['start'];
        $length = $_REQUEST['length'];
        $search_value = $_REQUEST['search']['value'];
        $orders = $_REQUEST['order'];
        $columns = $_REQUEST['columns'];

        $dataUser = new UserModel();
        $data = $dataUser->userDisplay($search_value, $start, $length, $columns, $orders);
        $total_count = $dataUser->userDisplay($search_value);

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
        $user = new UserModel();
        $delete = $user->where('username', $id_delete)->delete();
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
        // $post["password"]=md5($post["password"]);
        $user = new UserModel();
        $dataUser = $user->find($post["username"]);

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


    public function update($id)
    {
        $post = $this->request->getPost();
        $opM = new UserModel();
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

    // public function mydash()
    // {
    //     $data['countaAdmin'] = $this->dashM->countaAdmin();
    //     $data['countUser'] = $this->dashM->countUser();
    //     return view('home/index', $data);
    // }

    public function dataKategori()
    {
        $params['draw'] = $_REQUEST['draw'];
        $start = $_REQUEST['start'];
        $length = $_REQUEST['length'];
        $search_value = $_REQUEST['search']['value'];
        $orders = $_REQUEST['order'];
        $columns = $_REQUEST['columns'];

        $dataKategori = new KategoriModel();
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

    function hapusKategori()
    {
        $id_delete = $this->request->getPost('id');
        $user = new KategoriModel();
        $delete = $user->where('idKategori', $id_delete)->delete();
        $res["status"] = false;
        $res["msg"] = "Gagal dihapus";
        if ($delete) {
            $res["status"] = true;
            $res["msg"] = "Berhasil dihapus";
        }
        echo json_encode($res);
    }

    function simpanKategori()
    {
        $post = $this->request->getPost();
        // $post["password"]=md5($post["password"]);
        $user = new KategoriModel();
        $dataUser = $user->find($post["idKategori"]);

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
            $res["msg"] = "ID sudah digunakan";
        }
        echo json_encode($res);
    }

    public function dataKategoripelanggar()
    {
        $params['draw'] = $_REQUEST['draw'];
        $start = $_REQUEST['start'];
        $length = $_REQUEST['length'];
        $search_value = $_REQUEST['search']['value'];
        $orders = $_REQUEST['order'];
        $columns = $_REQUEST['columns'];

        $dataKategori = new PelakuModel();
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

    function hapusKategoriPelanggar()
    {
        $id_delete = $this->request->getPost('id');
        $user = new PelakuModel();
        $delete = $user->where('idPelaku', $id_delete)->delete();
        $res["status"] = false;
        $res["msg"] = "Gagal dihapus";
        if ($delete) {
            $res["status"] = true;
            $res["msg"] = "Berhasil dihapus";
        }
        echo json_encode($res);
    }

    function simpanKategoriPelanggar()
    {
        $post = $this->request->getPost();
        // $post["password"]=md5($post["password"]);
        $user = new PelakuModel();
        $dataUser = $user->find($post["idPelaku"]);

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
            $res["msg"] = "ID sudah digunakan";
        }
        echo json_encode($res);
    }


    public function datajenispelanggaran()
    {
        $params['draw'] = $_REQUEST['draw'];
        $start = $_REQUEST['start'];
        $length = $_REQUEST['length'];
        $search_value = $_REQUEST['search']['value'];
        $orders = $_REQUEST['order'];
        $columns = $_REQUEST['columns'];

        $dataKategori = new PelanggaranModel();
        $data = $dataKategori->getAll($search_value, $start, $length, $columns, $orders);
        $total_count = $dataKategori->getAll($search_value);

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
        $user = new PelanggaranModel();
        $delete = $user->where('idPelanggaran', $id_delete)->delete();
        $res["status"] = false;
        $res["msg"] = "Gagal dihapus";
        if ($delete) {
            $res["status"] = true;
            $res["msg"] = "Berhasil dihapus";
        }
        echo json_encode($res);
    }

    function simpanjenispelanggaran()
    {
        $post = $this->request->getPost();
        // $post["password"]=md5($post["password"]);
        $user = new PelakuModel();
        $dataUser = $user->find($post["idPelanggaran"]);

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
            $res["msg"] = "ID sudah digunakan";
        }
        echo json_encode($res);
    }

    public function dataMbti()
    {
        $params['draw'] = $_REQUEST['draw'];
        $start = $_REQUEST['start'];
        $length = $_REQUEST['length'];
        $search_value = $_REQUEST['search']['value'];
        $orders = $_REQUEST['order'];
        $columns = $_REQUEST['columns'];

        $dataMbti = new MbtiModel();
        $data = $dataMbti->mbtiDisplay($search_value, $start, $length, $columns, $orders);
        $total_count = $dataMbti->mbtiDisplay($search_value);

        $json_data = array(
            'draw' => intval($params['draw']),
            'recordsTotal' => count($total_count),
            'recordsFiltered' => count($total_count),
            'data' => $data
        );
        echo json_encode($json_data);
    }

    function hapusmbti()
    {
        $id_delete = $this->request->getPost('id');
        $user = new MbtiModel();
        $delete = $user->where('idPertanyaan', $id_delete)->delete();
        $res["status"] = false;
        $res["msg"] = "Gagal dihapus";
        if ($delete) {
            $res["status"] = true;
            $res["msg"] = "Berhasil dihapus";
        }
        echo json_encode($res);
    }

    function simpanmbti()
    {
        $post = $this->request->getPost();
        // $post["password"]=md5($post["password"]);
        $user = new MbtiModel();
        $dataUser = $user->find($post["idPertanyaan"]);

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
}

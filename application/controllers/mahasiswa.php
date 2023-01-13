<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';
use Restserver\Libraries\REST_Controller;

class Mahasiswa extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    //Menampilkan data mahasiswa
    function index_get() {
        $id = $this->get('id_mahasiswa');
        if ($id == '') {
            $mahasiswa = $this->db->get('mahasiswa')->result();
        } else {
            $this->db->where('id_mahasiswa', $id);
            $mahasiswa = $this->db->get('mahasiswa')->result();
        }
        $this->response($mahasiswa, 200);
    }


    //Masukan function selanjutnya disini

    //Mengirim atau menambah data mahasiswa baru
    function index_post() {
        $data = array(
                    'id_mahasiswa'           => $this->post('id_mahasiswa'),
                    'nama'          => $this->post('nama'),
                    'npm'    => $this->post('npm'),
                    'jurusan'    => $this->post('jurusan'));
        $insert = $this->db->insert('mahasiswa', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
    
    //Masukan function selanjutnya disini

     //Memperbarui data mahasiswa yang telah ada
     function index_put() {
        $id = $this->put('id_mahasiswa');
        $data = array(
                    'id_mahasiswa'       => $this->put('id_mahasiswa'),
                    'nama'          => $this->put('nama'),
                    'npm'    => $this->put('npm'),
                    'jurusan'    => $this->put('jurusan'));
        $this->db->where('id_mahasiswa', $id);
        $update = $this->db->update('mahasiswa', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
    
    //Masukan function selanjutnya disini

        //Menghapus salah satu data mahasiswa
        function index_delete() {
            $id = $this->delete('id_mahasiswa');
            $this->db->where('id_mahasiswa', $id);
            $delete = $this->db->delete('mahasiswa');
            if ($delete) {
                $this->response(array('status' => 'success'), 201);
            } else {
                $this->response(array('status' => 'fail', 502));
            }
        }
}
?>
<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

use Restserver\Libraries\REST_Controller;

class Bimbingan extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    //Menampilkan data kontak
    function index_get() {
        $id = $this->get('id_bimbingan');
        if ($id == '') {
            $kontak = $this->db->get('bimbingan')->result();
        } else {
            $this->db->where('id_bimbingan', $id);
            $kontak = $this->db->get('bimbingan')->result();
        }
        $this->response($kontak, 200);
    }


    //Masukan function selanjutnya disini

    //Mengirim atau menambah data kontak baru
    function index_post() {
        $data = array(
                    'id_bimbingan'           => $this->post('id_bimbingan'),
                    'id_mahasiswa'          => $this->post('id_mahasiswa'),
                    'id_mentor'    => $this->post('id_mentor'),
                    'id_topik'    => $this->post('id_topik'),
                    'waktu'    => $this->post('waktu'));
        $insert = $this->db->insert('bimbingan', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
    
    //Masukan function selanjutnya disini

     //Memperbarui data kontak yang telah ada
     function index_put() {
        $id = $this->put('id_bimbingan');
        $data = array(
                    'id_bimbingan'       => $this->put('id_bimbingan'),
                    'id_mahasiswa'          => $this->put('id_mahasiswa'),
                    'id_mentor'    => $this->put('id_mentor'),
                    'id_topik'    => $this->put('id_topik'),
                    'waktu'    => $this->put('waktu'));
        $this->db->where('id_bimbingan', $id);
        $update = $this->db->update('bimbingan', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
    
    //Masukan function selanjutnya disini

        //Menghapus salah satu data kontak
        function index_delete() {
            $id = $this->delete('id_bimbingan');
            $this->db->where('id_bimbingan', $id);
            $delete = $this->db->delete('bimbingan');
            if ($delete) {
                $this->response(array('status' => 'success'), 201);
            } else {
                $this->response(array('status' => 'fail', 502));
            }
        }
}
?>
<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

use Restserver\Libraries\REST_Controller;

class Topik extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    //Menampilkan data kontak
    function index_get() {
        $id = $this->get('id_topik');
        if ($id == '') {
            $kontak = $this->db->get('topik')->result();
        } else {
            $this->db->where('id_topik', $id);
            $kontak = $this->db->get('topik')->result();
        }
        $this->response($kontak, 200);
    }


    //Masukan function selanjutnya disini

    //Mengirim atau menambah data kontak baru
    function index_post() {
        $data = array(
                    'id_topik'           => $this->post('id_topik'),
                    'judul'          => $this->post('judul'),
                    'keterangan'    => $this->post('keterangan'));
        $insert = $this->db->insert('topik', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
    
    //Masukan function selanjutnya disini

     //Memperbarui data kontak yang telah ada
     function index_put() {
        $id = $this->put('id_topik');
        $data = array(
                    'id_topik'       => $this->put('id_topik'),
                    'judul'          => $this->put('judul'),
                    'keterangan'    => $this->put('keterangan'));
        $this->db->where('id_topik', $id);
        $update = $this->db->update('topik', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
    
    //Masukan function selanjutnya disini

        //Menghapus salah satu data kontak
        function index_delete() {
            $id = $this->delete('id_topik');
            $this->db->where('id_topik', $id);
            $delete = $this->db->delete('topik');
            if ($delete) {
                $this->response(array('status' => 'success'), 201);
            } else {
                $this->response(array('status' => 'fail', 502));
            }
        }
}
?>
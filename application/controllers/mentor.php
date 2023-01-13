<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

use Restserver\Libraries\REST_Controller;

class Mentor extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    //Menampilkan data kontak
    function index_get() {
        $id = $this->get('id_mentor');
        if ($id == '') {
            $kontak = $this->db->get('mentor')->result();
        } else {
            $this->db->where('id_mentor', $id);
            $kontak = $this->db->get('mentor')->result();
        }
        $this->response($kontak, 200);
    }


    //Masukan function selanjutnya disini

    //Mengirim atau menambah data kontak baru
    function index_post() {
        $data = array(
                    'id_mentor'           => $this->post('id_mentor'),
                    'nama'          => $this->post('nama'),
                    'nip'    => $this->post('nip'));
        $insert = $this->db->insert('mentor', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
    
    //Masukan function selanjutnya disini

     //Memperbarui data kontak yang telah ada
     function index_put() {
        $id = $this->put('id_mentor');
        $data = array(
                    'id_mentor'       => $this->put('id_mentor'),
                    'nama'          => $this->put('nama'),
                    'nip'    => $this->put('nip'));
        $this->db->where('id_mentor', $id);
        $update = $this->db->update('mentor', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
    
    //Masukan function selanjutnya disini

        //Menghapus salah satu data kontak
        function index_delete() {
            $id = $this->delete('id_mentor');
            $this->db->where('id_mentor', $id);
            $delete = $this->db->delete('mentor');
            if ($delete) {
                $this->response(array('status' => 'success'), 201);
            } else {
                $this->response(array('status' => 'fail', 502));
            }
        }
}
?>
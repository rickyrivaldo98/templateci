<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_input extends CI_Model
{

    public $id_data;
    // fungsi untuk menginput data ke database
    function insert_data($data, $table)
    {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }

    // fungsi untuk mengedit data
    function edit_data($where, $table)
    {
        return $this->db->get_where($table, $where);
    }
    // fungsi untuk mengupdate atau mengubah data di database
    function update_data($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }
    // fungsi untuk menghapus data dari database
    function delete_data($where, $table)
    {
        $this->db->delete($table, $where);
    }

    function delete_all($table)
    {
        $this->db->empty_table($table);
    }

    function cek_login($table, $where)
    {
        return $this->db->get_where($table, $where);
    }
    function insert_multiple($data, $table)
    {
        $this->db->insert_batch($table, $data);
    }


    function insert_input($judul)
    {
        $this->id = $this->input->post('id');
        $isi = $this->input->post('isi');
        $this->id_data = uniqid();
        $this->thumbnail = $this->_uploadThumbnail();
        $data = array(
            'id' => $this->id,
            'judul'    => $judul,
            'isi' => $isi,
            'gambar' => $this->thumbnail,
        );
        $this->db->insert('input', $data);
    }

    function edit_input($judul, $id)
    {
        $this->db->where('id', $id);
        $this->isi = $this->input->post('isi');
        $this->id_data = $this->input->post('old_data');
        // $thumbnail = $_FILES["thumbnail"]["name"];
        if (!empty($_FILES["gambar"]["name"])) {
            $this->thumbnail = $this->_uploadThumbnail();
        } else {
            $this->thumbnail = $this->input->post('old_data');
        };
        $data = array(
            'judul'    => $judul,
            'isi' => $this->isi,
            'gambar' => $this->thumbnail,
        );
        $this->db->update('input', $data);
    }

    public function _uploadThumbnail()
    {
        $field_name                     = "gambar";
        $nmfile                          = $this->id_data;
        $config['upload_path']          = './assets/img/';
        $config['allowed_types']        = 'jpg|jpeg|png';
        $config['file_name']            = $nmfile;
        $config['overwrite']             = TRUE;
        // $config['encrypt_name']            = true;
        $config['max_size']             = 2048; // 1MB
        $this->upload->initialize($config);

        $this->load->library('upload', $config);


        if (!$this->upload->do_upload($field_name)) {
            $error = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata('error', $error['error']);
            redirect('Page', 'refresh');
        } else {
            $gbr = $this->upload->data();
            $result  = array('gambar' => $gbr);
            $dfile   = $result['gambar']['file_name'];

            $config['image_library'] = 'gd2';
            $config['source_image'] = './assets/img/' . $dfile;
            $config['create_thumb'] = FALSE;
            $config['maintain_ratio'] = TRUE;
            $config['quality'] = '60%';
            $config['width'] = 800;
            $config['height'] = 800;
            $config['new_image'] = './assets/img/' . $dfile;
            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
            return $dfile;
        }
    }

    function get_input_by_id($id)
    {
        $query = $this->db->get_where('input', array('id' =>  $id));
        return $query;
    }

    //ini untuk admin nampilin semua artikel sesuai siapa yg bikin
    function get_all_data()
    {
        $this->db->select('*');
        $this->db->from('input');
        $this->db->order_by('id', 'desc');
        $query = $this->db->get();
        return $query->result();
    }

    function delete_input($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('input');
    }
}

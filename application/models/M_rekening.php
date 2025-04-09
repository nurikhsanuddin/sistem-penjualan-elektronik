<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_rekening extends CI_Model
{
    public function get_all_data()
    {
        return $this->db->get('tbl_rekening')->result();
    }

    public function get_data($id_rekening)
    {
        return $this->db->get_where('tbl_rekening', ['id_rekening' => $id_rekening])->row();
    }

    public function add($data)
    {
        $this->db->insert('tbl_rekening', $data);
    }

    public function edit($data)
    {
        $this->db->where('id_rekening', $data['id_rekening']);
        $this->db->update('tbl_rekening', $data);
    }

    public function delete($id_rekening)
    {
        $this->db->where('id_rekening', $id_rekening);
        $this->db->delete('tbl_rekening');
    }
}

<?php


defined('BASEPATH') or exit('No direct script access allowed');

class M_setting extends CI_Model
{

    public function get_all_data()
    {
        $this->db->select('*');
        $this->db->from('tbl_setting');
        $this->db->order_by('id', 'desc');
        return $this->db->get()->result();
    }

    public function get_setting()
    {
        $this->db->select('*');
        $this->db->from('tbl_setting');
        $this->db->where('id', 1);
        return $this->db->get()->row();
    }

}

/* End of file M_.php */

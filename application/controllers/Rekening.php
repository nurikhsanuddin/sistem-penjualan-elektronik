<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rekening extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_rekening');
    }

    public function index()
    {
        $data = array(
            'title' => 'Data Rekening',
            'rekening' => $this->m_rekening->get_all_data(),
            'isi' => 'rekening/v_rekening'
        );
        $this->load->view('layout/v_wrapper_backend', $data);
    }

    public function add()
    {
        $this->form_validation->set_rules('nama_bank', 'Nama Bank', 'required');
        $this->form_validation->set_rules('no_rek', 'Nomor Rekening', 'required');
        $this->form_validation->set_rules('atas_nama', 'Atas Nama', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'title' => 'Add Rekening',
                'isi' => 'rekening/v_add'
            );
            $this->load->view('layout/v_wrapper_backend', $data);
        } else {
            $data = array(
                'nama_bank' => $this->input->post('nama_bank'),
                'no_rek' => $this->input->post('no_rek'),
                'atas_nama' => $this->input->post('atas_nama')
            );
            $this->m_rekening->add($data);
            $this->session->set_flashdata('pesan', 'Data berhasil ditambahkan!');
            redirect('rekening');
        }
    }

    public function edit($id_rekening)
    {
        $this->form_validation->set_rules('nama_bank', 'Nama Bank', 'required');
        $this->form_validation->set_rules('no_rek', 'Nomor Rekening', 'required');
        $this->form_validation->set_rules('atas_nama', 'Atas Nama', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'title' => 'Edit Rekening',
                'rekening' => $this->m_rekening->get_data($id_rekening),
                'isi' => 'rekening/v_edit'
            );
            $this->load->view('layout/v_wrapper_backend', $data);
        } else {
            $data = array(
                'id_rekening' => $id_rekening,
                'nama_bank' => $this->input->post('nama_bank'),
                'no_rek' => $this->input->post('no_rek'),
                'atas_nama' => $this->input->post('atas_nama')
            );
            $this->m_rekening->edit($data);
            $this->session->set_flashdata('pesan', 'Data berhasil diupdate!');
            redirect('rekening');
        }
    }

    public function delete($id_rekening)
    {
        $this->m_rekening->delete($id_rekening);
        $this->session->set_flashdata('pesan', 'Data berhasil dihapus!');
        redirect('rekening');
    }
}

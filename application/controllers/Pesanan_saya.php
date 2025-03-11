<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pesanan_saya extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_transaksi');
		$this->load->model('m_pesanan_masuk');
	}


	public function index()
	{
		$data = array(
			'title' => 'Pesanan Saya',
			'belum_bayar' => $this->m_transaksi->belum_bayar(),
			'diproses' => $this->m_transaksi->diproses(),
			'dikirim' => $this->m_transaksi->dikirim(),
			'selesai' => $this->m_transaksi->selesai(),
			'isi' => 'v_pesanan_saya',
		);
		$this->load->view('layout/v_wrapper_frontend', $data, FALSE);
	}

	public function bayar($id_transaksi)
	{
		$this->form_validation->set_rules('atas_nama', 'Atas Nama', 'required|trim', array(
			'required' => '%s Harus Diisi !!!'
		));
		$this->form_validation->set_rules('nama_bank', 'Nama Bank', 'required|trim', array(
			'required' => '%s Harus Diisi !!!'
		));
		$this->form_validation->set_rules('no_rek', 'No Rekening', 'required|trim|numeric', array(
			'required' => '%s Harus Diisi !!!',
			'numeric' => '%s Hanya Boleh Berisi Angka !!!'
		));

		if ($this->form_validation->run() == TRUE) {
			// Validate if file is selected
			if (empty($_FILES['bukti_bayar']['name'])) {
				$data = array(
					'title' => 'Pembayaran',
					'pesanan' => $this->m_transaksi->detail_pesanan($id_transaksi),
					'rekening' => $this->m_transaksi->rekening(),
					'error_upload' => 'Bukti Pembayaran Wajib Di-Upload !!!',
					'isi' => 'v_bayar',
				);
				$this->load->view('layout/v_wrapper_frontend', $data, FALSE);
				return;
			}

			$config['upload_path'] = './assets/bukti_bayar/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg|ico|jfif';
			$config['max_size'] = '5000';
			$config['file_ext_tolower'] = TRUE; // Force lowercase extension
			$config['remove_spaces'] = TRUE; // Replace spaces in filenames
			$config['overwrite'] = FALSE; // Don't overwrite files
			$config['file_name'] = 'bukti-' . date('Ymd') . '-' . substr(md5(rand()), 0, 10); // Generate unique filename

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if (!$this->upload->do_upload('bukti_bayar')) {
				$data = array(
					'title' => 'Pembayaran',
					'pesanan' => $this->m_transaksi->detail_pesanan($id_transaksi),
					'rekening' => $this->m_transaksi->rekening(),
					'error_upload' => $this->upload->display_errors(),
					'isi' => 'v_bayar',
				);
				$this->load->view('layout/v_wrapper_frontend', $data, FALSE);
			} else {
				$upload_data = array('uploads' => $this->upload->data());
				$config['image_library'] = 'gd2';
				$config['source_image'] = './assets/bukti_bayar/' . $upload_data['uploads']['file_name'];
				$this->load->library('image_lib', $config);

				// Make sure upload directory exists and is writable
				if (!is_dir('./assets/bukti_bayar/') || !is_writable('./assets/bukti_bayar/')) {
					mkdir('./assets/bukti_bayar/', 0755, TRUE);
				}

				$data = array(
					'id_transaksi' => $id_transaksi,
					'atas_nama' => htmlspecialchars($this->input->post('atas_nama', TRUE)),
					'nama_bank' => htmlspecialchars($this->input->post('nama_bank', TRUE)),
					'no_rek' => htmlspecialchars($this->input->post('no_rek', TRUE)),
					'status_bayar' => '1',
					'bukti_bayar' => $upload_data['uploads']['file_name'],
				);
				$this->m_transaksi->upload_buktibayar($data);
				$this->session->set_flashdata('pesan', 'Bukti Pembayaran Berhasil Di Upload !!!');
				redirect('pesanan_saya');
			}
		}

		$data = array(
			'title' => 'Pembayaran',
			'pesanan' => $this->m_transaksi->detail_pesanan($id_transaksi),
			'rekening' => $this->m_transaksi->rekening(),
			'isi' => 'v_bayar',
		);
		$this->load->view('layout/v_wrapper_frontend', $data, FALSE);
	}

	public function diterima($id_transaksi)
	{
		$data = array(
			'id_transaksi' => $id_transaksi,
			'status_order' => '3'
		);
		$this->m_pesanan_masuk->update_order($data);
		$this->session->set_flashdata('pesan', 'Pesanan Telah diterima !!!');
		redirect('pesanan_saya');
	}
}

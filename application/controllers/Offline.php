<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Offline extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_barang');
		$this->load->model('m_kategori');
		$this->load->model('m_transaksi');
	}

	// List all your items
	public function index()
	{
		$data = array(
			'title' => 'Offline',
			'barang' => $this->m_home->get_all_data(),
			'isi' => 'v_offline',
		);
		$this->load->view('layout/v_wrapper_backend', $data, FALSE);
	}

	// Add a new item
	public function delete($rowid)
	{
		$this->cart->remove($rowid);
		redirect('offline');
	}

	public function update()
	{
		$i = 1;
		foreach ($this->cart->contents() as  $items) {
			$data = array(
				'rowid' => $items['rowid'],
				'qty'   => $this->input->post($i . '[qty]'),
			);
			$this->cart->update($data);
			$i++;
		}
		$this->session->set_flashdata('pesan', 'Keranjang Berhasil Di Update !!!');
		redirect('offline');
	}

	public function clear()
	{
		$this->cart->destroy();
		redirect('offline');
	}

	public function cekout()
	{
		// $this->User_login->proteksi_halaman();
		$this->form_validation->set_rules('provinsi', 'Provinsi', 'required', array(
			'required' => '%s Harus Diisi !!!'
		));
		$this->form_validation->set_rules('kota', 'Kota', 'required', array(
			'required' => '%s Harus Diisi !!!'
		));

		if ($this->form_validation->run() == FALSE) {
			$data = array(
				'title' => 'Cek Out Offline',
				'isi' => 'v_cekout_offline',
			);
			$this->load->view('layout/v_wrapper_backend', $data, FALSE);
		} else {
			//simpan ke tabel transaksi
			$data = array(
				'id_pelanggan' => $this->session->userdata('username'),
				'no_order' => $this->input->post('no_order'),
				'tgl_order' => date('Y-m-d'),
				'nama_penerima' => $this->input->post('nama_penerima'),
				'hp_penerima' => $this->input->post('hp_penerima'),
				'provinsi' => $this->input->post('provinsi'),
				'kota' => $this->input->post('kota'),
				'alamat' => $this->input->post('alamat'),
				'kode_pos' => $this->input->post('kode_pos'),
				'ongkir' => $this->input->post('ongkir'),
				'jarak' => $this->input->post('jarak'),
				'grand_total' => $this->input->post('grand_total'),
				'total_bayar' => $this->input->post('total_bayar'),
				'status_bayar' => '1',
				'atas_nama' => 'Kasir',
				'nama_bank' => 'Kasir',
				'keterangan' => 'Diproses Oleh Admin',
				'no_rek' => 'Kasir',
				'status_order' => '3',
			);
			$this->m_transaksi->simpan_transaksi($data);
			//simpan ke tabel rinci transaksi
			$i = 1;
			foreach ($this->cart->contents() as $item) {
				$data_rinci = array(
					'no_order' => $this->input->post('no_order'),
					'id_barang' => $item['id'],
					'qty' => $this->input->post('qty' . $i++),
				);
				$this->m_transaksi->simpan_rinci_transaksi($data_rinci);
			}

			//=========================================
			$this->session->set_flashdata('pesan', 'Pesanan Berhasil Di Proses !!!');
			$this->cart->destroy();
			redirect('Admin/pesanan_masuk');
		}
	}

	public function add()
	{
		$redirect_page = $this->input->post('redirect_page');
		$data = array(
			'id'      => $this->input->post('id'),
			'qty'     => $this->input->post('qty'),
			'price'   => $this->input->post('price'),
			'name'    => $this->input->post('name'),
		);
		$this->cart->insert($data);
		redirect($redirect_page, 'refresh');
	}
}

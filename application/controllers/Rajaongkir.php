<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Rajaongkir extends CI_Controller
{
	private $api_key;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_admin');
		$this->load->model('m_setting');
		$this->load->driver('cache', array('adapter' => 'file'));

		// Set API key in constructor
		$this->api_key = $_ENV['RAJAONGKIR_API_KEY'];
	}

	public function provinsi()
	{

		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
			CURLOPT_SSL_VERIFYHOST => 0,
			CURLOPT_SSL_VERIFYPEER => 0,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_HTTPHEADER => array(
				"key: $this->api_key"
			),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
			echo "cURL Error #:" . $err;
		} else {
			$array_response = json_decode($response, true);
			$data_provinsi = $array_response['rajaongkir']['results'];
			echo "<option value=''>--Pilih Provinsi--</option>";
			foreach ($data_provinsi as $key => $value) {
				echo "<option value='" . $value['province'] . "' id_provinsi='" . $value['province_id'] . "'>" . $value['province'] . "</option>";
			}
		}
	}

	public function kota()
	{
		$id_provinsi_terpilih = $this->input->post('id_provinsi');

		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://api.rajaongkir.com/starter/city?province=" . $id_provinsi_terpilih,
			CURLOPT_SSL_VERIFYHOST => 0,
			CURLOPT_SSL_VERIFYPEER => 0,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_HTTPHEADER => array(
				"key: $this->api_key"
			),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
			echo "cURL Error #:" . $err;
		} else {
			$array_response = json_decode($response, true);
			$data_kota = $array_response['rajaongkir']['results'];
			echo "<option value=''>--Pilih Kota--</option>";
			foreach ($data_kota as $key => $value) {
				echo "<option value='" . $value['city_name'] . "' id_kota='" . $value['city_id'] . "'>" . $value['city_name'] . "</option>";
			}
		}
	}

	public function expedisi()
	{
		// Define available couriers in RajaOngkir starter API according to documentation
		// Kode kurir: jne, pos, tiki
		$courier_list = [
			['code' => 'jne', 'name' => 'JNE (Jalur Nugraha Ekakurir)'],
			['code' => 'pos', 'name' => 'POS Indonesia'],
			['code' => 'tiki', 'name' => 'TIKI (Titipan Kilat)']
		];

		echo '<option value="">--Pilih Expedisi--</option>';
		foreach ($courier_list as $courier) {
			echo '<option value="' . $courier['code'] . '">' . $courier['name'] . '</option>';
		}
	}

	public function paket()
	{
		// Get the shop's location from settings
		$setting = $this->m_setting->get_setting();
		$id_kota_asal = isset($setting->id_kota) ? $setting->id_kota : $this->m_admin->data_setting()->lokasi;

		$expedisi = $this->input->post('expedisi');
		$id_kota = $this->input->post('id_kota_tujuan');

		// Debug information to console
		error_log("Origin: " . $id_kota_asal);
		error_log("Destination: " . $id_kota);
		error_log("Expedisi: " . $expedisi);

		$berat = $this->input->post('berat');

		// Ensure minimum weight (RajaOngkir requires at least 1 gram)
		if ($berat < 1 || empty($berat)) {
			$berat = 1;
		}

		// Validate required parameters
		if (empty($expedisi) || empty($id_kota)) {
			echo "<option value=''>Missing parameters</option>";
			return;
		}

		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
			CURLOPT_SSL_VERIFYHOST => 0,
			CURLOPT_SSL_VERIFYPEER => 0,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => "origin=" . $id_kota_asal . "&destination=" . $id_kota . "&weight=" . $berat . "&courier=" . $expedisi,
			CURLOPT_HTTPHEADER => array(
				"content-type: application/x-www-form-urlencoded",
				"key: $this->api_key"
			),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
			echo "cURL Error #:" . $err;
		} else {
			$array_response = json_decode($response, true);

			// Check if the API response is valid and contains the expected data
			if (isset($array_response['rajaongkir']['results'][0]['costs'])) {
				$data_paket = $array_response['rajaongkir']['results'][0]['costs'];
				echo "<option value=''>--Pilih Paket--</option>";

				foreach ($data_paket as $key => $value) {
					// Format the estimated delivery time
					$etd = isset($value['cost'][0]['etd']) && !empty($value['cost'][0]['etd']) ?
						$value['cost'][0]['etd'] . ' Hari' :
						'(Tidak Diketahui)';

					// Add package description where available
					$service_name = $value['service'];
					if (!empty($value['description'])) {
						$service_name .= ' - ' . $value['description'];
					}

					echo "<option 
						value='" . $value['service'] . "' 
						data-ongkir='" . $value['cost'][0]['value'] . "' 
						data-estimasi='" . $etd . "' 
						data-paket='" . $value['service'] . "'>";
					echo $service_name . " | Rp. " . number_format($value['cost'][0]['value'], 0, ',', '.') . " | " . $etd;
					echo "</option>";
				}
			} else {
				echo "<option value=''>Layanan tidak tersedia</option>";
				// Debug response
				error_log(print_r($array_response, true));
			}
		}
	}
}

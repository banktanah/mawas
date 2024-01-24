<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require FCPATH . '/vendor/autoload.php';
// use Dompdf\Dompdf;

// // Include librari PhpSpreadsheet
// use PhpOffice\PhpSpreadsheet\Spreadsheet;
// use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Bagian extends CI_Controller {

    function __construct()
	{
		parent::__construct();

		date_default_timezone_set('Asia/Jakarta');

		$this->load->model('m_data');
		//$this->load->library('pdf');

		// cek session yang login, 
		// jika session status tidak sama dengan session telah_login, berarti pengguna belum login
		// maka halaman akan di alihkan kembali ke halaman login.
		if($this->session->userdata('status')!="telah_login"){
			redirect(base_url().'welcome?alert=belum_login');
		}
	}

    // CRUD DIVISI BAGIAN
	public function index()
	{
		//$data['divisi_bagian'] = $this->m_data->get_data('divisi_bagian')->result();

        $data['divisi_bagian'] = $this->db->select('*')
							  ->from('divisi_bagian as t1')
							  ->join('divisi as t2', 't1.divisi_id = t2.divisi_id', 'LEFT')
                              ->order_by("divisi_nama", "ASC")
							  ->get()
							  ->result();

		$this->load->view('template/v_header');
		$this->load->view('master/v_divisi_bagian',$data);
		$this->load->view('template/v_footer');
	}
	public function divisi_bagian_act()
	{				
		$nama = $this->input->post('nama_divisi_bagian');
		$deskripsi = $this->input->post('desc_divisi_bagian');
		$divisi = $this->input->post('divisi_id');

		$data = array(			
			'divisi_bagian_nama' => $nama,
			'divisi_bagian_deskripsi' => $deskripsi,
			'divisi_id' => $divisi
		);

		$this->m_data->insert_data($data,'divisi_bagian');
		$this->session->set_flashdata('success', 'Divisi Bagian berhasil ditambahkan.');
		redirect(base_url().'bagian');
	}
	public function divisi_bagian_update()
	{
		$id = $this->input->post('id');
		$nama = $this->input->post('nama_divisi_bagian');
		$deskripsi = $this->input->post('desc_divisi_bagian');
		$divisi = $this->input->post('divisi_id');

		$where = array(
			'divisi_bagian_id' => $id
		);

		$data = array(
			'divisi_bagian_nama' => $nama,
			'divisi_bagian_deskripsi' => $deskripsi,
			'divisi_id' => $divisi
		);

		$this->m_data->update_data($where, $data,'divisi_bagian');
		$this->session->set_flashdata('success', 'Berhasil mengubah data Divisi Bagian.');
		redirect(base_url().'bagian');
	}
	public function divisi_bagian_hapus($id)
	{
		$where = array(
			'divisi_bagian_id' => $id
		);

		$this->m_data->delete_data($where,'divisi_bagian');		
		$this->session->set_flashdata('success', 'Divisi Bagian berhasil dihapus.');
		redirect(base_url().'bagian');
	}

	function get_divisi_bagian(){
		$id = $this->input->post('id',TRUE);
		$data = $this->db->query("SELECT * from divisi_bagian WHERE divisi_id='$id' ORDER BY divisi_bagian_nama")->result();
		if (!empty($data)) { ?>

			<option value="">--Pilih Divisi Bagian--</option>
			<?php   foreach ($data as $d) { ?>

					<option value="<?php echo $d->divisi_bagian_id; ?>"><?php echo $d->divisi_bagian_nama; ?></option>
			
			<?php	} ?>
		
		<?php }
	}

}
?>
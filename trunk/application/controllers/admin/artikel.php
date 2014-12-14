<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Artikel extends MY_Controller{
	function __construct()
	{
		parent::__construct();
		$this->load->model('artikel_m');
    }

	public function tambahartikel(){

		$this->data['artikel'] = $this->artikel_m->get_kategori();

		$this->data['page']  = 'admin/artikel/tambahartikel';
		$this->data['title'] = 'Tambah Artikel';

		$this->load->view('admin/index', $this->data);

	}

	public function proses_artikel(){
        date_default_timezone_set("Asia/Jakarta");
                
        $data['judul_artikel'] = $this->input->post('judul');
        $data['isi_artikel'] = $this->input->post('isi');
        $data['tgl_artikel'] = date("y-m-d H:i:s");
        $data['kd_kat_artikel'] = $this->input->post('kd_kat');
        $data['status_artikel'] = $this->input->post('status');
        $this->artikel_m->insert_artikel($data);
                
        redirect(base_url('admin/artikel/semuaartikel'));
    }

	public function semuaartikel(){
		$this->data['artikel'] = $this->artikel_m->get_artikel();

		$this->data['page']  = 'admin/artikel/semuaartikel';
		$this->data['title'] = 'Semua Artikel';

		$this->load->view('admin/index', $this->data);
	}

	public function kategoriartikel(){
		$this->data['kategori'] = $this->artikel_m->get_kategori();

		$this->data['page']  = 'admin/artikel/kategori';
		$this->data['title'] = 'Kategori';

		$this->load->view('admin/index', $this->data);
	}

	public function deleteartikel($id){
		$this->artikel_m->delete_artikel($id);
		//$this->session->set_flashdata('message','Post deleted');
		redirect('admin/artikel/semuaartikel','refresh');
	}

	public function deletekategori($id){
		$this->artikel_m->delete_kategori($id);
		//$this->session->set_flashdata('message','Post deleted');
		redirect('admin/artikel/kategoriartikel','refresh');
	}
}
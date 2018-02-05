<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class eplanning extends CI_Controller {

	private $datauser;

    public function __construct() {
        parent::__construct();

        $this->load->library(array('session'));
        $this->load->helper('url');
        $this->load->model('m_login');
        $this->load->model('realisasisimda');
        $this->load->database();
         $this->db = $this->load->database('eplanning', TRUE);
        $this->datauser = $this->session->userdata('data_user');

        }

	public function index()
	{
		if($this->session->userdata('isLogin') == FALSE) {

                redirect('login/login_form');
            } else {

                $this->load->model('m_login');
                $user = $this->session->userdata('data_user');

                $data = array();
                $data['title'] = 'Dashboard <small> </small>';
                $data['pengguna'] = $user;


          
                

                    $query = $this->db->query("select refkecamatan_nama, a.refkecamatan_id, ifnull(jumlah,0) as jumlah, ifnull(pagu,0) as pagu from refkecamatan a
left join (select refkecamatan_id, count(tblmusrenbangkelurahanuraian.tblmusrenbangkelurahanuraian_id) as jumlah,
sum(tblmusrenbangkelurahanuraian.tblmusrenbangkelurahanuraian_pagu) as pagu from tblmusrenbangkelurahanuraian where tblmusrenbangkelurahanuraian.reftahun_id = 9
group by refkecamatan_id) b on (a.refkecamatan_id = b.refkecamatan_id)");
                    $data['nagari'] = $query->result();
                $this->load->view('eplanning/musrenbang', $data);
	   }
    }

    public function datamusrenbang($id){
        $this->load->library( 'datatables');
            $query = $this->db->query("select refkelurahan_nama, ifnull(jumlah,0) as jumlah, ifnull(pagu,0) as pagu from refkelurahan a
                    left join (select refkelurahan_id, count(tblmusrenbangkelurahanuraian.tblmusrenbangkelurahanuraian_id) as jumlah, 
                    sum(tblmusrenbangkelurahanuraian.tblmusrenbangkelurahanuraian_pagu) as pagu from tblmusrenbangkelurahanuraian where tblmusrenbangkelurahanuraian.reftahun_id = 9
                    group by refkelurahan_id) b on (a.refkelurahan_id = b.refkelurahan_id)
                    where a.refkecamatan_id = '$id';");
            $detail = $query->result();

        echo json_encode($detail);

    }    

}
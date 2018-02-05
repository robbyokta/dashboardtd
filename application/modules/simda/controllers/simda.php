<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class simda extends CI_Controller {

	private $datauser;

    public function __construct() {
        parent::__construct();

        $this->load->library(array('session'));
        $this->load->helper('url');
        $this->load->model('m_login');
        $this->load->model('realisasisimda');
        $this->load->database();
         $this->db2 = $this->load->database('simda', TRUE);
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
               
                

                    $query = $this->db2->query('Select * from ref_unit');
                    $data['unit'] = $query->result();

                // $data['level'] = $this->session->userdata('level');       
                //$data['pengguna'] = $this->m_login->dataPengguna($user);
                $this->load->view('simda/realisasi', $data);
	   }
    }

    public function subunit(){

        $skpd = $this->input->post('unit');

          $return="";
       $aa =  explode('.', $skpd);
            $urusan = $aa[0];
            $bidang = $aa[1];
            $unit = $aa[2];
         $this->db2->select('*');
        $this->db2->from('ref_sub_unit'); 
        $this->db2->where('Kd_Urusan', $urusan);
        $this->db2->where('Kd_bidang', $bidang);
        $this->db2->where('Kd_unit', $unit);
          $query = $this->db2->get();
       $subunit = $query->result();
       foreach ($subunit as $subunit) {
           # code...
        $return .= "<option value='".$subunit->Kd_Sub."' >".$subunit->Nm_Sub_Unit;
       }
        echo $return;
    }


    public function lihatdata(){

        $unit = $this->input->post('unit');
        $sub = $this->input->post('sub');

         $return="";
       $aa =  explode('.', $unit);
            $urusan = $aa[0];
            $bidang = $aa[1];
            $unit = $aa[2];
            $data = $this->realisasisimda->urusan($urusan, $bidang, $unit, $sub);
        foreach ($data as $data) {
            # code...
            $return .= "<tr><td>".sprintf('%02d',$data->kd_urusan)."</td><td>".$data->nm_urusan."</td><td align='right'>".number_format($data->pagu,2)."</td><td/><td/><td/></tr>";

            foreach ($data->bidang as $bidang) {
                # code...
                 $return .= "<tr><td>".sprintf('%02d',$data->kd_urusan).'.'.sprintf('%02d',$bidang->kd_bidang)."</td><td>".$bidang->nm_bidang."</td><td align='right'>".number_format($bidang->pagu,2)."</td><td/><td/><td/></tr>";
                foreach ($bidang->program as $program) {
                # code...
                    if ($program->pagu != 0){
                        $persen = ($program->nilai/ $program->pagu)*100;
                    } else {  $persen =0;}
                 $return .= "<tr><td>".sprintf('%02d',$data->kd_urusan).'.'.sprintf('%02d',$bidang->kd_bidang).".".sprintf('%02d',$unit)."</td><td>".$program->ket_program."</td><td align='right'>".number_format($program->pagu,2)."</td><td align='right'>".number_format($program->nilai,2)."</td><td align='center'>".number_format($persen,2)."</td><td align='right'>".number_format($program->pagu-$program->nilai,2)."</td></tr>";

                    foreach ($program->kegiatan as $kegiatan) {
                    # code...
                     if ($kegiatan->pagu != 0){
                        $persen = ($kegiatan->nilai/ $kegiatan->pagu)*100;
                    } else {  $persen =0;}
                     $return .= "<tr><td>".sprintf('%02d',$data->kd_urusan).'.'.sprintf('%02d',$bidang->kd_bidang).".".sprintf('%02d',$unit).".".sprintf('%02d',$kegiatan->kd_keg)."</td><td>".$kegiatan->ket_kegiatan."</td><td align='right'>".number_format($kegiatan->pagu,2)."</td></td><td align='right'>".number_format($kegiatan->nilai,2)."</td><td align='center'>".number_format($persen,2)."</td><td align='right'>".number_format($kegiatan->pagu-$kegiatan->nilai,2)."</td></tr>";
                    }
                }

            }

        }




        
       
        echo $return;
    }
}
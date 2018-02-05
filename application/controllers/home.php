<?php if(!defined('BASEPATH')) exit('Hacking Attempt. Keluar dari sistem.');

    class Home extends CI_Controller {

        private $datauser;

          public function __construct() {
            parent::__construct();

            $this->load->library(array('session'));
            $this->load->helper('url');
                 $this->load->model('m_login');
            $this->load->database();
            $this->datauser = $this->session->userdata('data_user');

        }

          public function index() {
            if($this->session->userdata('isLogin') == FALSE) {

                redirect('login/login_form');
            } else {
                $this->load->model('m_login');
                $user = $this->session->userdata('data_user');

                $data = array();
                $data['pengguna'] = $user;

                // $data['level'] = $this->session->userdata('level');       
                //$data['pengguna'] = $this->m_login->dataPengguna($user);
                $this->load->view('home', $data);
                }
        } 
    }
?>
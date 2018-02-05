<?php if(!defined('BASEPATH')) exit('Hacking Attempt : Keluar dari sistem..!!');

    class Login extends CI_Controller {

        public function __construct() {
            parent::__construct();

            $this->load->model('m_login');
            $this->load->library(array('form_validation','session'));
            $this->load->database();
            $this->load->helper('url');
         }

          public function index() {
            $session = $this->session->userdata('isLogin');
                if($session == FALSE) {
                redirect('login/login_form');
            } else {
                redirect('home');
            }
        }

          public function login_form() {
            $this->form_validation->set_rules('email', 'email', 'required|trim');
            $this->form_validation->set_rules('password', 'Password', 'required|md5');
            $this->form_validation->set_error_delimiters('<span class="error">', '</span>');
            if($this->form_validation->run()==FALSE) {
                $this->load->view('login');
            }else{
                       $email = $this->input->post('email');
                       $password = $this->input->post('password');
                       //$level = $this->input->post('level');
                       $cek = $this->m_login->ambilPengguna($email, $password, 1/*, $level*/);

                    if($cek->num_rows() <> 0) {

                    $this->session->set_userdata('isLogin', TRUE);
                    $this->session->set_userdata('data_user',$cek->row());
                    // $this->session->set_userdata('level',$level);

                    redirect('home');
                }else {
                         echo " <script>
                                    alert('Gagal Login: Cek email , password dan level anda!');
                                    history.go(-1);
                          </script>";        
                }
            }  
        }

          public function logout() {
               $this->session->sess_destroy();
               redirect('login/login_form');
          }
    }

?>
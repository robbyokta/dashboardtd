


<?php if(!defined('BASEPATH')) exit('Hacking Attempt : Keluar dari sistem..!!');

    class Realisasi extends CI_Model {

        public function __construct() {

            parent::__construct();

        }

        public function datagrafikrealisasi($role, $skpd) {
            if($role == '2'){
                $query = $this->db->query("SELECT dt_tgt_kegiatan.bulan, avg(tg_fisik) as tg_fisik, sum(tg_keu)/b.anggaran as tg_keu, 
                    ifnull(a.rl_keu,0) / b.anggaran as rl_keu, ifnull(a.rl_fisik,0)/count(dt_tgt_kegiatan.id_kegiatan) as rl_fisik  from dt_tgt_kegiatan
                    left join (SELECT split_string(id,'-',3) as bul, split_string(id,'-',4) as skpd,  sum(rl_fisik),
                     sum(rl_blj_pegawai + rl_blj_barang + rl_blj_modal) as rl_keu,
                     sum(rl_fisik) as rl_fisik
                     from dt_realisasi
                      where split_string(id,'-',4) = $skpd
                       group by skpd, bul) a on (a.bul = dt_tgt_kegiatan.bulan and a.skpd = dt_tgt_kegiatan.id_skpd )
                    left join (SELECT id_skpd, sum(blj_modal + blj_barang + blj_pegawai) as anggaran from mtr_kegiatan
                        group by id_skpd)
                         b on (b.id_skpd = dt_tgt_kegiatan.id_skpd)
                    where dt_tgt_kegiatan.id_skpd = $skpd
                    group by bulan");
                } else {
                    $query = $this->db->query("SELECT target.bulan,  tg_fisik,  tg_keu, b.anggaran, b.jumlah, 
                    ifnull(a.rl_keu,0) / b.anggaran as rl_keu, ifnull(a.rl_fisik,0)/b.jumlah as rl_fisik  from target
                    left join (SELECT split_string(id,'-',3) as bul, split_string(id,'-',2) as tahun,  
                     sum(rl_blj_pegawai + rl_blj_barang + rl_blj_modal) as rl_keu,
                     sum(rl_fisik) as rl_fisik
                     from dt_realisasi
                      where split_string(id,'-',2) = 2018
                       ) a on (a.bul = target.bulan and a.tahun = target.tahun )
                    left join (SELECT tahun, count(id_kegiatan) as jumlah, id_skpd, sum(blj_modal + blj_barang + blj_pegawai) as anggaran from mtr_kegiatan
      )
                         b on (b.tahun = target.tahun)
                    group by bulan;");

                }
               $hasil=array();
                if($query->num_rows() > 0){
                    foreach($query->result() as $data){
                        $hasil[] = $data;
                    }
                    return $hasil;
                }
            
          } 

        public function inputskpd() {
             $query = $this->db->query("select a.nama_skpd, b.jml_kegiatan, ifnull(c.jml_input,0) as inputan from skpd a
            left join (select id_skpd, count(id_kegiatan) as jml_kegiatan 
            from mtr_kegiatan group by id_skpd) b on (b.id_skpd = a.id_skpd)
            left join (Select split_string(id,'-',4) as skpd, count(id) as jml_input from dt_realisasi
            where split_string(id,'-',3) = 12
            group by split_string(id,'-',4) ) c on (c.skpd = a.id_skpd)");
                return $query->result();
        }

    }  




?>
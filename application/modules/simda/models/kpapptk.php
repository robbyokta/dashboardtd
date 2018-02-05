


<?php if(!defined('BASEPATH')) exit('Hacking Attempt : Keluar dari sistem..!!');

    class Kpapptk extends CI_Model {

        public function __construct() {

            parent::__construct();

        }

        public function kpa($skpd, $bulan, $bulanint) {

                $targetfisik = 'tg_fisik_'.$bulanint;
                $targetkeu = 'tg_keu_'.$bulanint;
            $query = $this->db->query("SELECT kpa , count(mtr_kegiatan.id_kegiatan) as jml_keg,sum(blj_pegawai) as blj_pegawai, sum(blj_barang) as blj_barang,
            sum(blj_modal) as blj_modal,
            (sum(blj_pegawai) + sum(blj_barang) + sum(blj_modal)) as tot_anggaran, 
            avg(b.tg_fisik) as tg_fisik, avg(b.tg_keu) as tg_keu,   avg(ifnull(a.rl_fisik,0)) as rl_fisik, 
            sum(ifnull(a.rl_blj_pegawai,0)) as rl_blj_pegawai , sum(ifnull(a.rl_blj_barang,0)) as rl_blj_barang,
            sum(ifnull(a.rl_blj_modal,0)) as rl_blj_modal ,
            sum(ifnull(a.rl_blj_barang,0)+ifnull(a.rl_blj_pegawai,0)+ifnull(a.rl_blj_modal,0)) as tot_realisasi  FROM (`mtr_kegiatan`) 
            left JOIN (select id_kegiatan, rl_fisik, rl_blj_pegawai, rl_blj_modal, rl_blj_barang from dt_realisasi where dt_realisasi.bulan = '$bulan') a ON (`a`.`id_kegiatan` = `mtr_kegiatan`.`id_kegiatan` )
            left JOIN (select id_kegiatan,  tg_fisik,  tg_keu from dt_tgt_kegiatan
                          where bulan = $bulanint  ) b 
            ON (`b`.`id_kegiatan` = `mtr_kegiatan`.`id_kegiatan`)
            where id_skpd = $skpd 
            group by kpa");
            foreach ($query->result() as $kpapptk){
                    $return[$kpapptk->kpa] = $kpapptk;
                    $return[$kpapptk->kpa]->subs = $this->pptk($skpd, $kpapptk->kpa, $bulan, $bulanint);
                }   

            return $return;
            
          } 

          public function pptk($skpd,$kpa, $bulan, $bulanint) {

                $targetfisik = 'tg_fisik_'.$bulanint;
                $targetkeu = 'tg_keu_'.$bulanint;
                $query = $this->db->query("SELECT pptk , count(mtr_kegiatan.id_kegiatan) as jml_keg,sum(blj_pegawai) as blj_pegawai, sum(blj_barang) as blj_barang,
            sum(blj_modal) as blj_modal,
            (sum(blj_pegawai) + sum(blj_barang) + sum(blj_modal)) as tot_anggaran, 
            avg(b.tg_fisik) as tg_fisik, avg(b.tg_keu) as tg_keu,   avg(ifnull(a.rl_fisik,0)) as rl_fisik, 
            sum(ifnull(a.rl_blj_pegawai,0)) as rl_blj_pegawai , sum(ifnull(a.rl_blj_barang,0)) as rl_blj_barang,
            sum(ifnull(a.rl_blj_modal,0)) as rl_blj_modal ,
            sum(ifnull(a.rl_blj_barang,0)+ifnull(a.rl_blj_pegawai,0)+ifnull(a.rl_blj_modal,0)) as tot_realisasi  FROM (`mtr_kegiatan`) 
            left JOIN (select id_kegiatan, rl_fisik, rl_blj_pegawai, rl_blj_modal, rl_blj_barang from dt_realisasi where dt_realisasi.bulan = '$bulan') a ON (`a`.`id_kegiatan` = `mtr_kegiatan`.`id_kegiatan` )
            left JOIN (select id_kegiatan,  tg_fisik,  tg_keu from dt_tgt_kegiatan
                          where bulan = $bulanint  ) b 
            ON (`b`.`id_kegiatan` = `mtr_kegiatan`.`id_kegiatan`)
            where id_skpd = $skpd and kpa = '$kpa'
            group by pptk");
                
            return $query->result();
          }
    }  

?>
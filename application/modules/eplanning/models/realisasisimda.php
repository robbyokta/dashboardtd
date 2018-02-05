


<?php if(!defined('BASEPATH')) exit('Hacking Attempt : Keluar dari sistem..!!');

    class realisasisimda extends CI_Model {

        public function __construct() {

            parent::__construct();
         $this->db2 = $this->load->database('simda', TRUE);

        }

        public function urusan ($urusan, $bidang, $unit, $sub) {
            $query = $this->db2->query("select a.nm_urusan, ta_belanja_rinc_sub.kd_urusan,sum( tA_BELANJA_RINC_SUB.TOTAL) as pagu from ta_belanja_rinc_sub
                                    Left Join (select kd_URUSAN, NM_URUSAN  from ref_urusan) a on ( ta_belanja_rinc_sub.kd_urusan = a.kd_urusan )
                                    where ta_belanja_rinc_sub.kd_urusan = '$urusan' and ta_belanja_rinc_sub.kd_bidang ='$bidang' and
                                    ta_belanja_rinc_sub.kd_unit = '$unit' and ta_belanja_rinc_sub.kd_sub = '$sub' and ta_belanja_rinc_sub.tahun = '2018'
                                    group by A.NM_urusan, ta_belanja_rinc_sub.kd_urusan");
            foreach ($query->result() as $urusan)
                {
                    $return[$urusan->kd_urusan] = $urusan;
                    $return[$urusan->kd_urusan]->bidang = $this->bidang($urusan, $bidang, $unit, $sub, $urusan->kd_urusan ); // Get the categories sub categories
                }

            return $return;
            
          } 

    public function bidang($urusan, $bidang, $unit, $sub, $urusan) {

               
                $query = $this->db2->query("select a.nm_bidang,ta_belanja_rinc_sub.kd_urusan,
                                    ta_belanja_rinc_sub.kd_bidang, sum( tA_BELANJA_RINC_SUB.TOTAL) as pagu from ta_belanja_rinc_sub
                                    Left Join (select kd_URUSAN, kd_bidang, nm_bidang  from ref_bidang) a on 
                                    ( ta_belanja_rinc_sub.kd_urusan = a.kd_urusan and ta_belanja_rinc_sub.kd_bidang = a.kd_bidang )
                                    where ta_belanja_rinc_sub.kd_urusan = '$urusan' and ta_belanja_rinc_sub.kd_bidang = '$bidang' and
                                    ta_belanja_rinc_sub.kd_unit = '$unit' and ta_belanja_rinc_sub.kd_sub = '$sub' and ta_belanja_rinc_sub.tahun = '2018'
                                    group by a.nm_bidang, ta_belanja_rinc_sub.kd_bidang, ta_belanja_rinc_sub.kd_urusan");
                foreach ($query->result() as $bidang)
                {
                    $return[$bidang->kd_bidang] = $bidang;
                    $return[$bidang->kd_bidang]->program = $this->program($urusan, $bidang, $unit, $sub, $bidang->kd_bidang); // Get the categories sub categories
                }
                
            return $return;
          }

    public function program($urusan, $bidang, $unit, $sub, $bidang) {

               
                $query = $this->db2->query("select ta_program.kd_prog, ta_program.Kd_prog,ta_program.id_prog, ta_program.ket_program, a.pagu , b.nilai
                                        from ta_program
                                        left join (select kd_urusan, kd_bidang, kd_unit, tahun, kd_sub,kd_prog,id_prog, sum( tA_BELANJA_RINC_SUB.TOTAL) as pagu from tA_BELANJA_RINC_SUB
                                        group by kd_prog, id_prog, kd_urusan, kd_bidang, kd_unit, tahun, kd_sub) a on (a.kd_urusan = ta_program.kd_urusan and a.kd_bidang =ta_program.kd_bidang and
                                        a.kd_unit = ta_program.kd_unit and a.kd_sub = ta_program.kd_sub 
                                        and a.tahun = ta_program.tahun and a.kd_prog = ta_program.kd_prog
                                        and a.id_prog = ta_program.id_prog)

                                        left join (select kd_urusan, kd_bidang, kd_unit, tahun, kd_sub,kd_prog,id_prog, sum( ta_spm_rinc.nilai) as nilai from ta_spm_rinc
                                        group by kd_prog, id_prog, kd_urusan, kd_bidang, kd_unit, tahun, kd_sub) b on (b.kd_urusan = ta_program.kd_urusan and b.kd_bidang =ta_program.kd_bidang and
                                        b.kd_unit = ta_program.kd_unit and b.kd_sub = ta_program.kd_sub 
                                        and b.tahun = ta_program.tahun and b.kd_prog = ta_program.kd_prog
                                        and b.id_prog = ta_program.id_prog)

                                        where ta_program.kd_urusan = '$urusan' and ta_program.kd_bidang = '$bidang' and 
                                        ta_program.kd_unit = '$unit'  and ta_program.kd_sub = '$sub' and ta_program.tahun = '2018'
                                        order by ta_program.Kd_prog,ta_program.id_prog");
                foreach ($query->result() as $program)
                {
                    $return[$program->kd_prog] = $program;
                    $return[$program->kd_prog]->kegiatan = $this->kegiatan($urusan, $bidang, $unit, $sub, $program->kd_prog, $program->id_prog ); // Get the categories sub categories
                }
                
            return $return;
    }

    public function kegiatan($urusan, $bidang, $unit, $sub, $kd_prog, $id_prog) {

               
                $query = $this->db2->query("select ta_KEGIATAN.kd_prog, ta_KEGIATAN.Id_prog,  ta_KEGIATAN.kd_keg, ta_KEGIATAN.ket_kegiatan, a.pagu , b.nilai
                                             from TA_KEGIATAN 
                                            left join (select kd_urusan, kd_bidang, kd_unit, tahun, kd_sub,kd_prog,id_prog,KD_KEG, sum( tA_BELANJA_RINC_SUB.TOTAL) as pagu from tA_BELANJA_RINC_SUB
                                            group by kd_prog, id_prog, kd_urusan, kd_bidang, kd_unit, tahun, kd_sub, KD_KEG) a on (a.kd_urusan = ta_KEGIATAN.kd_urusan and a.kd_bidang =ta_KEGIATAN.kd_bidang and
                                            a.kd_unit = ta_KEGIATAN.kd_unit and a.kd_sub = ta_KEGIATAN.kd_sub 
                                            and a.tahun = ta_KEGIATAN.tahun and a.kd_prog = ta_KEGIATAN.kd_prog
                                            and a.id_prog = ta_KEGIATAN.id_prog and a.kd_keg = ta_KEGIATAN.kd_keg)

                                            left join (select kd_urusan, kd_bidang, kd_unit, tahun, kd_sub,kd_prog,id_prog, KD_KEG, sum( ta_spm_rinc.nilai) as nilai from ta_spm_rinc
                                            group by kd_prog, id_prog, kd_urusan, kd_bidang, kd_unit, tahun, kd_sub, KD_KEG) b on (b.kd_urusan = ta_KEGIATAN.kd_urusan and b.kd_bidang =ta_KEGIATAN.kd_bidang and
                                            b.kd_unit = ta_KEGIATAN.kd_unit and b.kd_sub = ta_KEGIATAN.kd_sub 
                                            and b.tahun = ta_KEGIATAN.tahun and b.kd_prog = ta_KEGIATAN.kd_prog
                                            and b.id_prog = ta_KEGIATAN.id_prog AND b.kd_keg = ta_KEGIATAN.kd_keg)

                                            WHERE 
                                            ta_KEGIATAN.kd_urusan = '$urusan' and ta_KEGIATAN.kd_bidang = '$bidang' and
                                             ta_kegiatan.kd_unit = '$unit'  and ta_KEGIATAN.tahun = '2018' 
                                             and ta_kegiatan.kd_sub = '$sub'
                                            AND ta_KEGIATAN.KD_PROG = '$kd_prog'
                                            AND ta_KEGIATAN.ID_PROG = '$id_prog'
                                            order by ta_KEGIATAN.KD_KEG");
               
                
           foreach ($query->result() as $kegiatan)
                {
                    $return[$kegiatan->kd_keg] = $kegiatan;
                    //$return[$program->kd_prog]->kegiatan = $this->kegiatan($urusan, $bidang, $unit, $sub, $program->kd_prog, $program->id_prog ); // Get the categories sub categories
                }
                
            return $return;
    }
     
}  



?>
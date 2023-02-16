<?php

namespace App\Models;

use CodeIgniter\Model;

class DataModelProgram extends Model
{

    public function getSidebarMenu($jenis) 
    {        
        $sql = "EXEC PIP.dbo.getSidebarMenu :jenis:";
        $query = $this->db->query($sql, ['jenis' => $jenis]);
        return $query;
    }

    public function getWilayah($program,$tahunaktif,$kode,$level) 
    {
        if ($tahunaktif==null)
            $tahun = 2020;
        else 
            $tahun = $tahunaktif;
        
        $sql = "EXEC PIP.dbo.get".$program."_Wilayah :tahun:, :kode:, :level:";
           
        // echo $sql;
        // die();
        $query = $this->db->query($sql, [
            'tahun' => $tahun,
            'kode' =>$kode,
            'level' => $level,
        ]);

        
        return $query;
    }

    public function getKolomWilayah($program) 
    {
        
        $sql = "EXEC PIP.dbo.getKolomWilayah :program:";

        $query = $this->db->query($sql, [
            'program' => $program,
        ]);

        
        return $query;
    }

    public function getDaftarSetara($status,$kodebaru)
    {
        if ($status=="all")
            $wherestatus = "";
        else if ($status=="s1")
            $wherestatus = " AND status_sekolah = 1 ";
        else if ($status=="s2")
            $wherestatus = " AND status_sekolah = 2 ";

        $sql = "SELECT npsn, nama, alamat_jalan, desa_kelurahan, 
        kode_wilayah, paket_a, paket_b, paket_c, 
        CASE WHEN status_sekolah=1 THEN 'NEGERI' ELSE 'SWASTA' END AS status_skl
        FROM Arsip.dbo.sekolah s 
        JOIN Dataprocess.dbo.sekolah_jenis_layanan d on d.sekolah_id=s.sekolah_id 
        WHERE (".$this->kesetaraanall.") 
        AND LEFT(kode_wilayah,6)=:kodebaru: AND soft_delete=0 
        ".$wherestatus." 
        ORDER BY nama";

        $query = $this->db->query($sql, [
            'kodebaru'  => $kodebaru
        ]);

        return $query;
    }

    //////////////////////////////////////////////////////

    public function getBentukPendidikan($bentuk)
    {
        $sql = "SELECT * FROM [Referensi].[ref].[bentuk_pendidikan] 
                WHERE [bentuk_pendidikan_id]=:bentuknya: 
                ORDER BY [bentuk_pendidikan_id]";
        $query = $this->db->query($sql,[
            'bentuknya' => $bentuk
        ]);

        return $query;
    }

    public function getNamaPilihan($kode)
    {
        $sql = 'SELECT nama FROM Referensi.ref.mst_wilayah w  
                WHERE kode_wilayah=:kodewilayah:';
        $query = $this->db->query($sql, [
            'kodewilayah'  => $kode
        ]);

        return $query;
    }



}

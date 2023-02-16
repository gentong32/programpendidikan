<?php

namespace App\Controllers;
use App\Models\DataModelProgram;

class Home extends BaseController
{
    function __construct() {
        $this->datamodelprogram = new DataModelProgram();
    }

    public function index()
    {
        return view('home');
    }

    public function integrasi()
    {
        if (isset($_GET['namaprogram']))
        $namaprogram = $_GET['namaprogram'];
        else
        $namaprogram = "Pendidikan";

        if (isset($_GET['tahun']))
        $tahunaktif = $_GET['tahun'];
        else
        $tahunaktif = date('Y');

        if (isset($_GET['level']))
        $level = $_GET['level'];
        else
        $level = 1;

        if (isset($_GET['kode']))
        $kode = $_GET['kode'];
        else
        $kode = '000000';

        if (isset($_GET['jenjang']))
        $jenjang = $_GET['jenjang'];
        else
        $jenjang = 'SD';

        $data = array();
        $data['namaprogram'] = $namaprogram;
        $data['kode'] = $kode;
        $data['level'] = $level;
        $getSidebarMenu1 = $this->datamodelprogram->getSidebarMenu(1);
        $resultSidabarMenu1 = $getSidebarMenu1->getResult();
        $getSidebarMenu2 = $this->datamodelprogram->getSidebarMenu(2);
        $resultSidabarMenu2 = $getSidebarMenu2->getResult();

        // foreach ($resultSidabarMenu1 as $row)
        // {
        //     echo $row->nama;
        // }

        $data['menu'] = $resultSidabarMenu1;
        $data['menu2'] = $resultSidabarMenu2;
        $data['tahunaktif'] = $tahunaktif;
        $data['jenjang'] = $jenjang;
        
        if ($namaprogram!="Pendidikan")
        {

            
            if ($level==0) {
                $data['namapilihan'] = "PROVINSI";
            }
            else {
                $namapilihan = $this->datamodelprogram->getNamaPilihan($kode);
                $resultquery = $namapilihan->getResult();
                $data['namapilihan'] = strToUpper($resultquery[0]->nama);
            }

            $namalevel1 = $this->datamodelprogram->getNamaPilihan(substr($kode,0,2)."0000");
            $result1 = $namalevel1->getResult();
            $data['namalevel1'] = $result1[0]->nama;
            $namalevel2 = $this->datamodelprogram->getNamaPilihan(substr($kode,0,4)."00");
            $result2 = $namalevel2->getResult();
            $data['namalevel2'] = $result2[0]->nama;
            $namalevel3 = $this->datamodelprogram->getNamaPilihan(substr($kode,0,6));
            $result3 = $namalevel3->getResult();
            $data['namalevel3'] = $result3[0]->nama;

            
            if ($level<=3) {
                $wilayah = $this->datamodelprogram->getWilayah($namaprogram,$tahunaktif,$kode,$level);
                $data['datanas'] = $wilayah->getResult();
                $kolomtabel = $this->datamodelprogram->getKolomWilayah($namaprogram);
                $data['kolomtabel'] = $kolomtabel->getResult();
                // echo "<pre>";
                // echo var_dump($data['kolomtabel']);
                // echo "</pre>";
                // die();
                //return view('data_nasional', $data);
            }
            else
            {
                echo "Sedang dalam pengembangan...";
                die();
                // $kodebaru = substr($kode,0,6);
                // $query = $this->datamodelprogram->getDaftarSetara($tahunaktif,$kodebaru);
                // $data['datanas'] = $query->getResult();
                //return view('daftar_program', $data);
            }
            return view('konten', $data);
        }
        else
        {
            return view('depan', $data);
        }
    }
}

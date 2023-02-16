<?php
$totalsemua = 0;
$total1 = 0;
$total2 = 0;
$total3 = 0;
$total4 = 0;

$link1 = site_url('integrasi?namaprogram='.$namaprogram.'&tahun='.$tahunaktif.'&level=2&kode='.substr($kode, 0, 2).'0000');
$link2 = site_url('integrasi?namaprogram='.$namaprogram.'&tahun='.$tahunaktif.'&level=3&kode='.substr($kode, 0, 4).'00');
$breadcrump1 = "";
$breadcrump2 = "";
$judulnama = "Nama Provinsi";
$level--;

if ($level==1)
{
    $breadcrump1 = ">> ".$namalevel1;
    if (substr($kode,0,2)!='35')
        $judulnama = "Nama Kota/Kabupaten";
    else
        $judulnama = "Nama Negara";
}
else if ($level>1)
{
    $breadcrump1 = '>> <a href="'.$link1.'">'.$namalevel1.'</a>';
}

if ($level==2)
{
    $breadcrump2 = ">> ".$namalevel2;
    if (substr($kode,0,2)!='35')
        $judulnama = "Nama Kecamatan";
    else
        $judulnama = "Nama Kota";
}
else if ($level>2)
{
    $breadcrump2 = '>> <a href="'.$link2.'">'.$namalevel2.'</a>';
}


$piljalur1 = "";
$piljalur2 = "";
$piljalur3 = "";

$pilbentuk1 = "";

$piljalur1 = "selected";
$styletabel = "max-width:900px;";

$tahunakhir = 2023;

?>

    <?php if($level>0) {?>
    <div class="breadcrumps"><a href="<?=site_url('integrasi?namaprogram='.$namaprogram.'&tahun='.$tahunaktif)?>">Indonesia</a> 
    <?=$breadcrump1;?>
    <?=$breadcrump2;?>
    </div>
    <?php }?>
    <center>
    <div class="judulatas">JUMLAH PROGRAM <?=$namaprogram?> <?php if ($level==0)
    echo "DI"; else echo "PER"?> <?=$namapilihan?> TAHUN <?=$tahunaktif?></div>
    </center>
    <div class="card-body p-0">
    <center>
        <div class="judultabel">
            <div id="cbok2" style="display:inline-block;">
            Pilih Tahun <select class="combobox1" id="tahunpilihan" name="tahunpilihan">
                <?php for ($a=2023;$a>=2019;$a--)
                { ?>
                    <option <?php 
                    if ($a==$tahunaktif)
                    echo "selected";?> value="<?=$a?>"><?=$a?></option>
                <?php } ?>
                
            </select>
            </div>
            <button onclick="filterdata()" class="tb_utama" type="button">
                Terapkan
            </button>
        </div>
    </center>
    
    <div style="align:center;margin:auto;<?=$styletabel?>">
        <div class="mytable">
                <table class="table table-striped" id='table1'>
                <thead><tr>
                    <th width="10px">No</th>
                    <th style="text-align: left;"><?=$judulnama?></th>
                    <?php 
                    foreach ($kolomtabel as $row) 
                    {
                            for ($a=1;$a<=$row->jumlah_kolom;$a++)
                            {
                                if ($a==1)
                                echo "<th>".$row->{'kolom'.$a}."</th>";
                                else
                                echo "<th>".$row->{'kolom'.$a}."</th>";
                            }
                    }
                    ?>
                </tr>
                </thead>
                <tbody align="right">
                <?php 
                foreach ($datanas as $key => $value) :?>
                <tr>
                    <td style="padding-right:0px;"><?=$key + 1?></td>
                    <?php if ($level<=1){?>
                    <td align="left" class="link1"><a href="<?=site_url().'integrasi?namaprogram='.$namaprogram.'&tahun='.$tahunaktif.'&level='.($level+2).'&kode='.
                    trim($value->kode_wilayah)?>"><?php
                    if ($level==0 && $value->nama!="Luar Negeri")
                    {
                        echo substr($value->nama,5);
                    }
                    else if ($level==2 && substr($kode,0,2)!='35')
                    {
                        echo substr($value->nama,4);
                    }
                    else
                    {
                        echo $value->nama;
                    }?></a></td>
                    <?php } 
                    else
                    { ?>
                        <td align="left"><?php
                    if ($level==0 && $value->nama!="Luar Negeri")
                    {
                        echo substr($value->nama,5);
                    }
                    else if ($level==2 && substr($kode,0,2)!='35')
                    {
                        echo substr($value->nama,4);
                    }
                    else
                    {
                        echo $value->nama;
                    }?></td>
                    <?php }
                    ?>
                    <?php 
                    foreach ($kolomtabel as $row) 
                    {
                            for ($a=1;$a<=$row->jumlah_kolom;$a++)
                            {
                                echo "<td>".$value->{$row->{'field'.$a}}."</td>";
                            }
                    }
                    ?>
                </tr>
                
                <?php endforeach;?>
                </tbody>

                <tfoot align="right">
                <tr>
                    <th></th><th></th>
                    <?php 
                    foreach ($kolomtabel as $row) 
                    {
                            for ($a=1;$a<=$row->jumlah_kolom;$a++)
                            {
                                echo "<th></th>";
                            }
                    }
                    ?>
                </tr>
                </tfoot>

                </table>
             </div>
        </div>
    </div>
<?php
$link1 = site_url('pendidikan/program/kesetaraan/').substr($kode, 0, 2)."0000"."/1/".$status;
$link2 = site_url('pendidikan/program/kesetaraan/').substr($kode, 0, 4)."00"."/2/".$status;
$breadcrump1 = "";
$breadcrump2 = "";
$breadcrump3 = "";

if ($level==1)
{
    $breadcrump1 = ">> ".$namalevel1;
}
else if ($level>1)
{
    $breadcrump1 = '>> <a href="'.$link1.'">'.$namalevel1.'</a>';
}

if ($level==2)
{
    $breadcrump2 = ">> ".$namalevel2;
}
else if ($level>2)
{
    $breadcrump2 = '>> <a href="'.$link2.'">'.$namalevel2.'</a>';
}

if ($level==3)
{
    $breadcrump3 = ">> ".$namalevel3;
}

$pilstatus1 = "";
$pilstatus2 = "";
$pilstatus3 = "";
$centang="&#10004";

if ($status=="all")
    $pilstatus1 = "selected";
else if ($status=="s1")
    $pilstatus2 = "selected";
else if ($status=="s2")
    $pilstatus3 = "selected";

?>

<?= $this->extend('layout/default') ?>

<?= $this->section('titel') ?>
<title>Data Pendidikan Kemendikbudristek</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <div class="breadcrumps"><a href="<?=site_url('pendidikan/program/kesetaraan')?>">Indonesia</a> 
        <?=$breadcrump1;?>
        <?=$breadcrump2;?>
        <?=$breadcrump3;?>
    </div>
    <div class="judulatas">DAFTAR PROGRAM / LAYANAN KESETARAAN PER <?=$namapilihan?></div>
    <div class="card-body p-0">
        <center>
            <div id="cbok2" style="display:inline-block;">
            <select class="combobox1" id="status_sekolah" name="status_sekolah">
                <option <?=$pilstatus1?> value="all">-Semua Status-</option>
                <option <?=$pilstatus2?> value="s1">Negeri</option>
                <option <?=$pilstatus3?> value="s2">Swasta</option>
            </select>
            </div>
            <button onclick="filterdata()" class="tb_utama" type="button">
                Terapkan
            </button>
        </center>
        <div style="margin:30px;">
            <div class="">
                <table class="table table-striped" id='table1'>
                    <thead><tr>
                        <th width="10px">No</th>
                        <th>NPSN</th>
                        <th>Nama Satuan Pendidikan</th>
                        <th style="text-align:center">Paket A</th>
                        <th style="text-align:center">Paket B</th>
                        <th style="text-align:center">Paket C</th>
                        <th>Alamat</th>
                        <th width='180px'>Kelurahan</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($datanas as $key => $value) :?>
                    <tr>
                        <td align="right"><?=$key + 1?></td>
                        <td class="link1"><a target="_blank" href="<?=site_url('pendidikan/npsn/'.trim($value->npsn))?>"><?=$value->npsn?></a></td>
                        <td><?=$value->nama?></td>
                        <td style="padding-left:32px;"><?=($value->paket_a == '1') ? $centang : '-';?></td>
                        <td style="padding-left:32px;"><?=($value->paket_b == '1') ? $centang : '-';?></td>
                        <td style="padding-left:32px;"><?=($value->paket_c == '1') ? $centang : '-';?></td>
                        <td><?=$value->alamat_jalan?></td>
                        <td><?=$value->desa_kelurahan?></td>
                        <td><?=$value->status_skl?></td>
                    </tr>
                    <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>

<?= $this->section('scriptdata') ?>
<script>
$(document).ready( function () {
    $('#table1').DataTable({
        responsive: true,
        columnDefs: [
            { responsivePriority: 1, targets: 1 },
        ]
    });
} );

$(document).on('change', '#jalur_pendidikan', function () {
        getdaftarbentuk();
    });

function getdaftarbentuk() {
    isihtml1 = '<select class="combobox1" id="bentuk_pendidikan" name="bentuk_pendidikan">'+
               '<option value="all">.. tunggu ..</option>';
    isihtml3 = '</select>';
    $('#dbentukpendidikan').html(isihtml1 + isihtml3);
    $.ajax({
        type: 'GET',
        data: {jalurpendidikan: $('#jalur_pendidikan').val(),tingkat: '<?=strtoupper($tingkat)?>'},
        dataType: 'json',
        cache: false,
        url: '<?php echo base_url();?>/pendidikan/getbentukpendidikan',
        success: function (result) {
            // alert ($('#jalur_pendidikan').val());
            isihtml1 = '<select class="combobox1" id="bentuk_pendidikan" name="bentuk_pendidikan">'+
               '<option value="all">-Semua Bentuk-</option>';
            isihtml2 = "";
            var total=0;
            $.each(result, function (i, result) {
                total++;
                isihtml2 = isihtml2 + "<option value='" + result.bentuk_pendidikan_id + "'>" + result.nama + "</option>";
            });

            $('.tb_utama').prop('disabled', false);
            if (total==0)
            {
                isihtml1 = '<select class="combobox1" id="bentuk_pendidikan" name="bentuk_pendidikan">'+
               '<option value="all">-tidak ada-</option>';
               $('.tb_utama').prop('disabled', true);
            }

            $('#dbentukpendidikan').html(isihtml1 + isihtml2 + isihtml3);
        }
    });
}

function filterdata()
{
    window.open("<?=site_url('pendidikan/program/'.$tingkat)."/".$kode."/".$level?>"+
    "/"+$('#status_sekolah').val(), target="_self");
}

</script>
<?= $this->endSection() ?>
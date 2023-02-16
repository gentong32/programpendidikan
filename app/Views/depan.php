<?= $this->extend('layout/default') ?>

<?= $this->section('titel') ?>
<title>Program Pendidikan</title>
<?= $this->endSection() ?>

<?= $this->section('header') ?>
<div class="header1">
    <div class="h1_img">
        <img src="images/logotutwuri.png">
    </div>
    <div class="h1_txt">
        Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi
    </div>
</div>
<div class="header2">
    <button class="tb_home" onclick="to_home()"></button>
    <button class="tb_integrasi" onclick="to_integrasi()"></button>
</div>

<?= $this->endSection() ?>

<?= $this->section('section') ?>
<center>
    <div class="judul">
        Program <?=$namaprogram?>
    </div>
</center>

<div class="detail"></div>

<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
    $(document).ready(function () {
        $('#sidebarCollapse').on('click', function () {
            $('#sidebar').toggleClass('active');

        });

    });

    function to_home() {
        window.open("<?=site_url('/')?>", "_self");
    }

    function to_integrasi() {
        window.open("<?=site_url('/integrasi')?>", "_self");
    }

</script>
<?= $this->endSection() ?>
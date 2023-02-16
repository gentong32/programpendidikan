<?= $this->extend('layout/default_home') ?>

<?= $this->section('titel') ?>
<title>Program Pendidikan</title>
<?= $this->endSection() ?>

<?= $this->section('section') ?>
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
    <div class="splash">
        <div class="spl_img">
            <img src="images/background_new.jpg">
            <picture>
                <source media="(min-width: 650px)" srcset="images/background_new.jpg">
                <img src="images/background_m.jpg" class="lazy img-fluid" alt="">
            </picture>
        </div>
    </div>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>

    function to_home()
    {
        window.open("<?=site_url('/')?>","_self");
    }

    function to_integrasi()
    {
        window.open("<?=site_url('/integrasi')?>","_self");
    }
</script>
<?= $this->endSection() ?>
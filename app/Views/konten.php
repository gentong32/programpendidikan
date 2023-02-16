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
<?php include 'data_nasional.php'; ?>

<div class="detail"></div>

<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
    $(document).ready(function () {
       
        // $("#sidebar").toggleClass("active");
        $('#sidebarCollapse').on('click', function () {
            $('#sidebar').toggleClass('active');

        });

        $('#table1').DataTable({
            responsive: true,
            columnDefs: [
                { responsivePriority: 1, targets: -1 },
                {
                    targets: [<?php foreach ($kolomtabel as $row) 
                    {
                            for ($a=2;$a<=$row->jumlah_kolom+1;$a++)
                            {  
                                echo $a.",";
                            }
                    }?>],
                    render: $
                        .fn
                        .dataTable
                        .render
                        .number('.', ',', 0, '')
                }, {
                    className: 'text-right',
                    targets: [<?php foreach ($kolomtabel as $row) 
                    {
                            for ($a=2;$a<=$row->jumlah_kolom+1;$a++)
                            {  
                                echo $a.",";
                            }
                    }?>]
                },

                // { width: '200px', targets: [1] }, { width: '100px', targets: [1,2] },
            ],
            "footerCallback": function (row, data, start, end, display) {
                var api = this.api(),
                    data;

                // converting to interger to find total
                var intVal = function (i) {
                    return typeof i === 'string'
                        ? i.replace(/[\$,]/g, '') * 1
                        : typeof i === 'number'
                            ? i
                            : 0;
                };

                <?php 
                    foreach ($kolomtabel as $row) 
                    {
                            for ($a=1;$a<=$row->jumlah_kolom;$a++)
                            { 
                                $idx=$a+1;
                                echo "var total".$a." = api
                                    .column(".$idx.")
                                    .data()
                                    .reduce(function (a, b) {
                                        return intVal(a) + intVal(b);
                                    }, 0);";
                            }
                    }
                ?>

                var numFormat = $
                    .fn
                    .dataTable
                    .render
                    .number('.', ',', 0, '')
                    .display;

                $(api.column(0).footer()).html('');
                $(api.column(1).footer()).html('TOTAL SEMUA');

                <?php 
                    foreach ($kolomtabel as $row) 
                    {
                            for ($a=1;$a<=$row->jumlah_kolom;$a++)
                            { 
                                $idx=$a+1;
                                echo "
                                $(api.column(".$idx.").footer()).html(numFormat(total".$a."));
                                $(api.column(".$idx.").footer()).css({'text-align': 'right', 'padding-right': '15px'});
                                ";
                            }
                    }
                ?>
            },
            "processing": true
        });

    });

    $(document).on('change', '#jalur_pendidikan', function () {
        getdaftarbentuk();
    });

    function getdaftarbentuk() {
        isihtml1 = '<select class="combobox1" id="bentuk_pendidikan" name="bentuk_pendidikan"><opt' +
                'ion value="all">.. tunggu ..</option>';
        isihtml3 = '</select>';
        $('#dbentukpendidikan').html(isihtml1 + isihtml3);
        $.ajax({
            type: 'GET',
            data: {
                jalurpendidikan: $('#jalur_pendidikan').val(),
                tingkat: 'PAUD'
            },
            dataType: 'json',
            cache: false,
            url: '<?php echo base_url();?>/pip/getbentukpendidikan',
            success: function (result) {
                // alert ($('#jalur_pendidikan').val());
                isihtml1 = '<select class="combobox1" id="bentuk_pendidikan" name="bentuk_pendidikan"><opt' +
                        'ion value="all">-Semua Bentuk-</option>';
                isihtml2 = "";
                var total = 0;
                $.each(result, function (i, result) {
                    total++;
                    isihtml2 = isihtml2 + "<option value='" + result.bentuk_pendidikan_id + "'>" +
                            result.nama + "</option>";
                });

                $('.tb_utama').prop('disabled', false);
                if (total == 0) {
                    isihtml1 = '<select class="combobox1" id="bentuk_pendidikan" name="bentuk_pendidikan"><opt' +
                            'ion value="all">-tidak ada-</option>';
                    $('.tb_utama').prop('disabled', true);
                }

                $('#dbentukpendidikan').html(isihtml1 + isihtml2 + isihtml3);
            }
        });
    }

    function filterdata() {
        window.open(
            "<?=site_url()?>integrasi?namaprogram=<?=$namaprogram?>&tahun="+ $('#tahunpilihan').val(),target = "_self");
    }

    function to_home() {
        window.open("<?=site_url('/')?>", "_self");
    }

    function to_integrasi() {
        window.open("<?=site_url('/integrasi')?>", "_self");
    }

</script>
<?= $this->endSection() ?>
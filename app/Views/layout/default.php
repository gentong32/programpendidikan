<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <?=$this->renderSection('titel')?>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta
            name="description"
            content="Jendela Data Pendidikan - Pusdatin Kemdikbudristek">
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
        <meta name="author" content="Gentong">
        <meta name="generator" content="Gentong Theme">
        <meta
            name="Description"
            content="Pusdatin Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi">
        <meta name="Keywords" content="Pusdatin, Jendela Data Pendidikan">
        <link
            rel="icon"
            type="image/png"
            href="<?=site_url().'images/logotutwuri.png';?>">
        <link
            rel="stylesheet"
            href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"
            integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4"
            crossorigin="anonymous">
        <link rel="stylesheet" href="<?=base_url()?>/css/gentongstyle.css?v2.7" >

        <link rel="stylesheet" href="<?=base_url()?>/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="<?=base_url()?>/css/responsive.dataTables.min.css">
        <link rel="stylesheet" href="<?=base_url()?>/css/fixedColumns.dataTables.min.css">

    </head>
    <body>

        <script src="<?=base_url()?>/js/jquery.min.js"></script>
        <script src="<?=base_url()?>/js/bootstrap.min.js" defer></script>
        <script src="<?=base_url()?>/js/jquery.dataTables.min.js"></script>
        <script src="<?=base_url()?>/js/dataTables.responsive.min.js"></script>
        <script src="<?=base_url()?>/js/dataTables.fixedColumns.min.js"></script>

        <?=$this->renderSection('header')?>

        <div class="wrapper">

            <!-- Sidebar -->
            <nav id="sidebar">
                <ul class="list-unstyled">
                    <li >
                        <a
                            href="#homeSubmenu"
                            data-toggle="collapse"
                            aria-expanded="false"
                            class="dropdown-toggle small-font">Kemendikbudristek</a>
                        <ul class="collapse list-unstyled small-font" id="homeSubmenu">
                            <?php foreach($menu as $isimenu){?>
                              <li>
                                  <a href="<?=base_url('/integrasi?namaprogram='.$isimenu->nama)?>"><?=$isimenu->nama?></a>
                              </li>
                            <?php } ?>
                        </ul>
                    </li>
                    <li>
                        <a
                            href="#pageSubmenu"
                            data-toggle="collapse"
                            aria-expanded="false"
                            class="dropdown-toggle small-font">Kementerian Lain</a>
                        <ul class="collapse list-unstyled small-font" id="pageSubmenu">
                            <?php foreach($menu2 as $isimenu){?>
                              <li>
                                  <a href="<?=base_url('integrasi?namaprogram='.$isimenu->nama)?>"><?=$isimenu->nama?></a>
                              </li>
                            <?php } ?>
                        </ul>
                    </li>
                </ul>
            </nav>

            <!-- Page Content -->
            <div id="content">
              <nav class="navbar navbar-expand-lg navbar-light bg-light bgwhite">
                  <div class="headerkonten">
                        <button type="button" id="sidebarCollapse" class="small-font btn btn-white">
                        <img style="margin-top:-3px;" src="images/triline.png">
                            <span>Menu</span>
                        </button>
                  </div>
                  
              </nav>
              <hr class="hrtipis">
              <div class="isikonten">
                <?=$this->renderSection('section')?>
              </div>
            </div>

        </div>

        
    </body>

</html>

<?=$this->renderSection('script')?>
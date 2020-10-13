<html>

<head>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link type="text/css" rel="stylesheet" href="<?php echo base_url() . 'assets/css/dashboard.css' ?>" />
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/module/datatable/datatables.min.css' ?>">


    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

</head>

<body>
    <header>
        <?php $this->load->view('_partial/navbar') ?>
    </header>

    <main>
        <div class="container">
            <h1>Tambah Input</h1>
            <div class="row">
                <div class="col s12">
                    <a class="waves-effect red lighten-2 waves-light btn"><i class="material-icons left">chevron_left</i>Back</a>
                    <br><br>
                    <div class="card-panel white">
                        <div class="row">
                            <form class="col s12" action="<?php echo site_url('Page/save'); ?>" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <input type="text" name="id" hidden>
                                    <div class="input-field col s12">
                                        <input placeholder="Silahkan isi judul disini" name="judul" id="judul" type="text" class="validate">
                                        <label for="judul">Judul</label>
                                    </div>
                                    <div class="input-field col s12">
                                        <textarea placeholder="Silahkan isi text disini" name="isi" id="isi" type="text" class="materialize-textarea"></textarea>
                                        <label for="isi">Isi</label>
                                    </div>
                                    <div class="file-field input-field col s12">
                                        <div class="btn">
                                            <span>Upload Foto</span>
                                            <input type="file" name="gambar">
                                        </div>
                                        <div class="file-path-wrapper">
                                            <input placeholder="Silahkan upload gambar disini" class="file-path validate" type="text">
                                        </div>
                                    </div>
                                </div>
                                <button class="waves-effect blue lighten-2 waves-light btn right"><i class="material-icons left">check</i>Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>


    <?php $this->load->view('_partial/footer') ?>
    <!--JavaScript at end of body for optimized loading-->
    <?php $this->load->view('_partial/js') ?>

</body>

</html>
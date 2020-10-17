<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <title>Tugas 15 | Teo</title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Tugas 15 | Teo</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="index.php">Beranda <span class="sr-only">(current)</span></a>
            </li>
        </ul>
    </div>
</nav>

<div class="container" style="margin-top: 30px">

    <?php
    $koneksi = mysqli_connect('localhost', 'root', 'root', 'vsga2');

    if(mysqli_connect_errno()){
        echo 'Gagal konek database';
    }

    if(isset($_POST['add'])){
        $name       = isset($_POST['name'])     ? $_POST['name']    : '';
        $address    = isset($_POST['address'])  ? $_POST['address'] : '';
        $gender     = isset($_POST['gender'])   ? $_POST['gender']  : '';
        $religion   = isset($_POST['religion']) ? $_POST['religion']: '';
        $school     = isset($_POST['school'])   ? $_POST['school']  : '';

        $query      =   "INSERT INTO anggota(nama, alamat, jeniskelamin, agama,  sekolah) ".
                        "VALUES('$name', '$address', '$gender', '$religion', '$school')";
        $insert     = $koneksi->query($query);
        if($insert){ ?>
            <div class="col-md-12">
                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                    Berhasil Tambah
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            <?php
        }else{ ?>
            <div class="col-md-12">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Gagal
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            <?php
        }
    }

    if(isset($_POST['update'])){
        $id         = isset($_POST['id'])       ? $_POST['id']      : '';
        $name       = isset($_POST['name'])     ? $_POST['name']    : '';
        $address    = isset($_POST['address'])  ? $_POST['address'] : '';
        $gender     = isset($_POST['gender'])   ? $_POST['gender']  : '';
        $religion   = isset($_POST['religion']) ? $_POST['religion']: '';
        $school     = isset($_POST['school'])   ? $_POST['school']  : '';


        $query      =   "UPDATE anggota ".
                        "SET nama='$name', alamat='$address', jeniskelamin='$gender', agama='$religion', sekolah='$school' ".
                        "WHERE id='$id'";
        $update     = $koneksi->query($query);
        if($update){ ?>
            <div class="col-md-12">
                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                    Berhasil Update
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            <?php
        }else{ ?>
            <div class="col-md-12">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Gagal
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            <?php
        }
    }

    if(isset($_POST['delete'])){
        $id         = $_POST['id'];
        $query      = "DELETE FROM anggota WHERE id = '$id'";
        $delete     = $koneksi->query($query);
        if($delete){ ?>
            <div class="col-md-12">
                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                    Berhasil Delete
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            <?php
        }else{ ?>
            <div class="col-md-12">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Gagal
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            <?php
        }
    }
    ?>


    <div class="col-md-12">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalInsert">Tambah</button>
    </div>
    <div class="col-md-12">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nama</th>
                <th scope="col">Alamat</th>
                <th scope="col">Jenis Kelamin</th>
                <th scope="col">Agama</th>
                <th scope="col">Sekolah</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
                $query  = "SELECT * FROM anggota";
                $rs     = $koneksi->query($query);
                while ($row = $rs->fetch_assoc()){ ?>

                    <tr>
                        <th scope="row"><?php echo $row['id']; ?></th>
                        <td><?php echo $row['nama']; ?></td>
                        <td><?php echo $row['alamat'] ?></td>
                        <td><?php echo $row['jeniskelamin']; ?></td>
                        <td><?php echo $row['agama']; ?></td>
                        <td><?php echo $row['sekolah']; ?></td>
                        <td><button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModalUpdate<?php echo $row['id']; ?>">Update</button>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModalUpdate<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <form action="index.php" method="post">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Tambah data siswa</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Nama</label>
                                                    <input type="text" class="form-control" id="exampleInputEmail1" name="name" value="<?php echo $row['nama']; ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputAddress">Alamat</label>
                                                    <textarea class="form-control" id="exampleInputAddress" rows="4" name="address" required><?php echo $row['alamat']; ?></textarea>
                                                </div>

                                                <div class="form-group">
                                                    <label>Jenis Kelamin</label>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="gender" id="exampleRadios1" value="Laki-laki" <?php echo $row['jeniskelamin']=='Laki-laki'?'checked':''; ?>>
                                                        <label class="form-check-label" for="exampleRadios1">
                                                            Laki-laki
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="gender" id="exampleRadios2" value="Perempuan" <?php echo $row['jeniskelamin']=='Perempuan'?'checked':''; ?>>
                                                        <label class="form-check-label" for="exampleRadios2">
                                                            Perempuan
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label>Agama</label>
                                                    <select class="custom-select" required name="religion">
                                                        <option value="" disabled <?php echo $row['agama']==''?'selected':''; ?>>Pilih Agama</option>
                                                        <option value="Hindu" <?php echo $row['agama']=='Hindu'?'selected':''; ?>>Hindu</option>
                                                        <option value="Islam" <?php echo $row['agama']=='Islam'?'selected':''; ?>>Islam</option>
                                                        <option value="Kristen Katolik" <?php echo $row['Kristen Katolik']==''?'selected':''; ?>>Kristen Katolik</option>
                                                        <option value="Kristen Protestan" <?php echo $row['agama']=='Kristen Protestan'?'selected':''; ?>>Kristen Protestan</option>
                                                        <option value="Budha" <?php echo $row['agama']=='Budha'?'selected':''; ?>>Budha</option>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Nama Sekolah</label>
                                                    <input type="text" class="form-control" id="exampleInputEmail1" name="school" required value="<?php echo $row['sekolah']!=''?$row['sekolah']:''; ?>" >
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <input type="hidden" value="<?php echo $row['id']; ?>" name="id">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary" name="update">Tambah</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalDelete<?php echo $row['id']; ?>">Delete</button>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModalDelete<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <form action="index.php" method="post">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Delete data siswa</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Yakin hapus?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-danger" name="delete">Delete</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                    </tr>

            <?php
                }
            ?>

            </tbody>
        </table>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModalInsert" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="index.php" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah data siswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputAddress">Alamat</label>
                        <textarea class="form-control" id="exampleInputAddress" rows="4" name="address" required></textarea>
                    </div>

                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" id="exampleRadios1" value="Laki-laki" checked>
                            <label class="form-check-label" for="exampleRadios1">
                                Laki-laki
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" id="exampleRadios2" value="Perempuan">
                            <label class="form-check-label" for="exampleRadios2">
                                Perempuan
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Agama</label>
                        <select class="custom-select" required name="religion">
                            <option value="" disabled selected>Pilih Agama</option>
                            <option value="Hindu">Hindu</option>
                            <option value="Islam">Islam</option>
                            <option value="Kristen Katolik">Kristen Katolik</option>
                            <option value="Kristen Protestan">Kristen Protestan</option>
                            <option value="Budha">Budha</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama Sekolah</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" name="school" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="add">Tambah</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>
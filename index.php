<?php
    //koneksi
    $server   = "localhost";
    $user     = "root";
    $pass     = "";
    $database = "db_data";

    $koneksi = mysqli_connect($server, $user, $pass, $database)or die(mysqli_error());


    //if button click
    if(isset($_POST['bsimpan']))
    {
        //pengujian
        if($_GET['hal'] == "edit")
        {
            //data akan di edit
            $edit = mysqli_query($koneksi, "UPDATE data_siswa SET
                                                nis     = '$_POST[tNIS]',       
                                                nama_siswa = '$_POST[tnama]',       
                                                jenis_kelamin = '$_POST[tjeniskelamin]',       
                                                alamat = '$_POST[talamat]',       
                                                id_jurusan = '$_POST[tidjurusan]',       
                                                jurusan = '$_POST[tjurusan]'
                                              WHERE id_siswa = '$_GET[id]'       
                                            ");
            if($edit)
            {
                echo "<script>
                alert('edit data berhasil!');
                document.location= 'index.php';
                </script>";                
            }
            else
            {
                echo "<script>
                alert('edit data gagal!');
                document.location= 'index.php';
                </script>";
            }
        }            
        else
        {
            //data akan di simpan baru
            $simpan = mysqli_query($koneksi, "INSERT INTO data_siswa (nis, nama_siswa, jenis_kelamin, alamat, id_jurusan, jurusan)
                                              VALUES ('$_POST[tNIS]', 
                                                      '$_POST[tnama]', 
                                                      '$_POST[tjeniskelamin]', 
                                                      '$_POST[talamat]', 
                                                      '$_POST[tidjurusan]', 
                                                      '$_POST[jurusan]')       
                                            ");
            if($simpan){
                echo "<script>
                alert('simpan data berhasil!');
                document.location= 'index.php';
                </script>";                
            }else{
                echo "<script>
                alert('simpan data gagal!');
                document.location= 'index.php';
                </script>";
            }
        }      
    }    
   

    //pengujian jika tombol edit/hapus di klik
    if(isset($_GET['hal']))
    {
        //keterangan tampil data yang akan di edit
        if($_GET['hal'] == 'edit')
        {
            //tampil data yang akan di edit
            $tampil = mysqli_query($koneksi, "SELECT * FROM data_siswa WHERE id_siswa = '$_GET[id]' ");
            $data = mysqli_fetch_array($tampil);
            if($data)
            {
                //jika data ditemukan
                $vNIS  = $data['nis'];
                $vnama = $data['nama_siswa'];
                $vjeniskelamin = $data['jenis_kelamin'];
                $valamat = $data['alamat'];
                $vidjurusan = $data['id_jurusan'];
                $vJurusan = $data['jurusan'];
            }
        }
    }
?>







<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        .text-center{
            margin-top:20px;
        }
    </style>

</head>
<body>
<div class="container">
    <h3 class="text-center">Data Siswa</h3>
    <h3 class="text-center">SMK Telkom Purwokerto</h3>
    <!--Awal Card 1-->
    <div class="card mt-3">
        <div class="card-header">
            <h5>Masukan Data Diri Anda</h5>
        </div>
        <div class="card-body ">
            <form method="POST" action="">                
                <div class="form-group mt-3">
                    <label>NIS</label>
                    <input type="text" name="tNIS" value="<?=@$vNIS?>" class="form-control" placeholder="Masukan NIS Anda" required>
                </div>
                <div class="form-group mt-3">
                    <label>Nama</label>
                    <input type="text" name="tnama" value="<?=@$vnama?>"class="form-control" placeholder="Masukan Nama Anda" required>
                </div>
                <div class="form-group mt-3">
                    <label>Jenis Kelamin</label>
                    <input type="text" name="tjeniskelamin" value="<?=@$vjeniskelamin?>" class="form-control" placeholder="Masukan Jenis Kelamin Anda" required>
                </div>
                <div class="form-group mt-3">
                    <label>Alamat</label>
                    <textarea class="form-control" name="talamat" placeholder="Masukan Alamat Anda"><?=@$valamat?></textarea>
                </div>
                <div class="form-group mt-3">
                    <label>ID Jurusan</label>
                    <input type="text" name="tidjurusan" value="<?=@$vidjurusan?>" class="form-control" placeholder="Masukan ID Jurusan Anda" required>
                </div>
                <div class="form-group mt-3">
                    <label>Jurusan</label>
                    <select class= "form-control" name="tjurusan" >
                        <option value="<?=@$vJurusan?>">--Pilih Jurasan--</option>
                        <option value="Rekayasa Perangkat Lunak">Rekayasa Perangkat Lunak</option>
                        <option value="Teknik Komputer Jaringan">Teknik Komputer Jaringan</option>
                        <option value="Teknik jaringan Akses">Teknik jaringan Akses</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-success mt-3" name="bsimpan">Simpan</button>
                <button type="reset" class="btn btn-primary mt-3" name="breset">Reset</button>
            </form>
        </div>`
    </div>
    <!--Akhir Card 1-->
    

     <!--Awal Card 2-->
     <div class="card mt-3 ">
        <div class="card-header bg-secondary">
            <h5>Daftar Data Diri SMK Telkom Purwokerto</h5>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <tr>
                    <th>No.</th>                    
                    <th>NIS</th>
                    <th>Nama</th>
                    <th>Jenis Kelamin</th>
                    <th>Alamat</th>
                    <th>ID Jurusan</th>
                    <th>Jurusan</th>
                    <th>Aksi</th>
                </tr>

                <?php
                    $no = 1;
                    $tampil = mysqli_query($koneksi, "SELECT * from data_siswa order by id_siswa desc");
                    while($data = mysqli_fetch_array($tampil))  :
                
                ?>

                <tr>
                    <td><?=$no++;?></td>                    
                    <td><?=$data['nis'];?></td>
                    <td><?=$data['nama_siswa'];?></td>
                    <td><?=$data['jenis_kelamin'];?></td>
                    <td><?=$data['alamat'];?></td>
                    <td><?=$data['id_jurusan'];?></td>
                    <td><?=$data['jurusan'];?></td>
                    <td>
                        <a href="index.php?hal=edit&id=<?=$data['id_siswa']?>" class="btn btn-warning">Edit</a>
                        <a href="#" class="btn btn-danger">Hapus</a>
                    </td>
                </tr>
            <?php endwhile;?>
            </table>
        </div>`
    </div>
    <!--Akhir Card 2-->



</div> 


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
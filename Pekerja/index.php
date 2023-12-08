<?php
include('../connection.php');
session_start();

if (!isset($_SESSION['logged_in'])) {
  header('location: login.php');
  exit;
}

if (isset($_GET['logout'])) {
  if (isset($_SESSION['logged_in'])) {
    unset($_SESSION['logged_in']);
    unset($_SESSION['email_Pekerja']);
    header('location: ../login.php');
    exit;
  }
}


if (isset($_POST['update'])) {
  $id_order = $_GET['id_order'];

  $query = "UPDATE `order` SET status = 'Sedang Dikerjakan' WHERE id_order = '$id_order'";

  $result = mysqli_query($conn, $query);

  if ($result) {
    header("location: index.php");
    exit;
  } else {
    // Terjadi kesalahan saat pembaruan data
    echo "Error: " . mysqli_error($conn);
  }
}

if (isset($_POST['update-selesai'])) {
  $id_order = $_GET['id_order'];

  $query = "UPDATE `order` SET status = 'Pekerja Selesai' WHERE id_order = '$id_order'";

  $result = mysqli_query($conn, $query);

  if ($result) {
    header("location: index.php");
    exit;
  } else {
    // Terjadi kesalahan saat pembaruan data
    echo "Error: " . mysqli_error($conn);
  }
}



$id_pekerja = $_SESSION['id_pekerja'];

$q_order = "SELECT * FROM `order` where status = 'menunggu'";
$r_order = mysqli_query($conn, $q_order);

$q_order1 = "SELECT * FROM `order` where status = 'Sedang Dikerjakan'";
$r_order1 = mysqli_query($conn, $q_order1);

include 'layouts/header.php';
?>

<section style="background-color: #eee;">
  <div class="container py-5">
    <div class="row">
      <div class="col">
        <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
          <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">User Profile</li>
          </ol>
        </nav>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-4">
        <div class="card mb-4">
          <div class="card-body text-center">
            <img src="pekerja/<?php echo $_SESSION['photo_pekerja'] ?>" alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
            <h5 class="my-3"><?php echo $_SESSION['nama_pekerja'] ?></h5>
            <p class="text-muted mb-1"><?php echo $_SESSION['no_telp'] ?></p>
            <div class="d-flex justify-content-center mb-2">
              <button type="button" class="btn btn-outline-primary ms-1">Edit</button>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-8">
        <div class="card mb-4">
          <div class="card-body">
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Full Name</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php echo $_SESSION['nama_pekerja'] ?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Email</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php echo $_SESSION['email_pekerja'] ?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Phone</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php echo $_SESSION['no_telp'] ?></p>
              </div>
            </div>
            <hr>

          </div>
        </div>
        <div class="p row text-center justify-content-center">
          <div class="card shadow mb-4">
            <div class="table-responsive">
              <h3 class="atas" style="margin-top: 15px;">Daftar Pekerjaan</h3>
              <table class="table  mt-4" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>ID Order</th>
                    <th>ID Layanan</th>
                    <th>ID Customer</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th colspan="2" class="text-center">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php while ($row = mysqli_fetch_assoc($r_order)) : ?>
                    <tr>
                      <td><?php echo $row['id_order']; ?></td>
                      <td><?php echo $row['id_layanan']; ?></td>
                      <td><?php echo $row['id_customer']; ?></td>
                      <td><?php echo $row['status']; ?></td>
                      <td><?php echo $row['tanggal']; ?></td>
                      <form method="POST" action="index.php?id_order=<?= $row['id_order'] ?>">
                        <td><button type="submit" name="update" class="btn btn-primary">Kerjakan</button></td>
                      </form>
                      <td> <button cl data-bs-toggle="modal" data-bs-target="#modal2<?= $row['id_order'] ?>" class="btn btn-primary ms-2">Details</button></td>
                    </tr>

                    <div class="modal fade" id="modal2<?= $row['id_order'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Detail Customer</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body ">
                            <div class=" mb-2">
                              <h2 for="tingkat" class="form-label"> <?php echo $row['nama'] ?> </h2>
                              <h5 for="tingkat" class="form-label">Alamat : <?php echo $row['alamat'] ?> </h5>
                              <h5 for="tingkat" class="form-label">Nomor Telephone Rumah : <?php echo $row['no_rumah'] ?> </h5>
                              <h5 for="tingkat" class="form-label">Nomor WhatsApp : <?php echo $row['no_wa'] ?> </h5>
                            </div>

                            <div class="modal-footer">
                              <form method="POST" action="index.php?id_order=<?= $row['id_order'] ?>">
                                <button type="submit" name="update" class="btn btn-primary">Kerjakan</button>
                              </form>
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php endwhile;  ?>
                </tbody>
              </table>
            </div>
          </div>
          <div class="row ">
            <div class="card shadow mb-4">
              <div class="table-responsive">
                <h3 class="atas" style="margin-top: 15px;">Pekerjaan Berlangsung</h3>
                <table class="table mt-4" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>ID Order</th>
                      <th>ID Layanan</th>
                      <th>ID Customer</th>
                      <th>Status</th>
                      <th>Tanggal</th>
                      <th colspan="2" class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php while ($row1 = mysqli_fetch_assoc($r_order1)) : ?>
                      <tr>
                        <td><?php echo $row1['id_order']; ?></td>
                        <td><?php echo $row1['id_layanan']; ?></td>
                        <td><?php echo $row1['id_customer']; ?></td>
                        <td><?php echo $row1['status']; ?></td>
                        <td><?php echo $row1['tanggal']; ?></td>
                        <form method="POST" action="index.php?id_order=<?= $row1['id_order'] ?>">
                          <td><button type="submit" name="update-selesai" class="btn btn-primary">Selesai</button></td>
                        </form>
                        <td> <button cl data-bs-toggle="modal" data-bs-target="#modal2<?= $row1['id_order'] ?>" class="btn btn-primary ms-2">Details</button></td>
                      </tr>

                      <div class="modal fade " style="text-align: left;" id="modal2<?= $row1['id_order'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Detail Customer</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body ">
                              <div class=" mb-2">
                                <h2 for="tingkat" class="form-label"> <?php echo $row1['nama'] ?> </h2>
                                <h5 for="tingkat" class="form-label">Alamat : <?php echo $row1['alamat'] ?> </h5>
                                <h5 for="tingkat" class="form-label">Nomor Telephone Rumah : <?php echo $row1['no_rumah'] ?> </h5>
                                <h5 for="tingkat" class="form-label">Nomor WhatsApp : <?php echo $row1['no_wa'] ?> </h5>
                              </div>

                              <div class="modal-footer">
                                <form method="POST" action="index.php?id_order=<?= $row1['id_order'] ?>">
                                  <button type="submit" name="update-selesai" class="btn btn-primary">Selesai</button>
                                </form>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    <?php endwhile;  ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</section>


<?php
include 'layouts/footer.php';
?>
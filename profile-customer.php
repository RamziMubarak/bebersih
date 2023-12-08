<?php
include('connection.php');
session_start();



$id_customer = $_SESSION['id_customer'];

// Query untuk mencari berdasarkan id_layanan
$q_order = "SELECT order.id_order, layanan.nama_layanan , order.Total, order.status FROM `order` JOIN layanan on order.id_layanan = layanan.id_layanan WHERE id_customer = '$id_customer'";
$r_order = mysqli_query($conn, $q_order);

if (!$r_order) {
  echo "Error: " . mysqli_error($conn);
  exit; // Hentikan eksekusi skrip jika terjadi kesalahan
}




include 'layouts/header.php';
?>

<section style="background-color: #eee;">
  <div class="container py-5">
    <div class="row">
      <div class="col">
        <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
          <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Pesanan
            <li>
          </ol>
        </nav>
      </div>
    </div>

    <div class="p row">
      <div class="col-lg-4">
        <div class="card mb-4">
          <div class="card-body text-center">
            <img src="img/customer/<?php echo $_SESSION['photo_customer'] ?>" alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
            <h5 class="my-3"><?php echo $_SESSION['nama_customer'] ?></h5>
            <p class="text-muted mb-1"><?php echo $_SESSION['no_telp'] ?></p>
            <p class="text-muted mb-4"><?php echo $_SESSION['alamat'] ?></p>
            <div class="d-flex justify-content-center mb-2">
              <button type="button" class="btn btn-outline-primary ms-1" data-bs-toggle="modal" data-bs-target="#modal<?php echo $_SESSION['id_customer'] ?>">Edit</button>
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
                <p class="text-muted mb-0"><?php echo $_SESSION['nama_customer'] ?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Email</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php echo $_SESSION['email_customer'] ?></p>
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
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Address</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php echo $_SESSION['alamat'] ?></p>
              </div>
            </div>
          </div>
        </div>
        <div class="row ">
          <div class="col-md-6" style="width: 1000px;">
            <div class="card mb-4 mb-md-0">
              <div class="card-body">
                <h3 class="mb-4">Riwayat Pesanan
                </h3>
                <table class="table" id="dataTable" width="100%" cellspacing="0">
                  <thead class="text-center">
                    <tr>
                      <th>ID Order</th>
                      <th>Nama</th>
                      <th>Biaya</th>
                      <th>Status</th>

                    </tr>

                    <?php while ($row = mysqli_fetch_assoc($r_order)) : ?>
                      <tr>
                        <td>
                          <h5> <?php echo $row["id_order"]; ?> </h5>
                        </td>
                        <td>
                          <h5> <?php echo $row["nama_layanan"]; ?> </h5>
                        </td>
                        <td>
                          <h5> <?php echo $row['Total']; ?> </h5>
                        </td>
                        <td>
                          <h5> <?php echo $row['status']; ?> </h5>
                        </td>
                      </tr>
                    <?php endwhile; ?>

                </table>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>

    <div class="modal fade" id="modal<?= $_SESSION['id_customer'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="p modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Customer </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="edit-customer.php?id_customer=<?php echo $_SESSION['id_customer'] ?>" method="POST" enctype="multipart/form-data">
              <div class="mb-3">
                <label for="nama" class="form-label">Nama : </label>
                <input name="nama_customer" type="text" class="form-control" placeholder="<?php echo $_SESSION['nama_customer'] ?>">
              </div>
              <div class="mb-3">
                <label for="nama" class="form-label">Password : </label>
                <input name="password_customer" type="text" class="form-control">
              </div>
              <div class="mb-3">
                <label for="nama" class="form-label">Alamat : </label>
                <input name="alamat" type="text" class="form-control">
              </div>
              <div class="mb-3">
                <label for="nama" class="form-label">No.Telepon : </label>
                <input name="no_telp" type="text" class="form-control">
              </div>
              <div class="mb-3">
                <label for="mail">Picture</label>
                <input type="file" name="photo_customer" class="form-control my-3">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit"  class="btn btn-primary">Submit</button>
              </div>
            </form>

          </div>
        </div>
      </div>



    </div>
</section>


<?php
include 'layouts/footer.php';
?>
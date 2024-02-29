<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="../dashboard/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../dashboard/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../dashboard/index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Admin</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="../dashboard/index.html">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">Transaksi</div>

            <!-- Nav Item - Pembelian Barang -->
            <li class="nav-item">
                <a class="nav-link" href="../admin/pembelian_barang.php">
                    <i class="fas fa-shopping-cart"></i> <!-- Mengganti kelas ikon dengan yang sesuai -->
                    <span>Pembelian Barang</span>
                </a>
            </li>

            <!-- Nav Item - Penjualan Barang -->
            <li class="nav-item">
                <a class="nav-link" href="../admin/penjualan_barang.php">
                    <i class="fas fa-store"></i> <!-- Mengganti kelas ikon dengan yang sesuai -->
                    <span>Penjualan Barang</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">Data</div>

            <!-- Nav Item - Data User -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="../admin/data_user.php">
                    <i class="fas fa-user"></i>
                    <span>Data User</span>
                </a>
            </li>

            <!-- Nav Item - Data Barang -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="../admin/data_barang.php">
                    <i class="fas fa-archive"></i> <!-- Mengganti kelas ikon dengan yang sesuai -->
                    <span>Data Barang</span>
                </a>
            </li>

            <!-- Nav Item - Data Pelanggan -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="../admin/data_pelanggan.php">
                    <i class="fas fa-users"></i> <!-- Mengganti kelas ikon dengan yang sesuai -->
                    <span>Data Pelanggan</span>
                </a>
            </li>

            <!-- Nav Item - Data Supplier -->
            <li class="nav-item">
                <a class="nav-link" href="../admin/data_supplier.php">
                    <i class="fas fa-truck"></i> <!-- Mengganti kelas ikon dengan yang sesuai -->
                    <span>Data Supplier</span>
                </a>
            </li>

            <!-- Nav Item - Stok Barang -->
            <li class="nav-item">
                <a class="nav-link" href="../admin/toko.php">
                    <i class="fas fa-cubes"></i> <!-- Mengganti kelas ikon dengan yang sesuai -->
                    <span>Toko</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Admin</span>
                                <img class="img-profile rounded-circle" src="../dashboard/img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="../log.php" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <!DOCTYPE html>
                    <html lang="en">

                    <head>
                        <meta charset="UTF-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <title>Data Supplier</title>
                        <style>
                            table {
                                width: 100%;
                                border-collapse: collapse;
                                margin-top: 20px;
                                margin-right: 20px;
                            }

                            th,
                            td {
                                border: 1px solid #ddd;
                                padding: 8px;
                                text-align: left;
                                color: #000;
                            }

                            th {
                                background-color: #f2f2f2;
                            }

                            button {
                                padding: 5px 10px;
                                margin-right: 5px;
                            }
                        </style>
                    </head>

                    <body>

                        <h2>Data Supplier</h2>

                        <a href="tambah_suplier.php"><button onclick="tambahSuplier()" class='btn btn-primary'>Tambah Supplier</button></a>

                        <table id="tabelSupplier">
                            <tr>
                                <th>Supplier ID</th>
                                <th>Toko ID</th>
                                <th>Nama Supplier</th>
                                <th>Nomor HP</th>
                                <th>Alamat Supplier</th>
                                <th>Created At</th>
                                <th>Aksi</th>
                            </tr>
                            <!-- Static data for demonstration -->
                            <?php
                            include 'koneksi.php';

                            // Query untuk mengambil data supplier
                            $sql = "SELECT * FROM suplier";
                            $result = $conn->query($sql);

                            // Tampilkan data dalam tabel
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $row["suplier_id"] . "</td>";
                                    echo "<td>" . $row["toko_id"] . "</td>";
                                    echo "<td>" . $row["nama_suplier"] . "</td>";
                                    echo "<td>" . $row["tlp_suplier"] . "</td>";
                                    echo "<td>" . $row["alamat_suplier"] . "</td>";
                                    echo "<td>" . $row["created_at"] . "</td>";
                                    echo "<td>
                                        <a href='edit_data_supplier.php?id=" . $row["suplier_id"] . "' class='btn btn-success btn-sm'>Edit</a>
                                        <a href='hapus_supplier.php?id=" . $row["suplier_id"] . "' class='btn btn-danger btn-sm' onclick=\"return confirm('Apakah Anda yakin ingin menghapus data ini?')\">Delete</a>
                                     </td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='7'>Tidak ada data supplier.</td></tr>";
                            }

                            // Tutup koneksi
                            $conn->close();
                            ?>
                            <!-- Add more rows for additional data -->
                        </table>


                    </body>

                    </html>



                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">

                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="../log.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Mengambil URL halaman saat ini
        var currentUrl = window.location.href;

        // Mengambil semua elemen sidebar yang memiliki link
        var sidebarLinks = document.querySelectorAll('.nav-link[href]');

        // Iterasi melalui setiap link sidebar
        sidebarLinks.forEach(function(link) {
            // Jika URL saat ini cocok dengan URL link di sidebar
            if (currentUrl === link.href) {
                // Tambahkan kelas 'active' pada elemen li yang bersangkutan
                link.parentNode.classList.add('active');
            }
        });
    </script>

    <!-- Bootstrap core JavaScript-->
    <script src="../dashboard/vendor/jquery/jquery.min.js"></script>
    <script src="../dashboard/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../dashboard/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../dashboard/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../dashboard/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../dashboard/js/demo/chart-area-demo.js"></script>
    <script src="../dashboard/js/demo/chart-pie-demo.js"></script>

</body>

</html>
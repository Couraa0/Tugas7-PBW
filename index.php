<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>T7PBW</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .card {
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            border-radius: 0.5rem;
            border: none;
            margin-top: 25px;
        }
        .table {
            vertical-align: middle;
        }
        .action-buttons .btn {
            margin-right: 5px;
        }
        .badge-sks {
            font-size: 0.8em;
            padding: 5px 10px;
            border-radius: 10px;
            background-color: #6c757d;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card mb-4">
            <div class="card-body">
                <?php
                if (isset($_GET['status'])) {
                    if ($_GET['status'] == 'success') {
                        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                                <i class='fas fa-check-circle me-2'></i>" . $_GET['message'] . "
                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                              </div>";
                    } else if ($_GET['status'] == 'error') {
                        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                <i class='fas fa-exclamation-circle me-2'></i>" . $_GET['message'] . "
                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                              </div>";
                    }
                }
                ?>
                
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="card-title mb-0">Data KRS Mahasiswa</h3>
                    <a href="tambah.php" class="btn btn-primary">
                        <i class="fas fa-plus-circle me-2"></i>Tambah Data
                    </a>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th width="5%">No</th>
                                <th width="20%">Nama Lengkap</th>
                                <th width="20%">Mata Kuliah</th>
                                <th width="40%">Keterangan</th>
                                <th width="15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $query = "SELECT krs.id, m.nama AS nama_mhs, mk.nama AS nama_mk, mk.jumlah_sks 
                                    FROM krs 
                                    JOIN mahasiswa m ON krs.mahasiswa_npm = m.npm 
                                    JOIN matakuliah mk ON krs.matakuliah_kodemk = mk.kodemk";
                            $result = mysqli_query($conn, $query);
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>
                                            <td class='text-center'>$no</td>
                                            <td>{$row['nama_mhs']}</td>
                                            <td>{$row['nama_mk']}</td>
                                            <td>
                                                <span class='fw-bold text-primary'>{$row['nama_mhs']}</span> 
                                                mengambil mata kuliah 
                                                <span class='fw-bold text-primary'>{$row['nama_mk']}</span> 
                                                <span class='badge bg-info text-dark badge-sks'>{$row['jumlah_sks']} SKS</span>
                                            </td>
                                            <td class='action-buttons'>
                                                <a href='edit.php?id={$row['id']}' class='btn btn-warning btn-sm'>
                                                    <i class='fas fa-edit'></i> Edit
                                                </a>
                                                <a href='hapus.php?id={$row['id']}' class='btn btn-danger btn-sm'>
                                                    <i class='fas fa-trash'></i> Hapus
                                                </a>
                                            </td>
                                        </tr>";
                                    $no++;
                                }
                            } else {
                                echo "<tr><td colspan='5' class='text-center py-3'>Tidak ada data KRS</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
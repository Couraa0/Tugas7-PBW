<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Data KRS</title>
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
            max-width: 700px;
            margin: 0 auto;
            margin-top: 100px;
        }
        .btn {
            border-radius: 0.25rem;
            padding: 0.5rem 1.5rem;
        }
        .form-label {
            font-weight: 500;
        }
        .form-control:focus, .form-select:focus {
            border-color: #2575fc;
            box-shadow: 0 0 0 0.25rem rgba(37, 117, 252, 0.25);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0"><i class="fas fa-plus-circle me-2"></i>Tambah Data KRS</h4>
                    </div>
                    <div class="card-body p-4">
                        <?php
                        if (isset($_POST['simpan'])) {
                            $npm = $_POST['npm'];
                            $kodemk = $_POST['kodemk'];

                            $insert = mysqli_query($conn, "INSERT INTO krs (mahasiswa_npm, matakuliah_kodemk) VALUES ('$npm', '$kodemk')");
                            if ($insert) {
                                echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                                        <i class='fas fa-check-circle me-2'></i>Data berhasil ditambahkan!
                                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                      </div>";
                                echo "<meta http-equiv='refresh' content='2;url=index.php'>";
                            } else {
                                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                        <i class='fas fa-exclamation-circle me-2'></i>Gagal menyimpan data: " . mysqli_error($conn) . "
                                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                      </div>";
                            }
                        }
                        ?>

                        <form method="POST">
                            <div class="mb-4">
                                <label class="form-label">Mahasiswa</label>
                                <select name="npm" class="form-select" required>
                                    <option value="">-- Pilih Mahasiswa --</option>
                                    <?php
                                    $result = mysqli_query($conn, "SELECT * FROM mahasiswa ORDER BY nama ASC");
                                    while ($mhs = mysqli_fetch_assoc($result)) {
                                        echo "<option value='{$mhs['npm']}'>{$mhs['npm']} - {$mhs['nama']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Mata Kuliah</label>
                                <select name="kodemk" class="form-select" required>
                                    <option value="">-- Pilih Mata Kuliah --</option>
                                    <?php
                                    $result = mysqli_query($conn, "SELECT * FROM matakuliah ORDER BY nama ASC");
                                    while ($mk = mysqli_fetch_assoc($result)) {
                                        echo "<option value='{$mk['kodemk']}'>{$mk['kodemk']} - {$mk['nama']} ({$mk['jumlah_sks']} SKS)</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="d-flex mt-4">
                                <button type="submit" name="simpan" class="btn btn-success me-2">
                                    <i class="fas fa-save me-2"></i>Simpan
                                </button>
                                <a href="index.php" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left me-2"></i>Kembali
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
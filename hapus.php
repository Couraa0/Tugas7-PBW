<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Tambahkan konfirmasi hapus dengan parameter konfirmasi
    if (isset($_GET['confirm']) && $_GET['confirm'] == 'yes') {
        $delete = mysqli_query($conn, "DELETE FROM krs WHERE id = '$id'");
        
        if ($delete) {
            header("Location: index.php?status=success&message=Data berhasil dihapus");
        } else {
            header("Location: index.php?status=error&message=Gagal menghapus data: " . mysqli_error($conn));
        }
    } else {
        // Ambil data KRS yang akan dihapus untuk informasi
        $query = "SELECT m.nama AS nama_mhs, mk.nama AS nama_mk
                  FROM krs 
                  JOIN mahasiswa m ON krs.mahasiswa_npm = m.npm 
                  JOIN matakuliah mk ON krs.matakuliah_kodemk = mk.kodemk
                  WHERE krs.id = '$id'";
        $result = mysqli_query($conn, $query);
        $data = mysqli_fetch_assoc($result);
        
        // Tampilkan halaman konfirmasi dengan desain yang lebih baik
?>
<!DOCTYPE html>
<html>
<head>
    <title>Konfirmasi Hapus Data KRS</title>
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
        .card-header {
            background: linear-gradient(135deg, #ff416c 0%, #ff4b2b 100%);
            color: white;
            border-radius: 0.5rem 0.5rem 0 0 !important;
        }
        .btn-danger {
            background: linear-gradient(135deg, #ff416c 0%, #ff4b2b 100%);
            border: none;
        }
        .danger-icon {
            font-size: 3rem;
            color: #ff4b2b;
            margin-bottom: 1rem;
        }
        .btn {
            border-radius: 0.25rem;
            padding: 0.5rem 1.5rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-exclamation-triangle me-2"></i>Konfirmasi Hapus</h5>
            </div>
            <div class="card-body text-center p-4">
                <div class="danger-icon">
                    <i class="fas fa-trash-alt"></i>
                </div>
                
                <h4 class="mb-3">Anda yakin ingin menghapus data ini?</h4>
                
                <?php if ($data): ?>
                <div class="alert alert-warning">
                    <p class="mb-1"><strong>Mahasiswa:</strong> <?php echo $data['nama_mhs']; ?></p>
                    <p class="mb-0"><strong>Mata Kuliah:</strong> <?php echo $data['nama_mk']; ?></p>
                </div>
                <?php endif; ?>
                
                <p class="text-muted mb-4">Tindakan ini tidak dapat dibatalkan!</p>
                
                <div class="d-flex justify-content-center gap-3">
                    <a href="hapus.php?id=<?php echo $id; ?>&confirm=yes" class="btn btn-danger">
                        <i class="fas fa-trash me-2"></i>Ya, Hapus Data
                    </a>
                    <a href="index.php" class="btn btn-secondary">
                        <i class="fas fa-times me-2"></i>Batal
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
    }
} else {
    header("Location: index.php");
}
?>
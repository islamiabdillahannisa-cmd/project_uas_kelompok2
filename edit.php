<?php
include 'koneksi.php';

$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM barang WHERE id = $id");
$row = mysqli_fetch_assoc($result);

if (isset($_POST['update'])) {
    $kode   = mysqli_real_escape_string($conn, $_POST['kode_barang']);
    $nama   = mysqli_real_escape_string($conn, $_POST['nama_barang']);
    $kategori = mysqli_real_escape_string($conn, $_POST['kategori']);
    $jumlah = $_POST['jumlah'];
    $harga  = $_POST['harga_satuan'];
    $tanggal = $_POST['tanggal_masuk'];

    $query = "UPDATE barang SET 
                kode_barang = '$kode', 
                nama_barang = '$nama', 
                kategori = '$kategori', 
                jumlah = '$jumlah', 
                harga_satuan = '$harga', 
                tanggal_masuk = '$tanggal' 
              WHERE id = $id";
    
    if (mysqli_query($conn, $query)) {
        header("Location: index.php");
        exit;
    } else {
        $error = "Gagal memperbarui data: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5" style="max-width: 600px;">
        <div class="card shadow-sm">
            <div class="card-body">
                <h3 class="mb-4">Edit Data Barang</h3>
                <?php if (isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
                <form action="" method="POST">
                    <div class="mb-3">
                        <label class="form-label">Kode Barang</label>
                        <input type="text" name="kode_barang" class="form-control" value="<?= htmlspecialchars($row['kode_barang']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Barang</label>
                        <input type="text" name="nama_barang" class="form-control" value="<?= htmlspecialchars($row['nama_barang']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kategori</label>
                        <input type="text" name="kategori" class="form-control" value="<?= htmlspecialchars($row['kategori']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jumlah Stok</label>
                        <input type="number" name="jumlah" class="form-control" value="<?= $row['jumlah']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Harga Satuan (Rp)</label>
                        <input type="number" step="0.01" name="harga_satuan" class="form-control" value="<?= $row['harga_satuan']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tanggal Masuk</label>
                        <input type="date" name="tanggal_masuk" class="form-control" value="<?= $row['tanggal_masuk']; ?>" required>
                    </div>
                    <button type="submit" name="update" class="btn btn-success">Perbarui</button>
                    <a href="index.php" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
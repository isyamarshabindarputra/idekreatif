<?php
// Menyertakan header dalam halaman include
include '.includes/header.php';
?>

<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Judul halaman -->
    <div class="row">
        <!-- Form untuk menambahkan postingan baru -->
        <div class="col-md-10">
            <div class="card mb-4">
                <div class="card-body">
                    <form method="POST" action="proses_post.php" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="post_title" class="form-label">Judul Postingan</label>
                            <input type="text" class="form-control" id="post_title" name="post_title" required>
                        </div>

                        <div class="mb-3">
                            <label for="fromFile" class="form-label">Unggah Gambar</label>
                            <input class="form-control" type="file" id="fromFile" name="image" accept="image/*">
                        </div>

                        <div class="mb-3">
                            <label for="category_id" class="form-label">Kategori</label>
                            <select class="form-select" name="category_id" id="category_id" required>
                                <option value="" selected disabled>Pilih salah satu</option>
                                <?php
                                include 'config.php'; // Pastikan koneksi database sudah disertakan
                                $query = "SELECT * FROM categories";
                                $result = mysqli_query($conn, $query);
                                if ($result->num_rows > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo '<option value="' . $row['category_id'] . '">' . htmlspecialchars($row['category_name']) . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="post_content" class="form-label">Konten</label>
                            <textarea class="form-control" id="post_content" name="content" required></textarea>
                        </div>

                        <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include '.includes/footer.php';
?>

<?php
include 'config.php';
include '.includes/header.php';

$postId = isset($_GET['post_id']) ? intval($_GET['post_id']) : 0;

$query = "SELECT * FROM posts WHERE id_post = '$postId'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    echo "Post not found";
    exit();
}
?>

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-md-10">
            <div class="card mb-4">
                <div class="card-body">
                    <form method="POST" action="proses_post.php" enctype="multipart/form-data">
                        <input type="hidden" name="post_id" value="<?= $row['id_post']; ?>">
                        
                        <div class="mb-3">
                            <label for="post_title" class="form-label">Judul Post</label>
                            <input type="text" class="form-control" id="post_title" name="post_title" value="<?= htmlspecialchars($row['post_title']); ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="fromFile" class="form-label">Unggah Gambar</label>
                            <input class="form-control" type="file" id="fromFile" name="image_path" accept="image/*">
                            
                            <?php if (!empty($row['image_path'])): ?>
                                <div class="mt-3">
                                    <img src="<?= htmlspecialchars($row['image_path']); ?>" alt="Current Image" class="img-thumbnail" style="max-width: 200px;">
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="mb-3">
                            <label for="category_id" class="form-label">Kategori</label>
                            <select class="form-select" name="category_id" id="category_id" required>
                                <option value="" selected disabled>Select one</option>
                                
                                <?php
                                $queryCategories = "SELECT * FROM categories";
                                $resultCategories = $conn->query($queryCategories);

                                if ($resultCategories->num_rows > 0) {
                                    while ($category = $resultCategories->fetch_assoc()) {
                                        $selected = ($category['id_category'] == $row['category_id']) ? 'selected' : '';
                                        echo "<option value='" . $category['id_category'] . "' $selected>" . htmlspecialchars($category['category_name']) . "</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="content" class="form-label">Konten</label>
                            <textarea class="form-control" id="content" name="content" required><?= htmlspecialchars($row['content']); ?></textarea>
                        </div>

                        <button type="submit" name="update" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include '.includes/footer.php';
?>

<?php
include 'config.php';
session_start();
$userId = $_SESSION['user_id'];

// Menyimpan Postingan Baru
if (isset($_POST['simpan'])) {
    $postTitle = $_POST['post_title'];
    $content = $_POST['content'];
    $categoryId = $_POST['category_id'];
    $imageDir = "assets/img/uploads/";
    $imageName = $_FILES['image']['name'];
    $imagePath = $imageDir . basename($imageName);
    

    if (move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
        $query = "INSERT INTO posts (post_title, content, created_at, category_id, user_id, image_path) 
                    VALUES ('$postTitle', '$content', NOW(), $categoryId, $userId, '$imagePath')";

        if ($conn->query($query) === TRUE) {
            $_SESSION['notification'] = [
                'type' => 'primary',
                'message' => 'Post berhasil ditambahkan'
            ];
        } else {
            $_SESSION['notification'] = [
                'type' => 'danger',
                'message' => 'Error adding post: ' . $conn->error
            ];
        }
    } else {
        $_SESSION['notification'] = [
            'type' => 'danger',
            'message' => 'Failed to upload image'
        ];
    }

    header('Location: dashboard.php');
    exit();
}

// Menghapus Postingan
if (isset($_POST['delete'])) {
    $postID = $_POST['post_id'];
    $exec = mysqli_query($conn, "DELETE FROM posts WHERE id_post = '$postID'");

    if ($exec) {
        $_SESSION['notification'] = [
            'type' => 'primary',
            'message' => 'Post berhasil dihapus'
        ];
    } else {
        $_SESSION['notification'] = [
            'type' => 'danger',
            'message' => 'Error deleting post: ' . mysqli_error($conn)
        ];
    }

    header('Location: dashboard.php');
    exit();
}

// Memperbarui Postingan
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $postId = $_POST['post_id'];
    $postTitle = $_POST['post_title'];
    $content = $_POST['content'];
    $categoryId = $_POST['category_id'];
    $imageDir = "assets/img/uploads/";
    $imageName = $_FILES['image']['name'];
    $imagePath = $imageDir . basename($imageName);

    if (!empty($imageName) && move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
        // Update dengan gambar baru
        $query = "UPDATE posts 
                    SET post_title = '$postTitle', content = '$content', category_id = '$categoryId', image_path = '$imagePath' 
                    WHERE id_post = '$postId'";
    } else {
        // Update tanpa mengubah gambar
        $query = "UPDATE posts 
                    SET post_title = '$postTitle', content = '$content', category_id = '$categoryId' 
                    WHERE id_post = '$postId'";
    }

    if ($conn->query($query) === TRUE) {
        $_SESSION['notification'] = [
            'type' => 'primary',
            'message' => 'Post berhasil diperbarui'
        ];
    } else {
        $_SESSION['notification'] = [
            'type' => 'danger',
            'message' => 'Error updating post: ' . $conn->error
        ];
    }

    header('Location: dashboard.php');
    exit();
}

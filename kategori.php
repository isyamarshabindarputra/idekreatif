<?php

include '.includes/header.php';
include '.includes/toast_notification.php';
?>

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div calss="card-header d-flex justify-content-between align-items-center">
            <h4>Data kategori</h4>
            <button type="button" calss="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCategory">tambah kategori</button>
        </div>
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table id="datatable" class="table table-hover">
                <thead>
                    <tr class="text-center">
                        <th width="50px">#</th>
                        <th>nama</th>
                        <th width="150px">pilihan</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                <?php
                $index = 1;
                $query ="SELECT * FROM categories";
                $exec = mysqli_query($conn, $query);
                while($category = mysqli_fetch_assoc($exec)) :
                ?>
                <tr>
                    <td><?=$index++; ?></td>
                    <td><?=$category['category_name']; ?></td>
                    <td>
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>   
                            <div class="dropdown-menu">
                                <a href="#" class="dropdown-item" data-bs-toggel="modal" data-bs-target="#editcategory_<?=$category['category_id'];?>"><i class="bx bx-edit-alt me-2"></i>edit</a>
                                <a href="#" class="dropdown-item" data-bs-toggel="modal" data-bs-target="#deletecategory_<?=$category['category_id'];?>"><i class="bx bx-trash me-2"></i>delete</a> 
                            </div>
                        </div>
                    </td>
                </tr>
                <?php endwhile; ?>
                </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php include'.includes/footer.php'; ?>

<!-- modal untuk tambah data kategori -->
<div class="modal fade" id="addCategory" tabinex="-1" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Tambah Data</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal">
				</button>
			</div>
			<div class="modal-body">
				<form action="proses_kategori.php" method="POST">
					<div>
						<label for="namaKategori" class="form-label">Nama Kategori</label>
						<!-- input untuk nama kategori baru -->
						<input type="text" class="form-control" name="category_name" required />
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-outline-secondary"
							data-bs-dismiss="modal">Batal</button>
						<button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
					</div>
				</form>
            </table>
			</div>
		</div>
	</div>
</div>
<!-- Modal untuk hapus Data Kategori -->
<div class="modal fade" id="editCategory_<?php echo $category['category_id']; ?>" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">hapus Kategori</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="proses_kategori.php" method="POST">
                    <!-- Input tersembunyi untuk menyimpan ID kategori -->
                    <input type="hidden" name="catID" value="<?php echo $category['category_id']; ?>">
                    
                    <div class="form-group">
                        <label>Nama Kategori</label>
                        <!-- Input untuk nama kategori -->
                        <input type="text" value="<?php echo $category['category_name']; ?>" name="category_name" class="form-control">
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" name="update" class="btn btn-warning">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
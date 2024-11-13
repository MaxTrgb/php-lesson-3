<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'];
    $folderName = $_POST['folder_name'];
    $message = '';

    if ($action === 'create') {
        $message = createFolder($folderName);
    } elseif ($action === 'delete') {
        $message = deleteFolder($folderName);
    } elseif ($action === 'upload' && isset($_FILES['image'])) {
        $message = uploadImage($folderName, $_FILES['image']);
    }
}
?>

<h1>Manage Folders and Upload Images</h1>

<?php if (isset($message)): ?>
    <div class="alert alert-info"><?php echo $message; ?></div>
<?php endif; ?>

<form action="index.php?page=homework" method="POST" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="folder_name" class="form-label">Folder Name</label>
        <input type="text" class="form-control" id="folder_name" name="folder_name" required>
    </div>

    <div class="mb-3">
        <label for="image" class="form-label">Upload Image</label>
        <input type="file" class="form-control" id="image" name="image">
    </div>

    <button type="submit" name="action" value="create" class="btn btn-primary">Create Folder</button>
    <button type="submit" name="action" value="delete" class="btn btn-danger">Delete Folder</button>
    <button type="submit" name="action" value="upload" class="btn btn-success">Upload Image</button>
</form>

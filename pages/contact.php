<h1>Contact page</h1>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $image = $_FILES['image'];
    if ($image['error'] !== 0) {
        $_SESSION['error'] = 'An error occurred during file upload.';
        redirect('contact');
    }

    $allowTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
    if (!in_array($image['type'], $allowTypes)) {
        $_SESSION['error'] = 'File type not allowed.';
        redirect('contact');
    }

    $fileExtension = pathinfo($image['name'], PATHINFO_EXTENSION);
    $fName = time() . '.' . $fileExtension;

    if (!move_uploaded_file($image['tmp_name'], 'uploads/' . $fName)) {
        $_SESSION['error'] = 'File not uploaded.';
        redirect('contact');
    }
    
    $_SESSION['success'] = 'File uploaded successfully.';
    redirect('contact');
}

?>

<?php if (isset($_SESSION['error'])): ?>
    <div class="alert alert-danger">
        <?php echo $_SESSION['error']; ?>
    </div>
    <?php unset($_SESSION['error']); ?>
<?php endif; ?>

<form action="index.php?page=contact" method="post" enctype="multipart/form-data">
    <div class="mb-3">
        <label class="form-label" for="image">image</label>
        <input type="file" class="form-control" name="image"></label>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
<?php
include("config.php");

$c1 = new Config();
$data = $c1->fetchImages();

if (isset($_POST['delete'])) {
    $id = $_POST["id"];
    if ($c1->delete($id)) {
        echo "<script>alert('Image deleted successfully.');</script>";
    } else {
        echo "<script>alert('Failed to delete image.');</script>";
    }

    // Refresh the page
    header("Location: index.php");
    exit;
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Image Gallery</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">Image Gallery</h1>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Preview</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php if ($data && mysqli_num_rows($data) > 0): ?>
            <?php while ($rec = mysqli_fetch_assoc($data)): ?>
                <tr>
                    <td><?php echo htmlspecialchars($rec["id"]); ?></td>
                    <td><?php echo htmlspecialchars($rec["name"]); ?></td>
                    <td><img src="<?php echo htmlspecialchars($rec["path"]); ?>" height="100" alt="Image"></td>
                    <td>
                        <form method="POST">
                            <input type="hidden" name="id" value="<?php echo $rec["id"]; ?>">
                            <button type="submit" name="delete" class="btn btn-danger"
                                    onclick="return confirm('Are you sure you want to delete this image?')">Delete
                            </button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="4" class="text-center">No images found.</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

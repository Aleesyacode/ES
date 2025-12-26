<?php
$pageTitle = 'Data Gejala';
include 'includes/header.php';

if (isset($_POST['add_symptom'])) {
    $code = $_POST['code'];
    $name = $_POST['name'];
    $cf   = $_POST['cf_expert'];

    $stmt = $conn->prepare("INSERT INTO symptoms (code, name, cf_expert) VALUES (?, ?, ?)");
    $stmt->bind_param("ssd", $code, $name, $cf);
    
    if ($stmt->execute()) {
        echo "<script>alert('Gejala berhasil ditambahkan!'); window.location='symptoms.php';</script>";
    } else {
        echo "<div class='alert alert-danger'>Failed to add data.</div>";
    }
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM symptoms WHERE id = $id");
    echo "<script>window.location='symptoms.php';</script>";
}
?>

<div class="container mt-4 mb-5">
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="bi bi-plus-circle me-2"></i>Add Symptoms</h5>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <div class="mb-3">
                            <label class="form-label">Symptom Code</label>
                            <input type="text" name="code" class="form-control" placeholder="Example: GJL-01" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Name of Symptom</label>
                            <textarea name="name" class="form-control" rows="2" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Expert CF Value (0.1 - 1.0)</label>
                            <input type="number" step="0.1" min="0" max="1" name="cf_expert" class="form-control" placeholder="0.8" required>
                        </div>
                        <button type="submit" name="add_symptom" class="btn btn-primary w-100">Save</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white">
                    <h5 class="mb-0 text-primary"><i class="bi bi-list-ul me-2"></i>Symptom List</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Code</th>
                                    <th>Name of Symptom</th>
                                    <th>CF</th>
                                    <th width="100">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $result = $conn->query("SELECT * FROM symptoms ORDER BY code ASC");
                                while ($row = $result->fetch_assoc()) {
                                ?>
                                <tr>
                                    <td><span class="badge bg-secondary"><?= $row['code'] ?></span></td>
                                    <td><?= $row['name'] ?></td>
                                    <td><strong><?= $row['cf_expert'] ?></strong></td>
                                    <td>
                                        <a href="symptoms.php?delete=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete it, dude?')">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
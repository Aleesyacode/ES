<?php
$pageTitle = 'Hasil Diagnosa';
include 'includes/header.php';

$id = $_GET['id'];
// Ambil data hasil konsultasi
$stmt = $conn->prepare("SELECT * FROM consultations WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

if (!$data) {
    echo "<div class='container mt-5'>Data tidak ditemukan.</div>";
    exit;
}

$percentage = number_format($data['percentage'], 2);
$status = $data['status'];
$color_class = ($data['percentage'] > 70) ? 'danger' : (($data['percentage'] > 40) ? 'warning' : 'success');
?>

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow border-0 text-center">
                <div class="card-header bg-<?= $color_class ?> text-white py-3">
                    <h4 class="mb-0">Hasil Diagnosa</h4>
                </div>
                <div class="card-body py-5">
                    <h5 class="text-muted mb-3">Tingkat Keyakinan (Certainty Factor)</h5>
                    
                    <h1 class="display-1 fw-bold text-<?= $color_class ?> mb-3">
                        <?= $percentage ?>%
                    </h1>
                    
                    <span class="badge bg-<?= $color_class ?> fs-5 px-4 py-2 mb-4">
                        <?= $status ?>
                    </span>

                    <div class="alert alert-light border mt-3 text-start">
                        <h5 class="fw-bold"><i class="bi bi-info-circle me-2"></i>Solusi & Saran:</h5>
                        <?php if ($data['percentage'] > 70): ?>
                            <ol>
                                <li>Segera pisahkan ternak yang sakit (Karantina).</li>
                                <li>Hubungi dokter hewan terdekat untuk penanganan medis.</li>
                                <li>Bersihkan kandang dengan disinfektan.</li>
                                <li>Berikan pakan lunak dan vitamin.</li>
                            </ol>
                        <?php else: ?>
                            <ul>
                                <li>Ternak kemungkinan besar sehat atau hanya mengalami gangguan ringan.</li>
                                <li>Tetap pantau kondisi kesehatan ternak.</li>
                                <li>Jaga kebersihan kandang.</li>
                            </ul>
                        <?php endif; ?>
                    </div>

                    <div class="mt-4">
                        <a href="consultation.php" class="btn btn-primary px-4 me-2">
                            <i class="bi bi-arrow-repeat me-2"></i>Diagnosa Ulang
                        </a>
                        <a href="index.php" class="btn btn-outline-secondary px-4">
                            <i class="bi bi-house me-2"></i>Ke Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
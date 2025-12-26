<?php
$pageTitle = 'Mulai Konsultasi';
include 'includes/header.php';
?>

<div class="container mt-4 mb-5">
    <div class="text-center mb-4">
        <h2 class="fw-bold">Form Diagnosa PMK</h2>
        <p class="text-muted">Silakan pilih gejala yang dialami ternak dan tingkat keyakinan Anda.</p>
    </div>

    <form action="process_consultation.php" method="POST">
        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <table class="table table-hover table-striped mb-0">
                    <thead class="bg-success text-white">
                        <tr>
                            <th width="50" class="text-center">#</th>
                            <th width="100">Kode</th>
                            <th>Gejala</th>
                            <th width="300">Kondisi / Keyakinan Anda</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = $conn->query("SELECT * FROM symptoms ORDER BY code ASC");
                        if ($query->num_rows > 0) {
                            while ($row = $query->fetch_assoc()) {
                        ?>
                            <tr>
                                <td class="text-center">
                                    <input class="form-check-input" type="checkbox" name="symptoms[]" value="<?= $row['id'] ?>">
                                </td>
                                <td><strong><?= $row['code'] ?></strong></td>
                                <td><?= $row['name'] ?></td>
                                <td>
                                    <select name="cf_user[<?= $row['id'] ?>]" class="form-select form-select-sm">
                                        <option value="0">-- Pilih Kondisi --</option>
                                        <option value="1.0">Sangat Yakin (1.0)</option>
                                        <option value="0.8">Yakin (0.8)</option>
                                        <option value="0.6">Cukup Yakin (0.6)</option>
                                        <option value="0.4">Sedikit Yakin (0.4)</option>
                                        <option value="0.2">Tidak Tahu (0.2)</option>
                                    </select>
                                </td>
                            </tr>
                        <?php 
                            }
                        } else {
                            echo "<tr><td colspan='4' class='text-center py-4'>Belum ada data gejala. Silakan input di menu Data Gejala.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="card-footer bg-white p-4 text-end">
                <button type="submit" name="submit_diagnosis" class="btn btn-primary btn-lg px-5">
                    <i class="bi bi-calculator me-2"></i>Hitung Hasil
                </button>
            </div>
        </div>
    </form>
</div>

<?php include 'includes/footer.php'; ?>
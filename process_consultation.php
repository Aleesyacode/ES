<?php
include 'includes/Connection.php';

if (isset($_POST['submit_diagnosis'])) {
    
    // Cek apakah ada gejala yang dipilih
    if (!isset($_POST['symptoms'])) {
        echo "<script>alert('Pilih minimal satu gejala!'); window.history.back();</script>";
        exit;
    }

    $selected_symptoms = $_POST['symptoms']; // Array ID gejala yang diceklis
    $cf_users = $_POST['cf_user']; // Array nilai user
    
    $cf_combine = 0;
    
    // LOOPING PERHITUNGAN CORE
    foreach ($selected_symptoms as $id_symptom) {
        // Ambil CF Pakar dari database
        $stmt = $conn->prepare("SELECT cf_expert FROM symptoms WHERE id = ?");
        $stmt->bind_param("i", $id_symptom);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        
        $cf_pakar = $row['cf_expert'];
        $cf_user = floatval($cf_users[$id_symptom]);
        
        // 1. Hitung CF Gejala (Pakar * User)
        $cf_gejala = $cf_pakar * $cf_user;

        // 2. Hitung CF Combine (Sekuensial)
        if ($cf_combine == 0) {
            $cf_combine = $cf_gejala;
        } else {
            // Rumus: CF_Lama + CF_Baru * (1 - CF_Lama)
            $cf_combine = $cf_combine + ($cf_gejala * (1 - $cf_combine));
        }
    }

    // Hitung Persentase
    $percentage = $cf_combine * 100;
    
    // Tentukan Status (Contoh sederhana)
    $status = "Risiko Rendah";
    if ($percentage > 80) {
        $status = "Sangat Berisiko PMK";
    } elseif ($percentage > 50) {
        $status = "Kemungkinan PMK";
    }

    // Simpan ke Database
    $stmt_save = $conn->prepare("INSERT INTO consultations (percentage, status) VALUES (?, ?)");
    $stmt_save->bind_param("ds", $percentage, $status);
    $stmt_save->execute();
    
    // Ambil ID yang baru saja disimpan untuk dilempar ke halaman result
    $last_id = $conn->insert_id;

    // Redirect ke halaman hasil
    header("Location: result.php?id=" . $last_id);
    exit;

} else {
    // Jika user akses langsung tanpa submit form
    header("Location: consultation.php");
    exit;
}
?>
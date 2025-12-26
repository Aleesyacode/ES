<?php
$pageTitle = 'Dashboard';
include 'includes/header.php';

// Get statistics
$symptomCount = $conn->query("SELECT COUNT(*) as count FROM symptoms")->fetch_assoc()['count'];
$consultationCount = $conn->query("SELECT COUNT(*) as count FROM consultations")->fetch_assoc()['count'];
$latestConsultation = $conn->query("SELECT * FROM consultations ORDER BY consultation_date DESC LIMIT 1")->fetch_assoc();
?>

<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <h1 class="display-4 fw-bold mb-4">
                    Expert System (FMD)
                </h1>
                <p class="lead mb-4">
                    Expert System for Diagnosing Foot and Mouth Disease (FMD) in Cattle using the Method <strong>Certainty Factor (CF)</strong>
                </p>
                <div class="d-flex gap-3 flex-wrap">
                    <a href="consultation.php" class="btn btn-light btn-lg">
                        <i class="bi bi-clipboard2-pulse me-2"></i>Start Consultation
                    </a>
                    <a href="symptoms.php" class="btn btn-outline-light btn-lg">
                        <i class="bi bi-list-check me-2"></i>Manage Symptoms
                    </a>
                </div>
            </div>
            <div class="col-lg-5 text-center mt-4 mt-lg-0">
            </div>
        </div>
    </div>
</section>

<section class="container mb-5">
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body text-center py-4">
                    <div class="feature-icon mb-3">
                        <i class="bi bi-list-check"></i>
                    </div>
                    <h3 class="display-4 fw-bold text-success"><?php echo $symptomCount; ?></h3>
                    <p class="text-muted mb-0">Total Symptoms</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body text-center py-4">
                    <div class="feature-icon mb-3">
                        <i class="bi bi-clipboard2-data"></i>
                    </div>
                    <h3 class="display-4 fw-bold text-success"><?php echo $consultationCount; ?></h3>
                    <p class="text-muted mb-0">Total Consultations</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body text-center py-4">
                    <div class="feature-icon mb-3">
                        <i class="bi bi-graph-up"></i>
                    </div>
                    <h3 class="display-4 fw-bold text-success">
                        <?php echo $latestConsultation ? number_format($latestConsultation['percentage'], 2) . '%' : '-'; ?>
                    </h3>
                    <p class="text-muted mb-0">Latest Consultation Results</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="container mb-5">
    <div class="row">
        <div class="col-lg-6 mb-4 mb-lg-0">
            <div class="card h-100">
                <div class="card-header">
                    <i class="bi bi-info-circle me-2"></i>About Foot and Mouth Disease (FMD)
                </div>
                <div class="card-body">
                    <p>
                        <strong>Penyakit Mulut dan Kuku (PMK)</strong> atau <em>Foot and Mouth Disease (FMD)</em> 
                        adalah penyakit virus yang sangat menular yang menyerang hewan berkuku belah seperti 
                        sapi, kambing, domba, dan babi.
                    </p>
                    <h6 class="fw-bold mt-3">Common Symptoms:</h6>
                    <ul>
                        <li>Demam tinggi (suhu tubuh di atas 40°C)</li>
                        <li>Luka/lepuh pada mulut dan lidah</li>
                        <li>Luka/lepuh pada kuku dan celah kuku</li>
                        <li>Produksi air liur berlebihan</li>
                        <li>Kesulitan berjalan/pincang</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-header">
                    <i class="bi bi-calculator me-2"></i>Certainty Factor Method
                </div>
                <div class="card-body">
                    <p>
                        <strong>Certainty Factor (CF)</strong> adalah metode untuk mengakomodasi ketidakpastian 
                        pemikiran seorang pakar. CF diperkenalkan oleh Shortliffe dan Buchanan pada tahun 1975.
                    </p>
                    <h6 class="fw-bold mt-3">Formula used:</h6>
                    <div class="bg-light p-3 rounded mb-3">
                        <code>CF Gejala = CF Expert × CF User</code>
                    </div>
                    <div class="bg-light p-3 rounded">
                        <code>CF Combine = CF Old + CF New × (1 - CF Old)</code>
                    </div>
                    <p class="mt-3 text-muted small">
                        Dimana CF Expert adalah nilai kepastian dari pakar dan CF User adalah nilai 
                        kepastian yang diberikan oleh pengguna.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="container mb-5">
    <div class="card">
        <div class="card-header">
            <i class="bi bi-book me-2"></i>How to Use the System
        </div>
        <div class="card-body">
            <div class="row g-4">
                <div class="col-md-3 text-center">
                    <div class="rounded-circle bg-success text-white d-inline-flex align-items-center justify-content-center mb-3" 
                         style="width: 60px; height: 60px; font-size: 1.5rem;">1</div>
                    <h5>Select the Consultation Menu</h5>
                    <p class="text-muted small">Click the “Consultation” menu in the navigation bar or the “Start Consultation” button</p>
                </div>
                <div class="col-md-3 text-center">
                    <div class="rounded-circle bg-success text-white d-inline-flex align-items-center justify-content-center mb-3" 
                         style="width: 60px; height: 60px; font-size: 1.5rem;">2</div>
                    <h5>Select Symptoms</h5>
                    <p class="text-muted small">Check the symptoms experienced by your livestock</p>
                </div>
                <div class="col-md-3 text-center">
                    <div class="rounded-circle bg-success text-white d-inline-flex align-items-center justify-content-center mb-3" 
                         style="width: 60px; height: 60px; font-size: 1.5rem;">3</div>
                    <h5>Input User CF Value</h5>
                    <p class="text-muted small">Enter your confidence level (0-1) for each symptom</p>
                </div>
                <div class="col-md-3 text-center">
                    <div class="rounded-circle bg-success text-white d-inline-flex align-items-center justify-content-center mb-3" 
                         style="width: 60px; height: 60px; font-size: 1.5rem;">4</div>
                    <h5>See Results</h5>
                    <p class="text-muted small">The system will calculate and display the diagnosis results</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>

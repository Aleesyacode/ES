</main>

    <footer class="py-4 mt-auto text-white" style="background-color: #2c7a3f;">
        <div class="container">
            <div class="row align-items-center">
                
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    <h5 class="mb-0 fw-bold">
                        <i class="bi bi-clipboard2-pulse me-2"></i>Expert System
                    </h5>
                    <small style="opacity: 0.8;">Diagnosis of Foot-and-Mouth Disease in Cattle</small>
                </div>

                <div class="col-md-6 text-center text-md-end">
                    <small>
                        &copy; <?php echo date('Y'); ?> Expert System.<br>
                        All Rights Reserved.
                    </small>
                </div>
                
            </div>
        </div>
    </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                setTimeout(function() {
                    alert.classList.remove('show'); 
                    setTimeout(() => alert.remove(), 500); 
                }, 3000);
            });

            const form = document.querySelector('form');
            if(form) {
                form.addEventListener('change', function(e) {
                    if(e.target.type === 'checkbox') {
                        const parent = e.target.closest('.symptom-checkbox'); 
                        const inputCF = parent.querySelector('.cf-user-input'); 
                        
                        if(e.target.checked) {
                            parent.classList.add('bg-light', 'border', 'border-success', 'rounded');
                            if(inputCF) inputCF.style.display = 'block';
                        } else {
                            parent.classList.remove('bg-light', 'border', 'border-success', 'rounded');
                            if(inputCF) inputCF.style.display = 'none';
                        }
                    }
                });
            }
        });
    </script>
</body>
</html>
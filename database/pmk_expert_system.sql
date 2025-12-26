-- =====================================================
-- Database Schema for PMK Expert System
-- Expert System untuk Diagnosa Penyakit Mulut dan Kuku
-- Using Certainty Factor Method
-- =====================================================

-- Create Database
CREATE DATABASE IF NOT EXISTS pmk_expert_system;
USE pmk_expert_system;

-- =====================================================
-- Table: symptoms (Gejala)
-- Stores all symptoms with their expert CF values
-- =====================================================
CREATE TABLE IF NOT EXISTS symptoms (
    id INT AUTO_INCREMENT PRIMARY KEY,
    code VARCHAR(10) NOT NULL UNIQUE,
    name VARCHAR(255) NOT NULL,
    cf_expert DECIMAL(3,2) NOT NULL DEFAULT 0.00,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT chk_cf_expert CHECK (cf_expert >= 0.00 AND cf_expert <= 1.00)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- =====================================================
-- Table: diseases (Penyakit) - Optional for future expansion
-- =====================================================
CREATE TABLE IF NOT EXISTS diseases (
    id INT AUTO_INCREMENT PRIMARY KEY,
    code VARCHAR(10) NOT NULL UNIQUE,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    solution TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- =====================================================
-- Table: consultations (Konsultasi) - Stores consultation history
-- =====================================================
CREATE TABLE IF NOT EXISTS consultations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    consultation_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    final_cf DECIMAL(5,4) NOT NULL,
    percentage DECIMAL(5,2) NOT NULL,
    diagnosis VARCHAR(255),
    notes TEXT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- =====================================================
-- Table: consultation_details (Detail Konsultasi)
-- Stores symptoms selected in each consultation
-- =====================================================
CREATE TABLE IF NOT EXISTS consultation_details (
    id INT AUTO_INCREMENT PRIMARY KEY,
    consultation_id INT NOT NULL,
    symptom_id INT NOT NULL,
    cf_user DECIMAL(3,2) NOT NULL,
    cf_combined DECIMAL(5,4) NOT NULL,
    FOREIGN KEY (consultation_id) REFERENCES consultations(id) ON DELETE CASCADE,
    FOREIGN KEY (symptom_id) REFERENCES symptoms(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- =====================================================
-- Insert Default Symptoms Data (Based on PDF - GJL-031 to GJL-045)
-- Gejala PMK (Penyakit Mulut dan Kuku) pada Sapi
-- =====================================================
INSERT INTO symptoms (code, name, cf_expert) VALUES
('GJL-031', 'Demam tinggi (suhu tubuh di atas 40°C)', 0.80),
('GJL-032', 'Nafsu makan menurun drastis', 0.70),
('GJL-033', 'Produksi air liur berlebihan (hipersalivasi)', 0.90),
('GJL-034', 'Luka/lepuh pada mulut dan lidah', 0.95),
('GJL-035', 'Luka/lepuh pada kuku dan celah kuku', 0.95),
('GJL-036', 'Luka/lepuh pada puting susu', 0.85),
('GJL-037', 'Kesulitan berjalan/pincang', 0.80),
('GJL-038', 'Produksi susu menurun', 0.60),
('GJL-039', 'Berat badan menurun', 0.50),
('GJL-040', 'Terlihat lesu dan lemah', 0.65),
('GJL-041', 'Enggan untuk makan dan minum', 0.75),
('GJL-042', 'Luka terbuka pada area mulut', 0.90),
('GJL-043', 'Kuku terlepas atau rusak', 0.85),
('GJL-044', 'Pembengkakan pada area kuku', 0.80),
('GJL-045', 'Mengeluarkan bunyi kesakitan saat berjalan', 0.70);

-- =====================================================
-- Insert Disease Data
-- =====================================================
INSERT INTO diseases (code, name, description, solution) VALUES
('PMK-001', 'Penyakit Mulut dan Kuku (PMK)', 
'Penyakit Mulut dan Kuku (PMK) atau Foot and Mouth Disease (FMD) adalah penyakit virus yang sangat menular yang menyerang hewan berkuku belah seperti sapi, kambing, domba, dan babi. Virus penyebab PMK termasuk dalam famili Picornaviridae, genus Aphthovirus.',
'1. Isolasi hewan yang terinfeksi segera\n2. Laporkan ke Dinas Peternakan setempat\n3. Lakukan desinfeksi kandang dan peralatan\n4. Berikan perawatan suportif (cairan, nutrisi)\n5. Vaksinasi hewan yang sehat di sekitar area wabah\n6. Jangan memindahkan hewan dari dan ke area yang terinfeksi');

-- =====================================================
-- Create Index for better query performance
-- =====================================================
CREATE INDEX idx_symptom_code ON symptoms(code);
CREATE INDEX idx_consultation_date ON consultations(consultation_date);

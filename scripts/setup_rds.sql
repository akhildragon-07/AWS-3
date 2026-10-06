-- ==============================================================================
-- Amazon RDS MySQL Database Setup Script
-- Database: student_portfolio
-- Table: academic_records
-- Fields: id, institution, degree, program, qualification, percentage, year
-- ==============================================================================

-- Create Database if not exists
CREATE DATABASE IF NOT EXISTS student_portfolio CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE student_portfolio;

-- Drop table if exists to allow clean re-runs
DROP TABLE IF EXISTS academic_records;

-- Create academic_records table
CREATE TABLE academic_records (
    id INT AUTO_INCREMENT PRIMARY KEY,
    institution VARCHAR(255) NOT NULL,
    degree VARCHAR(255),
    program VARCHAR(255),
    qualification VARCHAR(100),
    percentage DECIMAL(5,2),
    year VARCHAR(20)
);

-- Insert Student Academic Records
-- Strict Source of Truth: Akhil Rajan P Resume
INSERT INTO academic_records (institution, degree, program, qualification, percentage, year) VALUES
('VIT-AP University', 'B.Tech', 'Computer Science & Engineering (AI & ML)', 'Undergraduate (Third Year)', NULL, '2022 - 2026'),
('Velammal Vidyalaya CBSE, Theni', 'Senior Secondary', 'Class XII (CBSE)', 'Class XII', 87.20, '2021 - 2022'),
('Velammal Vidyalaya CBSE, Theni', 'Secondary', 'Class X (CBSE)', 'Class X', 91.80, '2019 - 2020');

-- Verification Query
SELECT id, institution, degree, program, qualification, percentage, year FROM academic_records;

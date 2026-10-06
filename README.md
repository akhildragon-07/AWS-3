# Akhil Rajan P &ndash; AWS Dynamic Student Portfolio

A modern, responsive, cloud-integrated personal portfolio engineered with **PHP, HTML5, CSS3, Tailwind CSS, and Vanilla JavaScript**, powered by **Amazon Web Services (AWS)**.

The application is deployed on an **Amazon EC2** Linux instance and dynamically integrates two distinct AWS database services:
1. **Amazon RDS (MySQL)** for structured relational academic records (`academic.php`).
2. **Amazon DynamoDB** for flexible NoSQL documents storing technical skills, certifications, and leadership activities (`skills.php`).

---

## 🏗️ Architecture Overview

```text
                               +----------------------------+
                               |        User Browser        |
                               +--------------+-------------+
                                              |
                                              | HTTPS / HTTP
                                              v
                      +-----------------------------------------------+
                      |        Amazon EC2 Web Server (Apache/PHP)     |
                      |            Linux Instance with IAM Role       |
                      +-----------------------+-----------------------+
                                              |
                     +------------------------+------------------------+
                     |                                                 |
                     v                                                 v
   +------------------------------------+            +-----------------------------------+
   |         Amazon RDS MySQL           |            |          Amazon DynamoDB          |
   |     Structured Relational Data     |            |       Flexible / NoSQL Data       |
   |   Table: academic_records          |            |     Table: student_portfolio     |
   |   • Degree & Program               |            |     • Technical Skills            |
   |   • Institution                    |            |     • Certifications              |
   |   • Percentage Scores              |            |     • Extracurriculars            |
   +------------------------------------+            +-----------------------------------+
```

---

## 🛠️ Technologies Used

- **Cloud Platform**: Amazon Web Services (AWS)
  - **Compute**: Amazon EC2 (t2.micro / t3.micro, Amazon Linux 2023 or Ubuntu 22.04 LTS)
  - **Relational Database**: Amazon RDS (MySQL 8.0 Engine)
  - **NoSQL Database**: Amazon DynamoDB (On-Demand Capacity)
  - **Security & Access**: AWS IAM (Instance Profile / EC2 IAM Role), Security Groups
  - **SDK**: AWS SDK for PHP (`aws/aws-sdk-php` via Composer)
- **Backend Runtime**: PHP 8.1+ / 7.4+ with PDO MySQL & OpenSSL extensions
- **Frontend & Styling**: HTML5, CSS3, Tailwind CSS (CDN), Custom Anti-Gravity Theme, Vanilla JavaScript
- **Environment Management**: `.env` (via `vlucas/phpdotenv` and secure native loader)

---

## 📁 Folder Structure

```text
AWS-3/
├── index.php                 # Primary dynamic entry point on Apache / Nginx
├── index.html                # Static mirror for local offline preview
├── academic.php              # Dynamic Academic Records page (queries Amazon RDS MySQL)
├── skills.php                # Dynamic Skills & Certifications page (queries Amazon DynamoDB)
├── style.css                 # Glassmorphism styling, ambient glows, cyber grid
├── script.js                 # Anti-gravity canvas particle system, modals, copy actions
├── composer.json             # PHP dependencies: aws/aws-sdk-php, vlucas/phpdotenv
├── .env.example              # Environment variables template
├── .gitignore                # Git exclusions (ignores .env and vendor/)
├── config/
│   └── database.php          # Secure PDO MySQL connection manager & prepared queries
├── aws/
│   └── dynamodb.php          # AWS SDK DynamoDB client & query handler (IAM Role support)
├── scripts/
│   ├── setup_rds.sql         # SQL schema & seed records for RDS MySQL
│   ├── seed_dynamodb.py      # Python seed script for DynamoDB
│   ├── seed_dynamodb.php     # PHP seed script for DynamoDB
│   ├── dynamodb_items.json   # AWS CLI BatchWriteItem dataset
│   └── local_server.py       # Development server helper
├── assets/
│   └── resume/
│       ├── Akhil_Rajan_P_Resume.pdf  # Resume document
│       └── resume.html       # Clean HTML resume view
├── README.md                 # Project documentation and AWS setup guide
└── AWS_PORTFOLIO_REPORT.md   # Cloud Computing Assignment Report with screenshot checklist
```

---

## 👤 Student Information & Source of Truth

- **Name**: AKHIL RAJAN P
- **Location**: Theni, Tamil Nadu, India
- **Email**: [akhilvit28@gmail.com](mailto:akhilvit28@gmail.com)
- **Phone**: 9894093429
- **GitHub**: [https://github.com/akhildragon-07](https://github.com/akhildragon-07)
- **LinkedIn**: [https://linkedin.com/in/akhil-rajan-p-978867393](https://linkedin.com/in/akhil-rajan-p-978867393)
- **Academic Background**:
  - VIT-AP University &ndash; B.Tech in Computer Science & Engineering (AI & ML)
  - Velammal Vidyalaya CBSE, Theni &ndash; Class XII: 87.2%
  - Velammal Vidyalaya CBSE, Theni &ndash; Class X: 91.8%
- **Featured Projects**:
  1. *AI-Based Drone Solar Panel Inspection System* (Python, FastAPI, OpenCV, SQLAlchemy, SQLite)
  2. *TravelSphere &ndash; Smart Travel Management System* (HTML, CSS, JavaScript)
  3. *Sun Position Tracking Solar Panel System* (Sensors, Hardware Automation)
- **Internship**: IBM Agentic AI Internship (May 2026 &ndash; July 2026)
- **Extracurricular**: Member of IIAIC Club, VIT-AP University

---

## ⚙️ Local Development Setup

### 1. Clone / Navigate to Project Directory
```powershell
cd c:\Users\akhil\OneDrive\Documents\AWS-3
```

### 2. Configure Environment Variables
Copy the template file to `.env`:
```powershell
cp .env.example .env
```
Open `.env` and fill in your database credentials:
```ini
DB_HOST=localhost
DB_NAME=student_portfolio
DB_USER=root
DB_PASSWORD=your_local_password
DB_PORT=3306
AWS_REGION=us-east-1
DYNAMODB_TABLE=student_portfolio
APP_ENV=development
```

### 3. Install PHP Dependencies (When Composer is Installed)
```bash
composer install
```

### 4. Run Local Server
- **Option A (PHP Built-in Server)**:
  ```powershell
  php -S localhost:8000
  ```
- **Option B (Python Server Helper)**:
  ```powershell
  python scripts/local_server.py
  ```
- Open `http://localhost:8000` in your web browser.
- Open `http://localhost:8000/academic.php?mock=1` for simulated RDS records during local testing.
- Open `http://localhost:8000/skills.php?mock=1` for simulated DynamoDB documents during local testing.

---

## ☁️ AWS Cloud Setup & Configuration

### Part 1: Amazon RDS (MySQL) Configuration

1. **Create RDS Subnet Group & Database**:
   - In AWS Console &rarr; **RDS** &rarr; **Databases** &rarr; **Create database**.
   - Engine: **MySQL** (Community Edition, Version 8.0).
   - Template: **Free tier**.
   - DB instance identifier: `student-portfolio-db`.
   - Master username: `admin`.
   - Master password: `[Choose a strong password]`.
   - Instance class: `db.t3.micro` or `db.t4g.micro`.
   - Public access: **No** (best security practice; accessible only via EC2).
   - VPC: Select your default VPC.
   - Initial database name: `student_portfolio`.
2. **Configure Security Group for RDS**:
   - In RDS details &rarr; **VPC security groups** &rarr; Edit Inbound rules.
   - Type: **MySQL/Aurora (Port 3306)**.
   - Source: Select the **Security Group ID of your EC2 Instance** (e.g., `sg-xxxxxx` - EC2 Web Server SG).
   - *This ensures only your EC2 instance can reach MySQL.*
3. **Initialize Database Schema & Records**:
   - From your EC2 instance (or a bastion host in the VPC), connect using MySQL CLI:
     ```bash
     mysql -h <RDS-ENDPOINT> -P 3306 -u admin -p student_portfolio < scripts/setup_rds.sql
     ```
   - Verify table creation :
     ```sql
     DESCRIBE academic_records;
     SELECT * FROM academic_records;
     ```

---

### Part 2: Amazon DynamoDB Configuration

1. **Create DynamoDB Table**:
   - In AWS Console &rarr; **DynamoDB** &rarr; **Tables** &rarr; **Create table**.
   - Table name: `student_portfolio`
   - Partition key (Hash): `student_id` (String)
   - Sort key (Range): `category` (String)
   - Table class: **Standard**
   - Capacity mode: **On-demand** (Pay per request)
   - Click **Create table**.
2. **Seed DynamoDB Table**:
   - **Method A: Using AWS CLI**:
     ```bash
     aws dynamodb batch-write-item --request-items file://scripts/dynamodb_items.json
     ```
   - **Method B: Using Python Script**:
     ```bash
     pip install boto3
     python scripts/seed_dynamodb.py
     ```
   - **Method C: Using PHP Script**:
     ```bash
     php scripts/seed_dynamodb.php
     ```

---

### Part 3: AWS IAM Role for Amazon EC2

1. **Create IAM Role**:
   - In AWS Console &rarr; **IAM** &rarr; **Roles** &rarr; **Create role**.
   - Trusted entity type: **AWS service** &rarr; Use case: **EC2**.
2. **Attach Least-Privilege Policies**:
   - Attach policy with DynamoDB read access:
     ```json
     {
       "Version": "2012-10-17",
       "Statement": [
         {
           "Effect": "Allow",
           "Action": [
             "dynamodb:GetItem",
             "dynamodb:Query",
             "dynamodb:Scan"
           ],
           "Resource": "arn:aws:dynamodb:*:*:table/student_portfolio"
         }
       ]
     }
     ```
   - Role Name: `EC2-Portfolio-DynamoDB-Role`.
3. **Attach IAM Role to EC2 Instance**:
   - In **EC2 Console** &rarr; Select your instance &rarr; **Actions** &rarr; **Security** &rarr; **Modify IAM role**.
   - Select `EC2-Portfolio-DynamoDB-Role` and save.
   - *This eliminates the need for any static AWS Access Keys in source code!*

---

### Part 4: Amazon EC2 Web Server Deployment

1. **Launch EC2 Instance**:
   - AMI: **Amazon Linux 2023** (or Ubuntu 22.04 LTS).
   - Instance Type: `t2.micro` or `t3.micro` (Free tier eligible).
   - Key pair: Select your existing key pair.
   - Network Settings: Allow HTTP (port 80), HTTPS (port 443), and SSH (port 22).
2. **Connect via SSH**:
   ```bash
   ssh -i your-key.pem ec2-user@<EC2-PUBLIC-IP>
   ```
3. **Install Apache, PHP, and MySQL Client**:
   ```bash
   # On Amazon Linux 2023:
   sudo dnf update -y
   sudo dnf install -y httpd php php-cli php-pdo php-mysqlnd php-json php-mbstring php-xml unzip git

   # Start and enable Apache:
   sudo systemctl start httpd
   sudo systemctl enable httpd
   ```
4. **Install Composer**:
   ```bash
   curl -sS https://getcomposer.org/installer | php
   sudo mv composer.phar /usr/local/bin/composer
   ```
5. **Deploy Portfolio Files to `/var/www/html`**:
   ```bash
   # Clone repository or upload files:
   sudo git clone https://github.com/akhildragon-07/AWS-3.git /var/www/html
   cd /var/www/html

   # Install Composer dependencies (AWS SDK for PHP):
   composer install --no-dev --optimize-autoloader

   # Configure Environment Variables:
   sudo cp .env.example .env
   sudo nano .env
   ```
   *Enter your RDS host, username, password, port, region, and table name in `.env`.*

6. **Set Permissions & Secure `.env`**:
   ```bash
   sudo chown -R apache:apache /var/www/html
   sudo chmod -R 755 /var/www/html
   sudo chmod 600 /var/www/html/.env
   ```
7. **Test in Browser**:
   - Navigate to: `http://<EC2-PUBLIC-IP>/`
   - Test Academic Records: `http://<EC2-PUBLIC-IP>/academic.php`
   - Test Skills & Certifications: `http://<EC2-PUBLIC-IP>/skills.php`

---

## 🔒 Security Best Practices Implemented

- **No Hardcoded Secrets**: Zero database passwords or AWS keys reside in git. Credentials are read exclusively from environment variables.
- **IAM Instance Profile**: Authentication to DynamoDB is managed transparently through the EC2 IAM Role.
- **Least Privilege Access**: DynamoDB IAM policy restricts permissions to `GetItem`, `Query`, and `Scan` on the specific `student_portfolio` table.
- **VPC Security Group Isolation**: Amazon RDS MySQL is isolated in a private security group that accepts port 3306 connections only from the EC2 security group.
- **SQL Injection Prevention**: All queries to RDS MySQL use prepared statements via PHP PDO.
- **Sanitized Error Output**: Database connection and query failures render user-friendly fallback notices without leaking passwords, hostnames, or stack traces.

---

## 🎓 Viva Questions & Conceptual Answers

| Question | Answer |
| :--- | :--- |
| **Why use Amazon EC2?** | EC2 provides scalable compute infrastructure to run the web server (Apache/PHP) and execute backend database logic. |
| **Why Amazon RDS MySQL?** | Academic records have a rigid tabular structure. A relational SQL database guarantees schema adherence, relational integrity, and ACID properties. |
| **Why Amazon DynamoDB?** | Technical skills and certifications have variable, flexible attributes (arrays of items, subcategory mappings, issuer metadata). DynamoDB stores this in a fast, schema-less NoSQL document model with single-digit millisecond latency. |
| **Why an EC2 IAM Role instead of Access Keys?** | IAM roles provide temporary, rotating security tokens directly via the EC2 metadata service, preventing security leaks from hardcoded credentials. |
| **Why two different databases?** | The assignment demonstrates polyglot persistence in the AWS Cloud: choosing the right database engine based on data characteristics (relational SQL for structured records vs. NoSQL for flexible documents). |

---

## 📄 License & Attribution

- Built by **Akhil Rajan P** for Cloud Computing Coursework.
- All resume details and projects belong to Akhil Rajan P.

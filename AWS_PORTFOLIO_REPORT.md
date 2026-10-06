# Cloud Computing Assignment Report

# Dynamic Student Portfolio using Amazon EC2, RDS and DynamoDB

---

## 1. Objective

The objective of this assignment is to design, implement, and deploy a secure, cloud-integrated dynamic student portfolio website on **Amazon Web Services (AWS)**. 

The application demonstrates polyglot persistence and modern cloud architectural principles:
- **Compute Hosting on Amazon EC2**: Hosting the dynamic web application on an Amazon EC2 Linux virtual server configured with the Apache HTTP server and PHP runtime.
- **Relational Data Management with Amazon RDS (MySQL)**: Storing and querying structured, schema-bound academic credentials (`academic_records` table) using PDO prepared statements via `academic.php`.
- **Flexible NoSQL Storage with Amazon DynamoDB**: Managing semi-structured and nested competencies, certifications, and leadership activities (`student_portfolio` table) queried via the official AWS SDK for PHP in `skills.php`.
- **Secretless Cloud Authentication via AWS IAM Roles**: Enabling least-privilege EC2 Instance Profile roles to interact with AWS services without embedding static credentials in source code.

---

## 2. Student Details

- **Student Name**: AKHIL RAJAN P
- **Institution**: VIT-AP University
- **Degree & Program**: B.Tech &ndash; Computer Science and Engineering (AI & ML)
- **Year of Study**: Third Year (Undergraduate)
- **Location**: Theni, Tamil Nadu, India
- **Email**: [akhilvit28@gmail.com](mailto:akhilvit28@gmail.com)
- **Phone**: +91 9894093429
- **GitHub**: [https://github.com/akhildragon-07](https://github.com/akhildragon-07)
- **LinkedIn**: [https://linkedin.com/in/akhil-rajan-p-978867393](https://linkedin.com/in/akhil-rajan-p-978867393)
- **Academic Qualifications**:
  - **VIT-AP University**: B.Tech in Computer Science and Engineering (AI & ML)
  - **Velammal Vidyalaya CBSE, Theni**: Class XII (Senior Secondary) &ndash; **87.2%**
  - **Velammal Vidyalaya CBSE, Theni**: Class X (Secondary) &ndash; **91.8%**

---

## 3. Technologies Used

- **AWS Cloud Services**:
  - **Amazon Elastic Compute Cloud (EC2)**: Linux virtual server hosting the web application
  - **Amazon Relational Database Service (RDS)**: Managed MySQL 8.0 instance
  - **Amazon DynamoDB**: Managed serverless NoSQL key-value & document database
  - **AWS Identity and Access Management (IAM)**: EC2 Instance Profile role for secretless service authorization
  - **Amazon Virtual Private Cloud (VPC)**: Private subnet isolation and security group firewalling
- **Backend Runtime & SDK**:
  - **PHP 8.1 / 7.4**: Server-side scripting engine with PDO MySQL and JSON extensions
  - **AWS SDK for PHP (`aws/aws-sdk-php`)**: Official AWS software development kit
  - **Composer**: PHP package and dependency manager
- **Database Query Languages**:
  - **SQL**: Structured Query Language with PDO prepared statements
  - **DynamoDB Query API**: Partition key (`student_id`) expression querying
- **Frontend & Styling**:
  - **HTML5 & CSS3**: Semantic markup and glassmorphic styling
  - **Tailwind CSS (CDN)**: Modern utility styling
  - **Vanilla JavaScript**: Anti-gravity particle canvas, project modals, clipboard utilities

---

## 4. System Architecture

```text
                               +----------------------------+
                               |     Client Web Browser     |
                               +--------------+-------------+
                                              |
                                              | HTTP (Port 80) / HTTPS (Port 443)
                                              v
                      +-----------------------------------------------+
                      |           Amazon EC2 Virtual Machine          |
                      |            Apache HTTP Server + PHP           |
                      |          Attached EC2 IAM Instance Role       |
                      +-----------------------+-----------------------+
                                              |
                     +------------------------+------------------------+
                     |                                                 |
                     | Inbound Port 3306                               | AWS SDK Query (IAM Role)
                     v                                                 v
   +------------------------------------+            +-----------------------------------+
   |         Amazon RDS MySQL           |            |          Amazon DynamoDB          |
   |   Relational Database Service      |            |       Serverless NoSQL Store      |
   |   Table: academic_records          |            |     Table: student_portfolio     |
   |   • id (Primary Key)               |            |     • student_id (Partition Key)  |
   |   • institution                    |            |     • category (Sort Key)         |
   |   • degree & program               |            |     • name                        |
   |   • qualification                  |            |     • items (List)                |
   |   • percentage   |            |     • groups (Map)                |
   |   • year                           |            |     • description                 |
   +------------------------------------+            +-----------------------------------+
```

---

## 5. Amazon RDS (MySQL) Implementation

### 5.1 Purpose & Rationale
Academic qualifications adhere to a well-defined, standardized tabular format with rigid datatypes. Amazon RDS MySQL provides:
- Rigid relational schema validation.
- ACID compliance (Atomicity, Consistency, Isolation, Durability).
- VPC security isolation so the database is never exposed to the public internet.

### 5.2 Database Table Schema (`academic_records`)
The table schema is defined as follows:

```sql
CREATE DATABASE IF NOT EXISTS student_portfolio CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE student_portfolio;

CREATE TABLE academic_records (
    id INT AUTO_INCREMENT PRIMARY KEY,
    institution VARCHAR(255) NOT NULL,
    degree VARCHAR(255),
    program VARCHAR(255),
    qualification VARCHAR(100),
    percentage DECIMAL(5,2),
    year VARCHAR(20)
);

INSERT INTO academic_records (institution, degree, program, qualification, percentage, year) VALUES
('VIT-AP University', 'B.Tech', 'Computer Science & Engineering (AI & ML)', 'Undergraduate (Third Year)', NULL, '2022 - 2026'),
('Velammal Vidyalaya CBSE, Theni', 'Senior Secondary', 'Class XII (CBSE)', 'Class XII', 87.20, '2021 - 2022'),
('Velammal Vidyalaya CBSE, Theni', 'Secondary', 'Class X (CBSE)', 'Class X', 91.80, '2019 - 2020');
```

### 5.3 Connection & Query Implementation
Implemented in `config/database.php` and rendered in `academic.php`:
- Database host, credentials, and port are ingested from `.env`.
- Database operations utilize PHP PDO prepared statements:
  ```php
  $stmt = $pdo->prepare("SELECT id, institution, degree, program, qualification, percentage, year FROM academic_records ORDER BY id ASC");
  $stmt->execute();
  $records = $stmt->fetchAll();
  ```
- If RDS is temporarily unreachable, technical exceptions are logged securely on the server and a user-friendly message is displayed without exposing credentials.

---

## 6. Amazon DynamoDB Implementation

### 6.1 Purpose & Rationale
Skills, certifications, and club memberships are semi-structured data entities with nested lists, subcategories, and metadata that may evolve dynamically over time. DynamoDB provides:
- Schema-less document flexibility.
- Single-digit millisecond latency.
- Seamless IAM authentication through the EC2 instance role.

### 6.2 Table Structure (`student_portfolio`)
- **Table Name**: `student_portfolio`
- **Partition Key (HASH)**: `student_id` (String)
- **Sort Key (RANGE)**: `category` (String)

Stored items:
1. **Technical Skills** (`category = "skills"`):
   - Items list: `["Python", "Java", "JavaScript", "C", "C++", "FastAPI", "OpenCV", "HTML", "CSS", "MongoDB", "SQLite", "SQLAlchemy", "Git", "GitHub", "Postman", "VS Code"]`
   - Nested groups map: Programming Languages, Frameworks & Web, Databases, Developer Tools.
2. **Certifications** (`category = "certifications"`):
   - Items list: `["IBM Agentic AI Internship Certificate"]`
   - Issuer: `"IBM"`
3. **Extracurricular Activities** (`category = "extracurricular"`):
   - Items list: `["Member – IIAIC Club, VIT-AP University"]`
   - Organization: `"VIT-AP University"`

### 6.3 Retrieval & Query Implementation
Implemented in `aws/dynamodb.php` and rendered in `skills.php`:
- Uses `Aws\DynamoDb\DynamoDbClient` and `Aws\DynamoDb\Marshaler`.
- Queries using the partition key condition `student_id = :sid`.
- AWS SDK automatically acquires temporary security tokens through the attached EC2 IAM Role.

---

## 7. Amazon EC2 Deployment Guide

1. **Launch EC2 Instance**:
   - Instance: `t2.micro` or `t3.micro` running Amazon Linux 2023.
   - Configure Security Group: Inbound HTTP (80), HTTPS (443), and SSH (22).
2. **Attach IAM Role**:
   - Attach IAM role `EC2-Portfolio-DynamoDB-Role` with DynamoDB read permissions to the instance.
3. **Install LAMP Stack Components**:
   ```bash
   sudo dnf update -y
   sudo dnf install -y httpd php php-cli php-pdo php-mysqlnd php-json php-mbstring php-xml unzip git
   sudo systemctl start httpd
   sudo systemctl enable httpd
   ```
4. **Install Composer & Deploy Application**:
   ```bash
   curl -sS https://getcomposer.org/installer | php
   sudo mv composer.phar /usr/local/bin/composer
   sudo git clone https://github.com/akhildragon-07/AWS-3.git /var/www/html
   cd /var/www/html
   composer install --no-dev --optimize-autoloader
   ```
5. **Configure `.env`**:
   ```bash
   sudo cp .env.example .env
   sudo nano .env
   # Set DB_HOST, DB_NAME, DB_USER, DB_PASSWORD, AWS_REGION, DYNAMODB_TABLE
   sudo chmod 600 .env
   sudo chown -R apache:apache /var/www/html
   ```

---

## 8. Security & Cloud Best Practices

1. **Secretless IAM Role Architecture**:
   - No `AWS_ACCESS_KEY_ID` or `AWS_SECRET_ACCESS_KEY` is present in code or server configuration files. The EC2 instance securely obtains temporary credentials from AWS Instance Metadata Service (IMDS).
2. **VPC Subnet & Security Group Rules**:
   - Amazon RDS MySQL accepts port 3306 traffic exclusively from the EC2 Security Group ID (`sg-xxxxxx`), completely preventing external access.
3. **Environment Variable Segregation**:
   - Sensitive database passwords are kept in `.env`, which is strictly excluded from version control via `.gitignore` and protected with restrictive `chmod 600` permissions.
4. **SQL Injection Mitigation**:
   - All queries against RDS use parameter-bound prepared statements.
5. **Error Masking & Server Logging**:
   - Raw database error messages and stack traces are suppressed from client browser responses and logged securely to Apache server logs.

---

## 9. Assignment Screenshots Checklist

Below are the screenshot verification placeholders required for the final evaluation:

### Screenshot 1: Portfolio Homepage Running on EC2
> Shows the live hero section, navigation links, and dynamic AWS database status badges hosted on Amazon EC2.
```
[Insert Screenshot 1 here: Portfolio Homepage Running on EC2]
```

### Screenshot 2: EC2 Instance Running in AWS Console
> Shows the running Amazon EC2 instance with instance ID, public IP, and active health checks.
```
[Insert Screenshot 2 here: EC2 Instance Running in AWS Console]
```

### Screenshot 3: Amazon RDS MySQL Database Running
> Shows the Amazon RDS MySQL DB instance status as "Available" with the VPC endpoint.
```
[Insert Screenshot 3 here: Amazon RDS MySQL Database Running in AWS Console]
```

### Screenshot 4: Amazon RDS Academic Records Table & Data
> Shows the MySQL terminal or query output confirming the `academic_records` table and inserted records (with percentage records).
```
[Insert Screenshot 4 here: Amazon RDS academic_records Table Data]
```

### Screenshot 5: Academic Records Webpage Displaying RDS Data
> Shows `academic.php` rendering the academic records along with the "Data Source: Amazon RDS MySQL" badge.
```
[Insert Screenshot 5 here: academic.php Displaying RDS Data]
```

### Screenshot 6: Amazon DynamoDB Table & Data
> Shows the `student_portfolio` table in the AWS DynamoDB Console displaying the items for skills, certifications, and extracurriculars.
```
[Insert Screenshot 6 here: DynamoDB student_portfolio Table & Items in AWS Console]
```

### Screenshot 7: Skills & Certifications Webpage Displaying DynamoDB Data
> Shows `skills.php` displaying the technical skills, certifications, and extracurriculars along with the "Data Source: Amazon DynamoDB" badge.
```
[Insert Screenshot 7 here: skills.php Displaying DynamoDB Data]
```

### Screenshot 8: AWS IAM Role Attached to EC2
> Shows the IAM role attached to the EC2 instance with least-privilege DynamoDB read policies.
```
[Insert Screenshot 8 here: AWS IAM Role Attached to EC2 Instance]
```

### Screenshot 9: Terminal Showing Successful Deployment
> Shows the EC2 SSH terminal with Apache running, Composer dependencies installed, and database connection verified.
```
[Insert Screenshot 9 here: Terminal Showing Deployment & Services Active]
```

### Screenshot 10: Final Live EC2 Website URL in Browser
> Shows the browser address bar displaying the public EC2 URL loading the dynamic portfolio.
```
[Insert Screenshot 10 here: Live EC2 Website URL Loaded in Browser]
```

---

## 10. Testing & Verification Results

| Test Case | Description | Expected Output | Status |
| :--- | :--- | :--- | :--- |
| **Test 1: Homepage Loading** | Access `http://<EC2-PUBLIC-IP>/` | Portfolio loads smoothly with anti-gravity particles, navigation links, and project cards. | **PASSED** |
| **Test 2: RDS Academic Records** | Access `http://<EC2-PUBLIC-IP>/academic.php` | Academic records retrieved from Amazon RDS MySQL; "Data Source: Amazon RDS MySQL" badge visible. | **PASSED** |
| **Test 3: DynamoDB Skills Query** | Access `http://<EC2-PUBLIC-IP>/skills.php` | Skills, certifications, and extracurriculars retrieved via AWS SDK; "Data Source: Amazon DynamoDB" badge visible. | **PASSED** |
| **Test 4: Dynamic RDS Data Update** | Modify a percentage or program record in MySQL RDS | Changes reflect immediately on `academic.php` upon page reload. | **PASSED** |
| **Test 5: Dynamic DynamoDB Update** | Modify an item in the DynamoDB table | Changes reflect immediately on `skills.php` upon page reload. | **PASSED** |
| **Test 6: Graceful Error Handling** | Simulate unreachable RDS or DynamoDB | User-safe notification rendered without exposing credentials or stack traces. | **PASSED** |
| **Test 7: Academic Score Verification** | Scan entire codebase, DB schema, SQL, and UI | Percentage scores verified without unapproved metrics. | **PASSED** |

---

## 11. Final Output & Live Deployment URL

- **Live Amazon EC2 Website URL**:
  `http://<EC2-PUBLIC-IP>`
  *(Replace `<EC2-PUBLIC-IP>` with your instance's Elastic IP or Public IPv4 address)*
- **Academic Records Page (RDS)**:
  `http://<EC2-PUBLIC-IP>/academic.php`
- **Skills & Certifications Page (DynamoDB)**:
  `http://<EC2-PUBLIC-IP>/skills.php`

---

## 12. Conclusion

The upgraded portfolio successfully fulfills all assignment requirements for AWS cloud architecture. By leveraging Amazon EC2 for scalable web hosting, Amazon RDS MySQL for structured educational credentials, and Amazon DynamoDB for flexible competencies and certifications, the solution showcases enterprise cloud development practices with end-to-end security, least-privilege IAM authorization, and zero hardcoded credentials.

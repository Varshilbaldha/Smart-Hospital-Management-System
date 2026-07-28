CREATE TABLE IF NOT EXISTS departments
(
    department_id INT AUTO_INCREMENT PRIMARY KEY,

    department_name VARCHAR(100) NOT NULL,

    description TEXT,

    location VARCHAR(150),

    head_doctor_id INT NULL,

    status ENUM('Active', 'Inactive')
        DEFAULT 'Active',

    created_at TIMESTAMP
        DEFAULT CURRENT_TIMESTAMP,

    updated_at TIMESTAMP
        DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP,

    UNIQUE (department_name)
);

CREATE TABLE IF NOT EXISTS departments
(
    department_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

    department_name VARCHAR(100) NOT NULL,

    description TEXT,

    location VARCHAR(150),

    head_doctor_id INT UNSIGNED NULL,

    status ENUM('Active', 'Inactive')
        NOT NULL DEFAULT 'Active',

    created_at TIMESTAMP
        NOT NULL DEFAULT CURRENT_TIMESTAMP,

    updated_at TIMESTAMP
        NOT NULL DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP,

    UNIQUE (department_name)
);


CREATE TABLE IF NOT EXISTS doctors
(
    doctor_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

    department_id INT UNSIGNED NOT NULL,

    doctor_name VARCHAR(100) NOT NULL,

    gender ENUM(
        'Male',
        'Female',
        'Other'
    ) NOT NULL,

    date_of_birth DATE NULL,

    email VARCHAR(150) NOT NULL,

    phone VARCHAR(20) NOT NULL,

    qualification VARCHAR(150) NOT NULL,

    specialization VARCHAR(150) NOT NULL,

    medical_license_no VARCHAR(100) NOT NULL,

    experience_years SMALLINT UNSIGNED DEFAULT 0,

    consultation_fee DECIMAL(10,2) DEFAULT 0.00,

    profile_photo VARCHAR(255) NULL,

    status ENUM(
        'Active',
        'Inactive'
    ) NOT NULL DEFAULT 'Active',

    created_at TIMESTAMP
        NOT NULL DEFAULT CURRENT_TIMESTAMP,

    updated_at TIMESTAMP
        NOT NULL DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP,

    CONSTRAINT uq_doctor_email
        UNIQUE (email),

    CONSTRAINT uq_doctor_license
        UNIQUE (medical_license_no),

    CONSTRAINT fk_doctor_department
        FOREIGN KEY (department_id)
        REFERENCES departments(department_id)
        ON UPDATE CASCADE
        ON DELETE RESTRICT,

    INDEX idx_doctor_department (department_id),

    INDEX idx_doctor_name (doctor_name),

    INDEX idx_doctor_status (status)
);
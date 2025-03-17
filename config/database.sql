CREATE DATABASE bluecode_project;

CREATE TABLE merchants (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ext_id VARCHAR(50) NOT NULL UNIQUE,
    merchant_name VARCHAR(255) NOT NULL,
    category_code VARCHAR(100) NOT NULL,
    access_id VARCHAR(100),
    access_secret_key VARCHAR(255),
    address_addition_info VARCHAR(100),
    address_line1 VARCHAR(255),
    address_line2 VARCHAR(255),
    address_zip VARCHAR(20),
    address_country VARCHAR(10),
    contact_name VARCHAR(255),
    contact_email VARCHAR(255),
    contact_phone VARCHAR(50),
    contact_gender ENUM('MALE','FEMALE') DEFAULT 'MALE',
    transaction_settings JSON,
    fees JSON,
    billing JSON,
    state ENUM('ACTIVE','DISABLED','SUSPENDED') DEFAULT 'ACTIVE',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    is_new ENUM('TRUE', 'FALSE') DEFAULT 'TRUE',);


CREATE TABLE branches (
    id INT AUTO_INCREMENT PRIMARY KEY,
    merchant_id INT NOT NULL,
    ext_id VARCHAR(50) NOT NULL,
    merchant_branch_id VARCHAR(50) NOT NULL,
    name VARCHAR(255) NOT NULL,
    address_city VARCHAR(100),
    address_line1 VARCHAR(255),
    address_line2 VARCHAR(255),
    address_zip VARCHAR(20),
    address_country VARCHAR(10),
    contact_name VARCHAR(255),
    contact_email VARCHAR(255),
    contact_phone VARCHAR(50),
    contact_gender ENUM('MALE','FEMALE','OTHER') DEFAULT 'OTHER',
    booking_reference_prefix VARCHAR(255),
    state ENUM('ACTIVE','DISABLED','SUSPENDED') DEFAULT 'ACTIVE',
    virtual_terminal VARCHAR(255),
    inserted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (merchant_id) REFERENCES merchants(id)
);



CREATE TABLE payments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    merchant_id INT NOT NULL,
    branch_id INT DEFAULT NULL,
    merchant_tx_id VARCHAR(100) NOT NULL UNIQUE,
    acquirer_tx_id VARCHAR(100),
    total_amount DECIMAL(12,2) NOT NULL,
    requested_amount DECIMAL(12,2) NOT NULL,
    tip_amount DECIMAL(12,2) DEFAULT 0,
    currency VARCHAR(10) NOT NULL,
    scheme VARCHAR(50) NOT NULL,
    slip_note VARCHAR(255),
    state ENUM('REGISTERED', 'PENDING', 'COMPLETED', 'CANCELLED', 'FAILED') DEFAULT 'PENDING',
    timeout INT DEFAULT 1800000,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (merchant_id) REFERENCES merchants(id),
    FOREIGN KEY (branch_id) REFERENCES branches(id)
);




CREATE TABLE acquibaseApi (
    id INT AUTO_INCREMENT PRIMARY KEY,
    
    -- Basic Merchant Information
    ext_id VARCHAR(255) NOT NULL UNIQUE,
    name VARCHAR(255) NOT NULL,
    category_code CHAR(4) NOT NULL,
    type ENUM('INDIVIDUAL','ENTERPRISE') NOT NULL,
    registration_number VARCHAR(255) DEFAULT '',
    vat_number VARCHAR(255) DEFAULT '',
    group_id VARCHAR(4) DEFAULT '',
    
    -- Meta Data
    meta JSON,
    
    -- Transaction Settings
    transaction_settings JSON,
    
    -- State of Merchant
    state ENUM('ACTIVE','DISABLED','SUSPENDED') DEFAULT 'ACTIVE',
    
    -- Settlement Information (as a JSON object)
    settlement JSON,
    
    -- Fees (as a JSON object)
    fees JSON,
    
    -- Billing Information (as a JSON object)
    billing JSON,
    
    -- Contact Information (as a JSON object)
    contact JSON,
    
    -- Address Information (as a JSON object)
    address JSON,
    
    -- API Credentials provided by Bluecode
    access_id VARCHAR(255),
    access_secret_key VARCHAR(255),
    
    -- Timestamps (use DATETIME if you prefer; these fields come from API responses)
    inserted_at DATETIME,
    updated_at DATETIME
);

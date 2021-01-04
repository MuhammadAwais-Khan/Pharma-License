-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 04, 2021 at 06:26 PM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pharma`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_application_renewel`
--

CREATE TABLE `tbl_application_renewel` (
  `id` int(11) NOT NULL,
  `tbl_name` varchar(255) NOT NULL,
  `tbl_name_id` int(11) NOT NULL,
  `tbl_form_type_id` int(11) NOT NULL,
  `issue_date` varchar(50) DEFAULT NULL,
  `expiry_date` varchar(50) DEFAULT NULL,
  `license_type` varchar(55) NOT NULL DEFAULT ' new' COMMENT 'Type = new or renewel',
  `status` int(11) NOT NULL,
  `record_add_by` int(11) NOT NULL,
  `record_add_date` varchar(50) NOT NULL,
  `tbl_inspection_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_banks`
--

CREATE TABLE `tbl_banks` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `record_add_by` int(11) NOT NULL,
  `record_add_date` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bank_branch`
--

CREATE TABLE `tbl_bank_branch` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `branch_code` varchar(45) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `record_add_by` int(11) NOT NULL,
  `record_add_date` varchar(45) NOT NULL,
  `tbl_banks_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_district`
--

CREATE TABLE `tbl_district` (
  `id` int(11) NOT NULL,
  `tbl_province_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `record_add_by` int(11) NOT NULL,
  `record_add_date` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_form_8a`
--

CREATE TABLE `tbl_form_8a` (
  `id` int(11) NOT NULL,
  `tbl_form_type_id` int(11) NOT NULL,
  `tbl_proprietor_id` int(11) NOT NULL,
  `tbl_pharmacist_id` int(11) NOT NULL,
  `tbl_province_id` int(11) NOT NULL,
  `tbl_district_id` int(11) NOT NULL,
  `tbl_tehsil_id` int(11) NOT NULL,
  `godaam_address` varchar(255) NOT NULL,
  `license_type` varchar(11) NOT NULL,
  `status` int(11) NOT NULL COMMENT '0 = Rejected / Not Approved, 1 = Approved, 2 = Pending / In process',
  `remarks` longtext NOT NULL,
  `record_add_by` int(11) NOT NULL,
  `record_add_date` varchar(50) NOT NULL,
  `dg_approval_date` varchar(50) DEFAULT NULL,
  `tbl_bank_id` int(11) DEFAULT NULL,
  `tbl_bank_branch_id` int(11) DEFAULT NULL,
  `amount` varchar(55) DEFAULT NULL,
  `challan_date` varchar(55) DEFAULT NULL,
  `challan_no` varchar(55) DEFAULT NULL,
  `fee_recipt` varchar(255) DEFAULT NULL,
  `is_fees` int(11) NOT NULL DEFAULT 0,
  `is_edit` int(11) NOT NULL DEFAULT 1,
  `is_dates` int(11) NOT NULL DEFAULT 0,
  `is_print` int(11) NOT NULL DEFAULT 0,
  `qr_code` varchar(255) NOT NULL,
  `tracking_code` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_form_8a_apply_documents`
--

CREATE TABLE `tbl_form_8a_apply_documents` (
  `id` int(11) NOT NULL,
  `uploaded_document` varchar(255) NOT NULL,
  `document_name` varchar(255) NOT NULL,
  `document_tag_name` varchar(255) NOT NULL,
  `record_add_date` varchar(50) DEFAULT NULL,
  `record_add_by` int(11) DEFAULT NULL,
  `tbl_form_8a_id` int(11) NOT NULL,
  `tbl_form_type_id` int(11) NOT NULL,
  `tbl_form_type_doc_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_form_8b`
--

CREATE TABLE `tbl_form_8b` (
  `id` int(11) NOT NULL,
  `tbl_form_type_id` int(11) NOT NULL,
  `tbl_proprietor_id` int(11) NOT NULL,
  `tbl_pharmacist_id` int(11) NOT NULL,
  `tbl_province_id` int(11) NOT NULL,
  `tbl_district_id` int(11) NOT NULL,
  `tbl_tehsil_id` int(11) NOT NULL,
  `godaam_address` varchar(255) NOT NULL,
  `license_type` varchar(11) NOT NULL,
  `status` int(11) NOT NULL COMMENT '0 = Rejected / Not Approved, 1 = Approved, 2 = Pending / In process',
  `remarks` longtext NOT NULL,
  `record_add_by` int(11) NOT NULL,
  `record_add_date` varchar(50) NOT NULL,
  `dg_approval_date` varchar(50) DEFAULT NULL,
  `tbl_bank_id` int(11) DEFAULT NULL,
  `tbl_bank_branch_id` int(11) DEFAULT NULL,
  `amount` varchar(55) DEFAULT NULL,
  `challan_date` varchar(55) DEFAULT NULL,
  `challan_no` varchar(55) DEFAULT NULL,
  `fee_recipt` varchar(255) DEFAULT NULL,
  `is_fees` int(11) NOT NULL DEFAULT 0,
  `is_edit` int(11) NOT NULL DEFAULT 1,
  `is_dates` int(11) NOT NULL DEFAULT 0,
  `is_print` int(11) NOT NULL DEFAULT 0,
  `qr_code` varchar(255) NOT NULL,
  `tracking_code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_form_8b_apply_documents`
--

CREATE TABLE `tbl_form_8b_apply_documents` (
  `id` int(11) NOT NULL,
  `uploaded_document` varchar(255) NOT NULL,
  `document_name` varchar(255) NOT NULL,
  `document_tag_name` varchar(255) NOT NULL,
  `record_add_date` varchar(50) DEFAULT NULL,
  `record_add_by` int(11) DEFAULT NULL,
  `tbl_form_type_id` int(11) NOT NULL,
  `tbl_form_type_doc_id` int(11) NOT NULL,
  `tbl_form_8b_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_form_8c`
--

CREATE TABLE `tbl_form_8c` (
  `id` int(11) NOT NULL,
  `tbl_form_type_id` int(11) NOT NULL,
  `tbl_proprietor_id` int(11) NOT NULL,
  `tbl_pharmacist_id` int(11) NOT NULL,
  `tbl_province_id` int(11) NOT NULL,
  `tbl_district_id` int(11) NOT NULL,
  `tbl_tehsil_id` int(11) NOT NULL,
  `godaam_address` varchar(255) NOT NULL,
  `license_type` varchar(11) NOT NULL,
  `status` int(11) NOT NULL COMMENT '0 = Rejected / Not Approved, 1 = Approved, 2 = Pending / In process',
  `remarks` longtext NOT NULL,
  `record_add_by` int(11) NOT NULL,
  `record_add_date` varchar(50) NOT NULL,
  `dg_approval_date` varchar(55) DEFAULT NULL,
  `tbl_bank_id` int(11) DEFAULT NULL,
  `tbl_bank_branch_id` int(11) DEFAULT NULL,
  `amount` varchar(55) DEFAULT NULL,
  `challan_date` varchar(55) DEFAULT NULL,
  `challan_no` varchar(55) DEFAULT NULL,
  `fee_recipt` varchar(255) DEFAULT NULL,
  `is_fees` int(11) NOT NULL DEFAULT 0,
  `is_edit` int(11) NOT NULL DEFAULT 1,
  `is_dates` int(11) NOT NULL DEFAULT 0,
  `is_print` int(11) NOT NULL DEFAULT 0,
  `qr_code` varchar(255) NOT NULL,
  `tracking_code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_form_8c_apply_documents`
--

CREATE TABLE `tbl_form_8c_apply_documents` (
  `id` int(11) NOT NULL,
  `uploaded_document` varchar(255) NOT NULL,
  `document_name` varchar(255) NOT NULL,
  `document_tag_name` varchar(255) NOT NULL,
  `record_add_date` varchar(50) DEFAULT NULL,
  `record_add_by` int(11) DEFAULT NULL,
  `tbl_form_type_id` int(11) NOT NULL,
  `tbl_form_type_doc_id` int(11) NOT NULL,
  `tbl_form_8c_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_form_8d`
--

CREATE TABLE `tbl_form_8d` (
  `id` int(11) NOT NULL,
  `tbl_form_type_id` int(11) NOT NULL,
  `tbl_proprietor_id` int(11) NOT NULL,
  `tbl_pharmacist_id` int(11) NOT NULL,
  `tbl_province_id` int(11) NOT NULL,
  `tbl_district_id` int(11) NOT NULL,
  `tbl_tehsil_id` int(11) NOT NULL,
  `godaam_address` varchar(255) NOT NULL,
  `license_type` varchar(11) NOT NULL,
  `status` int(11) NOT NULL COMMENT '0 = Rejected / Not Approved, 1 = Approved, 2 = Pending / In process',
  `remarks` longtext NOT NULL,
  `record_add_by` int(11) NOT NULL,
  `record_add_date` varchar(50) NOT NULL,
  `dg_approval_date` varchar(55) DEFAULT NULL,
  `tbl_bank_id` int(11) DEFAULT NULL,
  `tbl_bank_branch_id` int(11) DEFAULT NULL,
  `amount` varchar(55) DEFAULT NULL,
  `challan_date` varchar(55) DEFAULT NULL,
  `challan_no` varchar(55) DEFAULT NULL,
  `fee_recipt` varchar(255) DEFAULT NULL,
  `is_fees` int(11) NOT NULL DEFAULT 0,
  `is_edit` int(11) NOT NULL DEFAULT 1,
  `is_dates` int(11) NOT NULL DEFAULT 0,
  `is_print` int(11) NOT NULL DEFAULT 0,
  `qr_code` varchar(255) NOT NULL,
  `tracking_code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_form_8d_apply_documents`
--

CREATE TABLE `tbl_form_8d_apply_documents` (
  `id` int(11) NOT NULL,
  `uploaded_document` varchar(255) NOT NULL,
  `document_name` varchar(255) NOT NULL,
  `document_tag_name` varchar(255) NOT NULL,
  `record_add_date` varchar(50) DEFAULT NULL,
  `record_add_by` int(11) DEFAULT NULL,
  `tbl_form_type_id` int(11) NOT NULL,
  `tbl_form_type_doc_id` int(11) NOT NULL,
  `tbl_form_8d_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_form_type`
--

CREATE TABLE `tbl_form_type` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `rules` longtext NOT NULL,
  `status` int(11) NOT NULL,
  `db_tbl_name` varchar(250) DEFAULT NULL,
  `record_add_by` int(11) NOT NULL,
  `record_add_date` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_form_type_doc`
--

CREATE TABLE `tbl_form_type_doc` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `tag_name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `record_add_by` int(11) NOT NULL,
  `record_add_date` varchar(55) NOT NULL,
  `tbl_form_type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_inspection`
--

CREATE TABLE `tbl_inspection` (
  `id` int(11) NOT NULL,
  `tbl_name` varchar(255) NOT NULL,
  `tbl_name_id` int(11) NOT NULL,
  `inspection_date` varchar(50) NOT NULL,
  `inspection_reason` varchar(255) NOT NULL,
  `tbl_form_type_id` int(11) NOT NULL,
  `license_type` varchar(11) NOT NULL COMMENT 'new or renewal',
  `license_validity` varchar(50) NOT NULL,
  `proprieter_qualified_present` int(11) NOT NULL,
  `proprieter_qualified_absent_reason` int(11) NOT NULL,
  `license_displayed` int(11) NOT NULL,
  `registration_certificate` int(11) NOT NULL,
  `sign_board` int(11) NOT NULL,
  `area` varchar(255) NOT NULL,
  `front_area` varchar(255) NOT NULL,
  `front_covered` int(11) NOT NULL,
  `air_curtain` int(11) NOT NULL,
  `protected` int(11) NOT NULL,
  `thermometer` int(11) NOT NULL,
  `thermometer_control` int(11) NOT NULL,
  `cool_chin` int(11) NOT NULL,
  `adequate_light` int(11) NOT NULL,
  `painted` int(11) NOT NULL,
  `almiras_type` int(11) NOT NULL,
  `almiras_wooden` int(11) NOT NULL,
  `almiras_glass` int(11) NOT NULL,
  `almiras_metal` int(11) NOT NULL,
  `alphabetic_order` int(11) NOT NULL,
  `storage_condition` int(11) NOT NULL,
  `controlled_drugs` int(11) NOT NULL,
  `poison_drugs` int(11) NOT NULL,
  `separate_cabin` int(11) NOT NULL,
  `sale_purchase_record` int(11) NOT NULL,
  `narcotics` int(11) NOT NULL,
  `warranties` int(11) NOT NULL,
  `prescription` int(11) NOT NULL,
  `inspector_id` int(11) DEFAULT NULL,
  `inspection_remarks` varchar(250) NOT NULL,
  `inspection_status` int(11) NOT NULL DEFAULT 4,
  `inspect_by` int(11) NOT NULL,
  `is_inspection` int(11) NOT NULL DEFAULT 1,
  `is_dates` int(11) NOT NULL DEFAULT 0,
  `is_print` int(11) NOT NULL DEFAULT 0,
  `record_add_date` varchar(50) NOT NULL,
  `latitude` varchar(255) DEFAULT NULL,
  `longitude` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_institute`
--

CREATE TABLE `tbl_institute` (
  `id` int(11) NOT NULL COMMENT 'table is for degree duration',
  `name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `record_add_by` int(11) NOT NULL,
  `record_add_date` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_log`
--

CREATE TABLE `tbl_log` (
  `id` bigint(20) NOT NULL,
  `action_type` varchar(255) NOT NULL,
  `license_type` varchar(40) NOT NULL,
  `tbl_name` varchar(255) NOT NULL,
  `tbl_name_id` int(11) NOT NULL,
  `status` int(11) NOT NULL COMMENT '2= pending / in process, 1 = approved, 0= rejection	',
  `status_by` int(11) NOT NULL,
  `status_date` varchar(255) NOT NULL,
  `remarks` longtext NOT NULL,
  `assign_to` int(11) DEFAULT 0 COMMENT 'assign to which inspector',
  `assign_date` varchar(255) NOT NULL COMMENT 'on which date assign to inspector',
  `record_add_by` int(11) NOT NULL,
  `record_add_date` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_more_proprietor`
--

CREATE TABLE `tbl_more_proprietor` (
  `id` int(11) NOT NULL,
  `proprietor_name` varchar(255) NOT NULL,
  `proprietor_cnic_no` varchar(255) NOT NULL,
  `proprietor_mobile_no` varchar(255) NOT NULL,
  `tbl_proprietor_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pharmacist`
--

CREATE TABLE `tbl_pharmacist` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `father_name` varchar(255) NOT NULL,
  `cnic` varchar(255) DEFAULT NULL,
  `pharmacy_reg_no` varchar(255) NOT NULL,
  `tbl_pharmacist_category_id` int(11) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `tbl_qualification_id` int(11) DEFAULT NULL,
  `qualification` varchar(255) DEFAULT NULL,
  `tbl_institute_id` int(11) DEFAULT NULL,
  `institute` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `province` varchar(255) DEFAULT NULL,
  `detail` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `is_kp_province` varchar(11) NOT NULL DEFAULT 'no',
  `engage` varchar(10) DEFAULT 'no',
  `is_verify` varchar(10) NOT NULL DEFAULT 'no',
  `verify_date` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `record_add_by` int(11) DEFAULT NULL,
  `record_add_date` varchar(50) DEFAULT NULL,
  `graduation_date` varchar(50) DEFAULT NULL,
  `passing_year` varchar(255) DEFAULT NULL,
  `cnic_doc` varchar(255) DEFAULT NULL,
  `degree_doc` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `dob` varchar(50) DEFAULT NULL,
  `mobile_no` varchar(50) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pharmacist_category`
--

CREATE TABLE `tbl_pharmacist_category` (
  `id` int(11) NOT NULL COMMENT 'table is for degree duration',
  `name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `record_add_by` int(11) NOT NULL,
  `record_add_date` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_proprietor`
--

CREATE TABLE `tbl_proprietor` (
  `id` int(11) NOT NULL,
  `business_name` varchar(250) NOT NULL,
  `name` varchar(255) NOT NULL,
  `father_name` varchar(255) NOT NULL,
  `cnic_no` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `mobile_no` varchar(50) NOT NULL,
  `home_address` varchar(250) NOT NULL,
  `business_address` varchar(255) NOT NULL,
  `status` int(11) DEFAULT NULL,
  `record_add_by` int(11) DEFAULT NULL,
  `record_add_date` varchar(50) DEFAULT NULL,
  `tbl_user_id` int(11) NOT NULL,
  `latitude` varchar(255) DEFAULT NULL,
  `longitude` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_proprietor_shop_images`
--

CREATE TABLE `tbl_proprietor_shop_images` (
  `id` int(11) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `tbl_proprietor_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_province`
--

CREATE TABLE `tbl_province` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `record_add_by` int(11) NOT NULL,
  `record_add_date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_qualification`
--

CREATE TABLE `tbl_qualification` (
  `id` int(11) NOT NULL COMMENT 'table is for degree duration',
  `name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `record_add_by` int(11) NOT NULL,
  `record_add_date` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_role`
--

CREATE TABLE `tbl_role` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `record_add_by` int(11) NOT NULL,
  `record_add_date` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tehsil`
--

CREATE TABLE `tbl_tehsil` (
  `id` int(11) NOT NULL,
  `tbl_province_id` int(11) DEFAULT NULL,
  `tbl_district_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `record_add_by` int(11) NOT NULL,
  `record_add_date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `image` varchar(255) NOT NULL,
  `gender` varchar(45) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `record_add_by` int(11) NOT NULL,
  `record_add_date` varchar(45) NOT NULL,
  `tbl_district_id` int(11) NOT NULL,
  `forgot_password_token` longtext DEFAULT NULL,
  `approve_by` int(11) DEFAULT NULL,
  `approve_status` int(11) NOT NULL,
  `tbl_role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_application_renewel`
--
ALTER TABLE `tbl_application_renewel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_banks`
--
ALTER TABLE `tbl_banks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `index` (`record_add_by`);

--
-- Indexes for table `tbl_bank_branch`
--
ALTER TABLE `tbl_bank_branch`
  ADD PRIMARY KEY (`id`),
  ADD KEY `index` (`record_add_by`),
  ADD KEY `fk_tbl_bfc_list_bank_tbl_banks1_idx` (`tbl_banks_id`);

--
-- Indexes for table `tbl_district`
--
ALTER TABLE `tbl_district`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `record_add_by` (`record_add_by`),
  ADD KEY `name_2` (`tbl_province_id`);

--
-- Indexes for table `tbl_form_8a`
--
ALTER TABLE `tbl_form_8a`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_district` (`tbl_district_id`),
  ADD KEY `fk_pharmacist` (`tbl_pharmacist_id`),
  ADD KEY `fk_proprieter` (`tbl_proprietor_id`),
  ADD KEY `fk_province` (`tbl_province_id`),
  ADD KEY `fk_tehsil` (`tbl_tehsil_id`),
  ADD KEY `fk_form_typeID` (`tbl_form_type_id`);

--
-- Indexes for table `tbl_form_8a_apply_documents`
--
ALTER TABLE `tbl_form_8a_apply_documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tbl_form_8a_apply_documents_tbl_form_8a1_idx` (`tbl_form_8a_id`),
  ADD KEY `fk_tbl_form_8a_apply_documents_tbl_form_type1_idx` (`tbl_form_type_id`),
  ADD KEY `fk_tbl_form_8a_apply_documents_tbl_form_type_doc1_idx` (`tbl_form_type_doc_id`);

--
-- Indexes for table `tbl_form_8b`
--
ALTER TABLE `tbl_form_8b`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_district` (`tbl_district_id`),
  ADD KEY `fk_pharmacist` (`tbl_pharmacist_id`),
  ADD KEY `fk_proprieter` (`tbl_proprietor_id`),
  ADD KEY `fk_province` (`tbl_province_id`),
  ADD KEY `fk_tehsil` (`tbl_tehsil_id`),
  ADD KEY `fk_form_typeID` (`tbl_form_type_id`);

--
-- Indexes for table `tbl_form_8b_apply_documents`
--
ALTER TABLE `tbl_form_8b_apply_documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tbl_form_8a_apply_documents_tbl_form_type1_idx` (`tbl_form_type_id`),
  ADD KEY `fk_tbl_form_8a_apply_documents_tbl_form_type_doc1_idx` (`tbl_form_type_doc_id`),
  ADD KEY `fk_tbl_form_8b_apply_documents_tbl_form_8b1_idx` (`tbl_form_8b_id`);

--
-- Indexes for table `tbl_form_8c`
--
ALTER TABLE `tbl_form_8c`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_district` (`tbl_district_id`),
  ADD KEY `fk_pharmacist` (`tbl_pharmacist_id`),
  ADD KEY `fk_proprieter` (`tbl_proprietor_id`),
  ADD KEY `fk_province` (`tbl_province_id`),
  ADD KEY `fk_tehsil` (`tbl_tehsil_id`),
  ADD KEY `fk_form_typeID` (`tbl_form_type_id`);

--
-- Indexes for table `tbl_form_8c_apply_documents`
--
ALTER TABLE `tbl_form_8c_apply_documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tbl_form_8a_apply_documents_tbl_form_type1_idx` (`tbl_form_type_id`),
  ADD KEY `fk_tbl_form_8a_apply_documents_tbl_form_type_doc1_idx` (`tbl_form_type_doc_id`),
  ADD KEY `fk_tbl_form_8c_apply_documents_tbl_form_8c1_idx` (`tbl_form_8c_id`);

--
-- Indexes for table `tbl_form_8d`
--
ALTER TABLE `tbl_form_8d`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_district` (`tbl_district_id`),
  ADD KEY `fk_pharmacist` (`tbl_pharmacist_id`),
  ADD KEY `fk_proprieter` (`tbl_proprietor_id`),
  ADD KEY `fk_province` (`tbl_province_id`),
  ADD KEY `fk_tehsil` (`tbl_tehsil_id`),
  ADD KEY `fk_form_typeID` (`tbl_form_type_id`);

--
-- Indexes for table `tbl_form_8d_apply_documents`
--
ALTER TABLE `tbl_form_8d_apply_documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tbl_form_8a_apply_documents_tbl_form_type1_idx` (`tbl_form_type_id`),
  ADD KEY `fk_tbl_form_8a_apply_documents_tbl_form_type_doc1_idx` (`tbl_form_type_doc_id`),
  ADD KEY `fk_tbl_form_8d_apply_documents_tbl_form_8d1_idx` (`tbl_form_8d_id`);

--
-- Indexes for table `tbl_form_type`
--
ALTER TABLE `tbl_form_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_form_type_doc`
--
ALTER TABLE `tbl_form_type_doc`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tbl_form_type_doc_tbl_form_type1_idx` (`tbl_form_type_id`);

--
-- Indexes for table `tbl_inspection`
--
ALTER TABLE `tbl_inspection`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tbl_inspection_tbl_form_type1_idx` (`tbl_form_type_id`),
  ADD KEY `inspector_id` (`inspector_id`);

--
-- Indexes for table `tbl_institute`
--
ALTER TABLE `tbl_institute`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_log`
--
ALTER TABLE `tbl_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_more_proprietor`
--
ALTER TABLE `tbl_more_proprietor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tbl_proprietor_idfk` (`tbl_proprietor_id`);

--
-- Indexes for table `tbl_pharmacist`
--
ALTER TABLE `tbl_pharmacist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tbl_pharmacist_tbl_pharmacist_category1_idx` (`tbl_pharmacist_category_id`),
  ADD KEY `fk_tbl_pharmacist_tbl_qualification1_idx` (`tbl_qualification_id`),
  ADD KEY `fk_tbl_pharmacist_tbl_institute1_idx` (`tbl_institute_id`);

--
-- Indexes for table `tbl_pharmacist_category`
--
ALTER TABLE `tbl_pharmacist_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_proprietor`
--
ALTER TABLE `tbl_proprietor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tbl_investor_tbl_user1_idx` (`tbl_user_id`);

--
-- Indexes for table `tbl_proprietor_shop_images`
--
ALTER TABLE `tbl_proprietor_shop_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tbl_proprietor_id_fk` (`tbl_proprietor_id`);

--
-- Indexes for table `tbl_province`
--
ALTER TABLE `tbl_province`
  ADD PRIMARY KEY (`id`),
  ADD KEY `record_add_by` (`record_add_by`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `tbl_qualification`
--
ALTER TABLE `tbl_qualification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_role`
--
ALTER TABLE `tbl_role`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`),
  ADD KEY `indexes` (`record_add_by`);

--
-- Indexes for table `tbl_tehsil`
--
ALTER TABLE `tbl_tehsil`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tbl_district_id` (`tbl_district_id`),
  ADD KEY `tbl_province_id1` (`tbl_province_id`),
  ADD KEY `record_add_by` (`record_add_by`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username_UNIQUE` (`username`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`),
  ADD KEY `indexes` (`record_add_by`),
  ADD KEY `fk_tbl_admin_tbl_district1_idx` (`tbl_district_id`),
  ADD KEY `fk_tbl_user_tbl_role1_idx` (`tbl_role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_application_renewel`
--
ALTER TABLE `tbl_application_renewel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_banks`
--
ALTER TABLE `tbl_banks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_bank_branch`
--
ALTER TABLE `tbl_bank_branch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_district`
--
ALTER TABLE `tbl_district`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_form_8a`
--
ALTER TABLE `tbl_form_8a`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_form_8a_apply_documents`
--
ALTER TABLE `tbl_form_8a_apply_documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_form_8b`
--
ALTER TABLE `tbl_form_8b`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_form_8b_apply_documents`
--
ALTER TABLE `tbl_form_8b_apply_documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_form_8c`
--
ALTER TABLE `tbl_form_8c`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_form_8c_apply_documents`
--
ALTER TABLE `tbl_form_8c_apply_documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_form_8d`
--
ALTER TABLE `tbl_form_8d`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_form_8d_apply_documents`
--
ALTER TABLE `tbl_form_8d_apply_documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_form_type`
--
ALTER TABLE `tbl_form_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_form_type_doc`
--
ALTER TABLE `tbl_form_type_doc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_inspection`
--
ALTER TABLE `tbl_inspection`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_institute`
--
ALTER TABLE `tbl_institute`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'table is for degree duration';

--
-- AUTO_INCREMENT for table `tbl_log`
--
ALTER TABLE `tbl_log`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_more_proprietor`
--
ALTER TABLE `tbl_more_proprietor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_pharmacist`
--
ALTER TABLE `tbl_pharmacist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_pharmacist_category`
--
ALTER TABLE `tbl_pharmacist_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'table is for degree duration';

--
-- AUTO_INCREMENT for table `tbl_proprietor`
--
ALTER TABLE `tbl_proprietor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_proprietor_shop_images`
--
ALTER TABLE `tbl_proprietor_shop_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_province`
--
ALTER TABLE `tbl_province`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_qualification`
--
ALTER TABLE `tbl_qualification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'table is for degree duration';

--
-- AUTO_INCREMENT for table `tbl_role`
--
ALTER TABLE `tbl_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_tehsil`
--
ALTER TABLE `tbl_tehsil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_bank_branch`
--
ALTER TABLE `tbl_bank_branch`
  ADD CONSTRAINT `fk_tbl_bfc_list_bank_tbl_banks1` FOREIGN KEY (`tbl_banks_id`) REFERENCES `tbl_banks` (`id`);

--
-- Constraints for table `tbl_district`
--
ALTER TABLE `tbl_district`
  ADD CONSTRAINT `tbl_province_id` FOREIGN KEY (`tbl_province_id`) REFERENCES `tbl_province` (`id`);

--
-- Constraints for table `tbl_form_8a`
--
ALTER TABLE `tbl_form_8a`
  ADD CONSTRAINT `fk_district` FOREIGN KEY (`tbl_district_id`) REFERENCES `tbl_district` (`id`),
  ADD CONSTRAINT `fk_form_typeID` FOREIGN KEY (`tbl_form_type_id`) REFERENCES `tbl_form_type` (`id`),
  ADD CONSTRAINT `fk_pharmacist` FOREIGN KEY (`tbl_pharmacist_id`) REFERENCES `tbl_pharmacist` (`id`),
  ADD CONSTRAINT `fk_proprieter` FOREIGN KEY (`tbl_proprietor_id`) REFERENCES `tbl_proprietor` (`id`),
  ADD CONSTRAINT `fk_province` FOREIGN KEY (`tbl_province_id`) REFERENCES `tbl_province` (`id`),
  ADD CONSTRAINT `fk_tehsil` FOREIGN KEY (`tbl_tehsil_id`) REFERENCES `tbl_tehsil` (`id`);

--
-- Constraints for table `tbl_form_8a_apply_documents`
--
ALTER TABLE `tbl_form_8a_apply_documents`
  ADD CONSTRAINT `fk_tbl_form_8a_apply_documents_tbl_form_8a1` FOREIGN KEY (`tbl_form_8a_id`) REFERENCES `tbl_form_8a` (`id`),
  ADD CONSTRAINT `fk_tbl_form_8a_apply_documents_tbl_form_type1` FOREIGN KEY (`tbl_form_type_id`) REFERENCES `tbl_form_type` (`id`),
  ADD CONSTRAINT `fk_tbl_form_8a_apply_documents_tbl_form_type_doc1` FOREIGN KEY (`tbl_form_type_doc_id`) REFERENCES `tbl_form_type_doc` (`id`);

--
-- Constraints for table `tbl_form_8b`
--
ALTER TABLE `tbl_form_8b`
  ADD CONSTRAINT `fk_district0` FOREIGN KEY (`tbl_district_id`) REFERENCES `tbl_district` (`id`),
  ADD CONSTRAINT `fk_form_typeID0` FOREIGN KEY (`tbl_form_type_id`) REFERENCES `tbl_form_type` (`id`),
  ADD CONSTRAINT `fk_pharmacist0` FOREIGN KEY (`tbl_pharmacist_id`) REFERENCES `tbl_pharmacist` (`id`),
  ADD CONSTRAINT `fk_proprieter0` FOREIGN KEY (`tbl_proprietor_id`) REFERENCES `tbl_proprietor` (`id`),
  ADD CONSTRAINT `fk_province0` FOREIGN KEY (`tbl_province_id`) REFERENCES `tbl_province` (`id`),
  ADD CONSTRAINT `fk_tehsil0` FOREIGN KEY (`tbl_tehsil_id`) REFERENCES `tbl_tehsil` (`id`);

--
-- Constraints for table `tbl_form_8b_apply_documents`
--
ALTER TABLE `tbl_form_8b_apply_documents`
  ADD CONSTRAINT `fk_tbl_form_8a_apply_documents_tbl_form_type10` FOREIGN KEY (`tbl_form_type_id`) REFERENCES `tbl_form_type` (`id`),
  ADD CONSTRAINT `fk_tbl_form_8a_apply_documents_tbl_form_type_doc10` FOREIGN KEY (`tbl_form_type_doc_id`) REFERENCES `tbl_form_type_doc` (`id`),
  ADD CONSTRAINT `fk_tbl_form_8b_apply_documents_tbl_form_8b1` FOREIGN KEY (`tbl_form_8b_id`) REFERENCES `tbl_form_8b` (`id`);

--
-- Constraints for table `tbl_form_8c`
--
ALTER TABLE `tbl_form_8c`
  ADD CONSTRAINT `fk_district00` FOREIGN KEY (`tbl_district_id`) REFERENCES `tbl_district` (`id`),
  ADD CONSTRAINT `fk_form_typeID00` FOREIGN KEY (`tbl_form_type_id`) REFERENCES `tbl_form_type` (`id`),
  ADD CONSTRAINT `fk_pharmacist00` FOREIGN KEY (`tbl_pharmacist_id`) REFERENCES `tbl_pharmacist` (`id`),
  ADD CONSTRAINT `fk_proprieter00` FOREIGN KEY (`tbl_proprietor_id`) REFERENCES `tbl_proprietor` (`id`),
  ADD CONSTRAINT `fk_province00` FOREIGN KEY (`tbl_province_id`) REFERENCES `tbl_province` (`id`),
  ADD CONSTRAINT `fk_tehsil00` FOREIGN KEY (`tbl_tehsil_id`) REFERENCES `tbl_tehsil` (`id`);

--
-- Constraints for table `tbl_form_8c_apply_documents`
--
ALTER TABLE `tbl_form_8c_apply_documents`
  ADD CONSTRAINT `fk_tbl_form_8a_apply_documents_tbl_form_type100` FOREIGN KEY (`tbl_form_type_id`) REFERENCES `tbl_form_type` (`id`),
  ADD CONSTRAINT `fk_tbl_form_8a_apply_documents_tbl_form_type_doc100` FOREIGN KEY (`tbl_form_type_doc_id`) REFERENCES `tbl_form_type_doc` (`id`),
  ADD CONSTRAINT `fk_tbl_form_8c_apply_documents_tbl_form_8c1` FOREIGN KEY (`tbl_form_8c_id`) REFERENCES `tbl_form_8c` (`id`);

--
-- Constraints for table `tbl_form_8d`
--
ALTER TABLE `tbl_form_8d`
  ADD CONSTRAINT `fk_district000` FOREIGN KEY (`tbl_district_id`) REFERENCES `tbl_district` (`id`),
  ADD CONSTRAINT `fk_form_typeID000` FOREIGN KEY (`tbl_form_type_id`) REFERENCES `tbl_form_type` (`id`),
  ADD CONSTRAINT `fk_pharmacist000` FOREIGN KEY (`tbl_pharmacist_id`) REFERENCES `tbl_pharmacist` (`id`),
  ADD CONSTRAINT `fk_proprieter000` FOREIGN KEY (`tbl_proprietor_id`) REFERENCES `tbl_proprietor` (`id`),
  ADD CONSTRAINT `fk_province000` FOREIGN KEY (`tbl_province_id`) REFERENCES `tbl_province` (`id`),
  ADD CONSTRAINT `fk_tehsil000` FOREIGN KEY (`tbl_tehsil_id`) REFERENCES `tbl_tehsil` (`id`);

--
-- Constraints for table `tbl_form_8d_apply_documents`
--
ALTER TABLE `tbl_form_8d_apply_documents`
  ADD CONSTRAINT `fk_tbl_form_8a_apply_documents_tbl_form_type1000` FOREIGN KEY (`tbl_form_type_id`) REFERENCES `tbl_form_type` (`id`),
  ADD CONSTRAINT `fk_tbl_form_8a_apply_documents_tbl_form_type_doc1000` FOREIGN KEY (`tbl_form_type_doc_id`) REFERENCES `tbl_form_type_doc` (`id`),
  ADD CONSTRAINT `fk_tbl_form_8d_apply_documents_tbl_form_8d1` FOREIGN KEY (`tbl_form_8d_id`) REFERENCES `tbl_form_8d` (`id`);

--
-- Constraints for table `tbl_form_type_doc`
--
ALTER TABLE `tbl_form_type_doc`
  ADD CONSTRAINT `fk_tbl_form_type_doc_tbl_form_type1` FOREIGN KEY (`tbl_form_type_id`) REFERENCES `tbl_form_type` (`id`);

--
-- Constraints for table `tbl_inspection`
--
ALTER TABLE `tbl_inspection`
  ADD CONSTRAINT `inspector_id` FOREIGN KEY (`inspector_id`) REFERENCES `tbl_user` (`id`);

--
-- Constraints for table `tbl_more_proprietor`
--
ALTER TABLE `tbl_more_proprietor`
  ADD CONSTRAINT `tbl_proprietor_idfk` FOREIGN KEY (`tbl_proprietor_id`) REFERENCES `tbl_proprietor` (`id`);

--
-- Constraints for table `tbl_pharmacist`
--
ALTER TABLE `tbl_pharmacist`
  ADD CONSTRAINT `fk_tbl_pharmacist_tbl_institute1` FOREIGN KEY (`tbl_institute_id`) REFERENCES `tbl_institute` (`id`),
  ADD CONSTRAINT `fk_tbl_pharmacist_tbl_pharmacist_category1` FOREIGN KEY (`tbl_pharmacist_category_id`) REFERENCES `tbl_pharmacist_category` (`id`),
  ADD CONSTRAINT `fk_tbl_pharmacist_tbl_qualification1` FOREIGN KEY (`tbl_qualification_id`) REFERENCES `tbl_qualification` (`id`);

--
-- Constraints for table `tbl_proprietor_shop_images`
--
ALTER TABLE `tbl_proprietor_shop_images`
  ADD CONSTRAINT `tbl_proprietor_id_fk` FOREIGN KEY (`tbl_proprietor_id`) REFERENCES `tbl_proprietor` (`id`);

--
-- Constraints for table `tbl_tehsil`
--
ALTER TABLE `tbl_tehsil`
  ADD CONSTRAINT `tbl_district_id` FOREIGN KEY (`tbl_district_id`) REFERENCES `tbl_district` (`id`),
  ADD CONSTRAINT `tbl_province_id1` FOREIGN KEY (`tbl_province_id`) REFERENCES `tbl_province` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


DROP DATABASE IF EXISTS store_employees;
CREATE DATABASE store_employees;
USE store_employees;


CREATE TABLE `employees` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(40) NOT NULL,
  `birth_date` date NOT NULL,
  `id_code` varchar(20) NOT NULL,
  `is_employee` tinyint(1) NOT NULL DEFAULT '1',
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `introduction_en` varchar(255) DEFAULT NULL,
  `work_experience_en` varchar(255) DEFAULT NULL,
  `education_en` varchar(255) DEFAULT NULL,
  `introduction_sp` varchar(255) DEFAULT NULL,
  `work_experience_sp` varchar(255) DEFAULT NULL,
  `education_sp` varchar(255) DEFAULT NULL,
  `introduction_fr` varchar(255) DEFAULT NULL,
  `work_experience_fr` varchar(255) DEFAULT NULL,
  `education_fr` varchar(255) DEFAULT NULL,
  `created_by` varchar(100) NOT NULL,
  `updated_by` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


INSERT INTO `employees` (`id`, `name`, `birth_date`, `id_code`, `is_employee`, `email`, `phone`, `address`, `introduction_en`, `work_experience_en`, `education_en`, `introduction_sp`, `work_experience_sp`, `education_sp`, `introduction_fr`, `work_experience_fr`, `education_fr`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'kunle', '2018-08-05', '001', 1, 'kunle@doc.com', '+12673367', '12 Jane Doe Avenue', 'introduction_en',  'work_experience_en', 'education_en', 'introduction_sp', 'work_experience_sp', 'education_sp', 'introduction_fr', 'work_experience_fr', 'education_fr', 'dayo', 'dayo', '2018-11-24 12:56:37', '2018-11-24 12:56:37');

SELECT * FROM `employees` WHERE `id` = 1;



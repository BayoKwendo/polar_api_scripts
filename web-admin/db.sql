-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 11, 2018 at 11:52 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `afomeng_sandbox`
--

-- --------------------------------------------------------

--
-- Table structure for table `applicant_info`
--

CREATE TABLE `applicant_info` (
  `id` bigint(20) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `email_address` varchar(100) NOT NULL,
  `contact` varchar(50) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `last_visit` datetime NOT NULL,
  `activated` tinyint(1) NOT NULL DEFAULT '0',
  `activation_code` varchar(255) NOT NULL DEFAULT '0',
  `photo` varchar(255) NOT NULL,
  `about_me` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `applicant_info`
--

INSERT INTO `applicant_info` (`id`, `first_name`, `last_name`, `email_address`, `contact`, `username`, `password`, `last_visit`, `activated`, `activation_code`, `photo`, `about_me`) VALUES
(10, 'Wadia', 'Alfred', 'wadiaonline@gmail.com', '29832249230', 'walfred', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '2018-01-11 19:40:07', 1, '0', '1515688828.png', 'This is me'),
(11, 'Gerald', 'Chaku', 'gerrodo15@gmail.com', '0704729612', 'gerro', 'faa11576ed5bcc2bb6d6052d06f381625bc6f92f', '2018-01-11 19:37:03', 1, '0', '1515688887.jpeg', 'I am the realest G in this shit.');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `alpha_2_code` varchar(2) DEFAULT NULL,
  `alpha_3_code` varchar(3) DEFAULT NULL,
  `country_name` varchar(52) DEFAULT NULL,
  `nationality` varchar(39) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `alpha_2_code`, `alpha_3_code`, `country_name`, `nationality`) VALUES
(4, 'AF', 'AFG', 'Afghanistan', 'Afghan'),
(8, 'AL', 'ALB', 'Albania', 'Albanian'),
(10, 'AQ', 'ATA', 'Antarctica', 'Antarctic'),
(12, 'DZ', 'DZA', 'Algeria', 'Algerian'),
(16, 'AS', 'ASM', 'American Samoa', 'American Samoan'),
(20, 'AD', 'AND', 'Andorra', 'Andorran'),
(24, 'AO', 'AGO', 'Angola', 'Angolan'),
(28, 'AG', 'ATG', 'Antigua and Barbuda', 'Antiguan or Barbudan'),
(31, 'AZ', 'AZE', 'Azerbaijan', 'Azerbaijani, Azeri'),
(32, 'AR', 'ARG', 'Argentina', 'Argentine'),
(36, 'AU', 'AUS', 'Australia', 'Australian'),
(40, 'AT', 'AUT', 'Austria', 'Austrian'),
(44, 'BS', 'BHS', 'Bahamas', 'Bahamian'),
(48, 'BH', 'BHR', 'Bahrain', 'Bahraini'),
(50, 'BD', 'BGD', 'Bangladesh', 'Bangladeshi'),
(51, 'AM', 'ARM', 'Armenia', 'Armenian'),
(52, 'BB', 'BRB', 'Barbados', 'Barbadian'),
(56, 'BE', 'BEL', 'Belgium', 'Belgian'),
(60, 'BM', 'BMU', 'Bermuda', 'Bermudian, Bermudan'),
(64, 'BT', 'BTN', 'Bhutan', 'Bhutanese'),
(68, 'BO', 'BOL', 'Bolivia (Plurinational State of)', 'Bolivian'),
(70, 'BA', 'BIH', 'Bosnia and Herzegovina', 'Bosnian or Herzegovinian'),
(72, 'BW', 'BWA', 'Botswana', 'Motswana, Botswanan'),
(74, 'BV', 'BVT', 'Bouvet Island', 'Bouvet Island'),
(76, 'BR', 'BRA', 'Brazil', 'Brazilian'),
(84, 'BZ', 'BLZ', 'Belize', 'Belizean'),
(86, 'IO', 'IOT', 'British Indian Ocean Territory', 'BIOT'),
(90, 'SB', 'SLB', 'Solomon Islands', 'Solomon Island'),
(92, 'VG', 'VGB', 'Virgin Islands (British)', 'British Virgin Island'),
(96, 'BN', 'BRN', 'Brunei Darussalam', 'Bruneian'),
(100, 'BG', 'BGR', 'Bulgaria', 'Bulgarian'),
(104, 'MM', 'MMR', 'Myanmar', 'Burmese'),
(108, 'BI', 'BDI', 'Burundi', 'Burundian'),
(112, 'BY', 'BLR', 'Belarus', 'Belarusian'),
(116, 'KH', 'KHM', 'Cambodia', 'Cambodian'),
(120, 'CM', 'CMR', 'Cameroon', 'Cameroonian'),
(124, 'CA', 'CAN', 'Canada', 'Canadian'),
(132, 'CV', 'CPV', 'Cabo Verde', 'Cabo Verdean'),
(136, 'KY', 'CYM', 'Cayman Islands', 'Caymanian'),
(140, 'CF', 'CAF', 'Central African Republic', 'Central African'),
(144, 'LK', 'LKA', 'Sri Lanka', 'Sri Lankan'),
(148, 'TD', 'TCD', 'Chad', 'Chadian'),
(152, 'CL', 'CHL', 'Chile', 'Chilean'),
(156, 'CN', 'CHN', 'China', 'Chinese'),
(158, 'TW', 'TWN', 'Taiwan, Province of China', 'Chinese, Taiwanese'),
(162, 'CX', 'CXR', 'Christmas Island', 'Christmas Island'),
(166, 'CC', 'CCK', 'Cocos (Keeling) Islands', 'Cocos Island'),
(170, 'CO', 'COL', 'Colombia', 'Colombian'),
(174, 'KM', 'COM', 'Comoros', 'Comoran, Comorian'),
(175, 'YT', 'MYT', 'Mayotte', 'Mahoran'),
(178, 'CG', 'COG', 'Congo (Republic of the)', 'Congolese'),
(180, 'CD', 'COD', 'Congo (Democratic Republic of the)', 'Congolese'),
(184, 'CK', 'COK', 'Cook Islands', 'Cook Island'),
(188, 'CR', 'CRI', 'Costa Rica', 'Costa Rican'),
(191, 'HR', 'HRV', 'Croatia', 'Croatian'),
(192, 'CU', 'CUB', 'Cuba', 'Cuban'),
(196, 'CY', 'CYP', 'Cyprus', 'Cypriot'),
(203, 'CZ', 'CZE', 'Czech Republic', 'Czech'),
(204, 'BJ', 'BEN', 'Benin', 'Beninese, Beninois'),
(208, 'DK', 'DNK', 'Denmark', 'Danish'),
(212, 'DM', 'DMA', 'Dominica', 'Dominican'),
(214, 'DO', 'DOM', 'Dominican Republic', 'Dominican'),
(218, 'EC', 'ECU', 'Ecuador', 'Ecuadorian'),
(222, 'SV', 'SLV', 'El Salvador', 'Salvadoran'),
(226, 'GQ', 'GNQ', 'Equatorial Guinea', 'Equatorial Guinean, Equatoguinean'),
(231, 'ET', 'ETH', 'Ethiopia', 'Ethiopian'),
(232, 'ER', 'ERI', 'Eritrea', 'Eritrean'),
(233, 'EE', 'EST', 'Estonia', 'Estonian'),
(234, 'FO', 'FRO', 'Faroe Islands', 'Faroese'),
(238, 'FK', 'FLK', 'Falkland Islands (Malvinas)', 'Falkland Island'),
(239, 'GS', 'SGS', 'South Georgia and the South Sandwich Islands', 'South Georgia or South Sandwich Islands'),
(242, 'FJ', 'FJI', 'Fiji', 'Fijian'),
(246, 'FI', 'FIN', 'Finland', 'Finnish'),
(248, 'AX', 'ALA', 'Aland Islands', 'Aland Island'),
(250, 'FR', 'FRA', 'France', 'French'),
(254, 'GF', 'GUF', 'French Guiana', 'French Guianese'),
(258, 'PF', 'PYF', 'French Polynesia', 'French Polynesian'),
(260, 'TF', 'ATF', 'French Southern Territories', 'French Southern Territories'),
(262, 'DJ', 'DJI', 'Djibouti', 'Djiboutian'),
(266, 'GA', 'GAB', 'Gabon', 'Gabonese'),
(268, 'GE', 'GEO', 'Georgia', 'Georgian'),
(270, 'GM', 'GMB', 'Gambia', 'Gambian'),
(275, 'PS', 'PSE', 'Palestine, State of', 'Palestinian'),
(276, 'DE', 'DEU', 'Germany', 'German'),
(288, 'GH', 'GHA', 'Ghana', 'Ghanaian'),
(292, 'GI', 'GIB', 'Gibraltar', 'Gibraltar'),
(296, 'KI', 'KIR', 'Kiribati', 'I-Kiribati'),
(300, 'GR', 'GRC', 'Greece', 'Greek, Hellenic'),
(304, 'GL', 'GRL', 'Greenland', 'Greenlandic'),
(308, 'GD', 'GRD', 'Grenada', 'Grenadian'),
(312, 'GP', 'GLP', 'Guadeloupe', 'Guadeloupe'),
(316, 'GU', 'GUM', 'Guam', 'Guamanian, Guambat'),
(320, 'GT', 'GTM', 'Guatemala', 'Guatemalan'),
(324, 'GN', 'GIN', 'Guinea', 'Guinean'),
(328, 'GY', 'GUY', 'Guyana', 'Guyanese'),
(332, 'HT', 'HTI', 'Haiti', 'Haitian'),
(334, 'HM', 'HMD', 'Heard Island and McDonald Islands', 'Heard Island or McDonald Islands'),
(336, 'VA', 'VAT', 'Vatican City State', 'Vatican'),
(340, 'HN', 'HND', 'Honduras', 'Honduran'),
(344, 'HK', 'HKG', 'Hong Kong', 'Hong Kong, Hong Kongese'),
(348, 'HU', 'HUN', 'Hungary', 'Hungarian, Magyar'),
(352, 'IS', 'ISL', 'Iceland', 'Icelandic'),
(356, 'IN', 'IND', 'India', 'Indian'),
(360, 'ID', 'IDN', 'Indonesia', 'Indonesian'),
(364, 'IR', 'IRN', 'Iran', 'Iranian, Persian'),
(368, 'IQ', 'IRQ', 'Iraq', 'Iraqi'),
(372, 'IE', 'IRL', 'Ireland', 'Irish'),
(376, 'IL', 'ISR', 'Israel', 'Israeli'),
(380, 'IT', 'ITA', 'Italy', 'Italian'),
(384, 'CI', 'CIV', 'Cote d\'Ivoire', 'Ivorian'),
(388, 'JM', 'JAM', 'Jamaica', 'Jamaican'),
(392, 'JP', 'JPN', 'Japan', 'Japanese'),
(398, 'KZ', 'KAZ', 'Kazakhstan', 'Kazakhstani, Kazakh'),
(400, 'JO', 'JOR', 'Jordan', 'Jordanian'),
(404, 'KE', 'KEN', 'Kenya', 'Kenyan'),
(408, 'KP', 'PRK', 'Korea (Democratic People\'s Republic of)', 'North Korean'),
(410, 'KR', 'KOR', 'Korea (Republic of)', 'South Korean'),
(414, 'KW', 'KWT', 'Kuwait', 'Kuwaiti'),
(417, 'KG', 'KGZ', 'Kyrgyzstan', 'Kyrgyzstani, Kyrgyz, Kirgiz, Kirghiz'),
(418, 'LA', 'LAO', 'Lao People\'s Democratic Republic', 'Lao, Laotian'),
(422, 'LB', 'LBN', 'Lebanon', 'Lebanese'),
(426, 'LS', 'LSO', 'Lesotho', 'Basotho'),
(428, 'LV', 'LVA', 'Latvia', 'Latvian'),
(430, 'LR', 'LBR', 'Liberia', 'Liberian'),
(434, 'LY', 'LBY', 'Libya', 'Libyan'),
(438, 'LI', 'LIE', 'Liechtenstein', 'Liechtenstein'),
(440, 'LT', 'LTU', 'Lithuania', 'Lithuanian'),
(442, 'LU', 'LUX', 'Luxembourg', 'Luxembourg, Luxembourgish'),
(446, 'MO', 'MAC', 'Macao', 'Macanese, Chinese'),
(450, 'MG', 'MDG', 'Madagascar', 'Malagasy'),
(454, 'MW', 'MWI', 'Malawi', 'Malawian'),
(458, 'MY', 'MYS', 'Malaysia', 'Malaysian'),
(462, 'MV', 'MDV', 'Maldives', 'Maldivian'),
(466, 'ML', 'MLI', 'Mali', 'Malian, Malinese'),
(470, 'MT', 'MLT', 'Malta', 'Maltese'),
(474, 'MQ', 'MTQ', 'Martinique', 'Martiniquais, Martinican'),
(478, 'MR', 'MRT', 'Mauritania', 'Mauritanian'),
(480, 'MU', 'MUS', 'Mauritius', 'Mauritian'),
(484, 'MX', 'MEX', 'Mexico', 'Mexican'),
(492, 'MC', 'MCO', 'Monaco', 'Monegasque, Monacan'),
(496, 'MN', 'MNG', 'Mongolia', 'Mongolian'),
(498, 'MD', 'MDA', 'Moldova (Republic of)', 'Moldovan'),
(499, 'ME', 'MNE', 'Montenegro', 'Montenegrin'),
(500, 'MS', 'MSR', 'Montserrat', 'Montserratian'),
(504, 'MA', 'MAR', 'Morocco', 'Moroccan'),
(508, 'MZ', 'MOZ', 'Mozambique', 'Mozambican'),
(512, 'OM', 'OMN', 'Oman', 'Omani'),
(516, 'NA', 'NAM', 'Namibia', 'Namibian'),
(520, 'NR', 'NRU', 'Nauru', 'Nauruan'),
(524, 'NP', 'NPL', 'Nepal', 'Nepali, Nepalese'),
(528, 'NL', 'NLD', 'Netherlands', 'Dutch, Netherlandic'),
(531, 'CW', 'CUW', 'Curacao', 'Curacaoan'),
(533, 'AW', 'ABW', 'Aruba', 'Aruban'),
(534, 'SX', 'SXM', 'Sint Maarten (Dutch part)', 'Sint Maarten'),
(535, 'BQ', 'BES', 'Bonaire, Sint Eustatius and Saba', 'Bonaire'),
(540, 'NC', 'NCL', 'New Caledonia', 'New Caledonian'),
(548, 'VU', 'VUT', 'Vanuatu', 'Ni-Vanuatu, Vanuatuan'),
(554, 'NZ', 'NZL', 'New Zealand', 'New Zealand, NZ'),
(558, 'NI', 'NIC', 'Nicaragua', 'Nicaraguan'),
(562, 'NE', 'NER', 'Niger', 'Nigerien'),
(566, 'NG', 'NGA', 'Nigeria', 'Nigerian'),
(570, 'NU', 'NIU', 'Niue', 'Niuean'),
(574, 'NF', 'NFK', 'Norfolk Island', 'Norfolk Island'),
(578, 'NO', 'NOR', 'Norway', 'Norwegian'),
(580, 'MP', 'MNP', 'Northern Mariana Islands', 'Northern Marianan'),
(581, 'UM', 'UMI', 'United States Minor Outlying Islands', 'American'),
(583, 'FM', 'FSM', 'Micronesia (Federated States of)', 'Micronesian'),
(584, 'MH', 'MHL', 'Marshall Islands', 'Marshallese'),
(585, 'PW', 'PLW', 'Palau', 'Palauan'),
(586, 'PK', 'PAK', 'Pakistan', 'Pakistani'),
(591, 'PA', 'PAN', 'Panama', 'Panamanian'),
(598, 'PG', 'PNG', 'Papua New Guinea', 'Papua New Guinean, Papuan'),
(600, 'PY', 'PRY', 'Paraguay', 'Paraguayan'),
(604, 'PE', 'PER', 'Peru', 'Peruvian'),
(608, 'PH', 'PHL', 'Philippines', 'Philippine, Filipino'),
(612, 'PN', 'PCN', 'Pitcairn', 'Pitcairn Island'),
(616, 'PL', 'POL', 'Poland', 'Polish'),
(620, 'PT', 'PRT', 'Portugal', 'Portuguese'),
(624, 'GW', 'GNB', 'Guinea-Bissau', 'Bissau-Guinean'),
(626, 'TL', 'TLS', 'Timor-Leste', 'Timorese'),
(630, 'PR', 'PRI', 'Puerto Rico', 'Puerto Rican'),
(634, 'QA', 'QAT', 'Qatar', 'Qatari'),
(638, 'RE', 'REU', 'Reunion', 'Reunionese, Reunionnais'),
(642, 'RO', 'ROU', 'Romania', 'Romanian'),
(643, 'RU', 'RUS', 'Russian Federation', 'Russian'),
(646, 'RW', 'RWA', 'Rwanda', 'Rwandan'),
(652, 'BL', 'BLM', 'Saint Barthelemy', 'Barthelemois'),
(654, 'SH', 'SHN', 'Saint Helena, Ascension and Tristan da Cunha', 'Saint Helenian'),
(659, 'KN', 'KNA', 'Saint Kitts and Nevis', 'Kittitian or Nevisian'),
(660, 'AI', 'AIA', 'Anguilla', 'Anguillan'),
(662, 'LC', 'LCA', 'Saint Lucia', 'Saint Lucian'),
(663, 'MF', 'MAF', 'Saint Martin (French part)', 'Saint-Martinoise'),
(666, 'PM', 'SPM', 'Saint Pierre and Miquelon', 'Saint-Pierrais or Miquelonnais'),
(670, 'VC', 'VCT', 'Saint Vincent and the Grenadines', 'Saint Vincentian, Vincentian'),
(674, 'SM', 'SMR', 'San Marino', 'Sammarinese'),
(678, 'ST', 'STP', 'Sao Tome and Principe', 'Sao Tomean'),
(682, 'SA', 'SAU', 'Saudi Arabia', 'Saudi, Saudi Arabian'),
(686, 'SN', 'SEN', 'Senegal', 'Senegalese'),
(688, 'RS', 'SRB', 'Serbia', 'Serbian'),
(690, 'SC', 'SYC', 'Seychelles', 'Seychellois'),
(694, 'SL', 'SLE', 'Sierra Leone', 'Sierra Leonean'),
(702, 'SG', 'SGP', 'Singapore', 'Singaporean'),
(703, 'SK', 'SVK', 'Slovakia', 'Slovak'),
(704, 'VN', 'VNM', 'Vietnam', 'Vietnamese'),
(705, 'SI', 'SVN', 'Slovenia', 'Slovenian, Slovene'),
(706, 'SO', 'SOM', 'Somalia', 'Somali, Somalian'),
(710, 'ZA', 'ZAF', 'South Africa', 'South African'),
(716, 'ZW', 'ZWE', 'Zimbabwe', 'Zimbabwean'),
(724, 'ES', 'ESP', 'Spain', 'Spanish'),
(728, 'SS', 'SSD', 'South Sudan', 'South Sudanese'),
(729, 'SD', 'SDN', 'Sudan', 'Sudanese'),
(732, 'EH', 'ESH', 'Western Sahara', 'Sahrawi, Sahrawian, Sahraouian'),
(740, 'SR', 'SUR', 'Suriname', 'Surinamese'),
(744, 'SJ', 'SJM', 'Svalbard and Jan Mayen', 'Svalbard'),
(748, 'SZ', 'SWZ', 'Swaziland', 'Swazi'),
(752, 'SE', 'SWE', 'Sweden', 'Swedish'),
(756, 'CH', 'CHE', 'Switzerland', 'Swiss'),
(760, 'SY', 'SYR', 'Syrian Arab Republic', 'Syrian'),
(762, 'TJ', 'TJK', 'Tajikistan', 'Tajikistani'),
(764, 'TH', 'THA', 'Thailand', 'Thai'),
(768, 'TG', 'TGO', 'Togo', 'Togolese'),
(772, 'TK', 'TKL', 'Tokelau', 'Tokelauan'),
(776, 'TO', 'TON', 'Tonga', 'Tongan'),
(780, 'TT', 'TTO', 'Trinidad and Tobago', 'Trinidadian or Tobagonian'),
(784, 'AE', 'ARE', 'United Arab Emirates', 'Emirati, Emirian, Emiri'),
(788, 'TN', 'TUN', 'Tunisia', 'Tunisian'),
(792, 'TR', 'TUR', 'Turkey', 'Turkish'),
(795, 'TM', 'TKM', 'Turkmenistan', 'Turkmen'),
(796, 'TC', 'TCA', 'Turks and Caicos Islands', 'Turks and Caicos Island'),
(798, 'TV', 'TUV', 'Tuvalu', 'Tuvaluan'),
(800, 'UG', 'UGA', 'Uganda', 'Ugandan'),
(804, 'UA', 'UKR', 'Ukraine', 'Ukrainian'),
(807, 'MK', 'MKD', 'Macedonia (the former Yugoslav Republic of)', 'Macedonian'),
(818, 'EG', 'EGY', 'Egypt', 'Egyptian'),
(826, 'GB', 'GBR', 'United Kingdom of Great Britain and Northern Ireland', 'British, UK'),
(831, 'GG', 'GGY', 'Guernsey', 'Channel Island'),
(832, 'JE', 'JEY', 'Jersey', 'Channel Island'),
(833, 'IM', 'IMN', 'Isle of Man', 'Manx'),
(834, 'TZ', 'TZA', 'Tanzania, United Republic of', 'Tanzanian'),
(840, 'US', 'USA', 'United States of America', 'American'),
(850, 'VI', 'VIR', 'Virgin Islands (U.S.)', 'U.S. Virgin Island'),
(854, 'BF', 'BFA', 'Burkina Faso', 'Burkinabe'),
(858, 'UY', 'URY', 'Uruguay', 'Uruguayan'),
(860, 'UZ', 'UZB', 'Uzbekistan', 'Uzbekistani, Uzbek'),
(862, 'VE', 'VEN', 'Venezuela (Bolivarian Republic of)', 'Venezuelan'),
(876, 'WF', 'WLF', 'Wallis and Futuna', 'Wallis and Futuna, Wallisian or Futunan'),
(882, 'WS', 'WSM', 'Samoa', 'Samoan'),
(887, 'YE', 'YEM', 'Yemen', 'Yemeni'),
(894, 'ZM', 'ZMB', 'Zambia', 'Zambian');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) NOT NULL,
  `date_posted` datetime NOT NULL,
  `job_title` varchar(100) NOT NULL,
  `job_ref` varchar(20) NOT NULL,
  `organisation` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `duty_station` varchar(50) NOT NULL,
  `reports_to` varchar(30) NOT NULL,
  `about_us` longtext NOT NULL,
  `job_summary` longtext NOT NULL,
  `kdr` longtext NOT NULL,
  `qse` longtext NOT NULL,
  `compensations` longtext NOT NULL,
  `howto_apply` longtext NOT NULL,
  `deadline` datetime NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `date_posted`, `job_title`, `job_ref`, `organisation`, `country`, `duty_station`, `reports_to`, `about_us`, `job_summary`, `kdr`, `qse`, `compensations`, `howto_apply`, `deadline`, `published`, `created_by`) VALUES
(1, '2018-01-04 16:38:27', 'Head - Internal Control', 'UGA/2017/0002', 'Stanbic Bank', 'Uganda', 'Kampala', 'Operations Manager', '<p>Stanbic Bank Uganda Limited is a subsidiary of Stanbic Africa Holdings Limited which is in turn owned by Standard Bank Group Limited (&ldquo;the Group&rdquo;), Africa&rsquo;s leading banking and financial services group. The Standard Bank Group is the leading banking group focused on emerging markets. It is the largest African banking group ranked by assets and earnings. Stanbic Bank Uganda Limited is the largest bank in Uganda by assets and market capitalization. It offers a full range of banking services through two business units; Personal and Business Banking (PBB), and Corporate and Investment Banking (CIB).</p>', '<p>The Head, Internal Control will maintain an optimal control framework for the Bank that facilitates a proactive approach to issue identification, resolution, escalation and implementation of actions to manage control gaps in order to mitigate any risk that could occur and harm the bank. The jobholder will lead and manage the control team in discharging their responsibility towards overall improvement of the control environment across the bank and providing assurance that processes for implementing controls, monitoring and reporting on the control environment are in accordance with the bank&rsquo;s management framework, standards and policies. The incumbent will also Contribute to the Bank&rsquo;s business strategy through partnership with the executive management of business / enabling areas in formulation / execution of their programs towards achievement of a compliant and sound control environment. Establish and maintain a routine monitoring framework upon which Internal Audit can place reliance at its discretion, on the effectiveness of controls at such a time and basis agreed to in consultation with Group Internal Audit.</p>', '<div style=\"-webkit-text-stroke-width:0px; margin-bottom:0in; text-align:left\"><span style=\"font-size:13px\"><span style=\"color:#555555\"><span style=\"background-color:#ffffff\"><strong><em><span style=\"font-family:georgia,\">Strategy:</span></em></strong></span></span></span></div>\r\n\r\n<ul style=\"list-style-type:disc; margin-left:0px; margin-right:0px\">\r\n	<li><span style=\"font-family:georgia,\">Determine the control strategy for the bank in consultation with business / enabler partners, Risk, Compliance, Internal Audit aligned to the bank and ROA strategies.</span></li>\r\n	<li><span style=\"font-family:georgia,\">Build effective, collaborative relationships with the country&rsquo;s senior management team, business lines and all relevant stakeholders.</span></li>\r\n</ul>\r\n\r\n<div style=\"-webkit-text-stroke-width:0px; margin-bottom:0in; text-align:left\"><span style=\"font-size:13px\"><span style=\"color:#555555\"><span style=\"background-color:#ffffff\"><strong><em><span style=\"font-family:georgia,\">Execution and Monitoring:</span></em></strong></span></span></span></div>\r\n\r\n<ul style=\"list-style-type:disc; margin-left:0px; margin-right:0px\">\r\n	<li><span style=\"font-family:georgia,\">Development of the annual control assurance reviews universe in collaboration with the Risk, Compliance and Internal Audit stakeholders.</span></li>\r\n	<li><span style=\"font-family:georgia,\">Perform appropriate monitoring activities to provide assurance on the effectiveness and state of the control environment of the bank to the executive management and all relevant stakeholders.</span></li>\r\n	<li><span style=\"font-family:georgia,\">Ensure that formal planned reviews and spot checks are conducted across the bank in line with the risk based engagement methodologies, including the production of reports.</span></li>\r\n	<li><span style=\"font-family:georgia,\">Facilitate the translation of regulatory directives into operational processes &amp; controls.</span></li>\r\n	<li><span style=\"font-family:georgia,\">Keenly monitor implemented risk and compliance management processes &ndash; as identified and assessed by Risk and Compliance to ensure adherence to standards, policies and procedures.</span></li>\r\n	<li><span style=\"font-family:georgia,\">Identify inadequate processes and controls and provide Operational Risk and Compliance and/or Business Units/ Enablers with the irregularities to facilitate the modification of processes where required.</span></li>\r\n	<li><span style=\"font-family:georgia,\">Ensure that formal root cause analysis for control failures is conducted across the bank and appropriate remedial actions are identified and implemented.</span></li>\r\n	<li><span style=\"font-family:georgia,\">Conduct special reviews upon specific request by business unit/ enabler management as appropriate.</span></li>\r\n	<li><span style=\"font-family:georgia,\">Monitor that tracking of remedial actions from internal audits, regulatory reviews, FCC investigations, control reviews and other such assurance reviews is undertaken as agreed with the business units. This will involve validation of implemented interventions prior to closure of the issues.</span></li>\r\n	<li><span style=\"font-family:georgia,\">Ensure that appropriate training initiatives towards improvement of the control environment are planned and executed as required. Ensure that coaching &amp; support opportunities are properly identified and the appropriate interventions are implemented.</span></li>\r\n	<li><span style=\"font-family:georgia,\">Actively participate in the bank&rsquo;s business initiatives, forums, committees, policy / process development or reviews, e.g. risk &amp; compliance committees, new products, projects etc. to ensure that control requirements are appropriately considered executed and reported.</span></li>\r\n	<li><span style=\"font-family:georgia,\">Effective implementation of the operational risk framework i.e. loss control, incident management, RCSA &amp; KRIs, BCM, IRM roles as per the approved risk management framework.</span></li>\r\n	<li><span style=\"font-family:georgia,\">Foster an environment of innovation for simpler, better and yet effective solutions to enhance key control capabilities within the control function and across the bank.</span></li>\r\n	<li><span style=\"font-family:georgia,\">Allocate available resources to individual engagements on a risk based perspective in line with the Unit and bank&rsquo;s overall strategy.</span></li>\r\n</ul>\r\n\r\n<div style=\"-webkit-text-stroke-width:0px; margin-bottom:0in; text-align:left\"><span style=\"font-size:13px\"><span style=\"color:#555555\"><span style=\"background-color:#ffffff\"><strong><em><span style=\"font-family:georgia,\">Reporting:</span></em></strong></span></span></span></div>\r\n\r\n<ul style=\"list-style-type:disc; margin-left:0px; margin-right:0px\">\r\n	<li><span style=\"font-family:georgia,\">Timely provision of routine dashboards as per determined frequency, monthly and quarterly reports on activities and the state of the control environment to executive, business / enabler unit management, risk, compliance, internal audit and&nbsp; ROA risk partners.</span></li>\r\n	<li><span style=\"font-family:georgia,\">Present routine monitoring and control review reports to business / process owners and ensure their understanding and commitment to the report and agreed action plans.</span></li>\r\n	<li><span style=\"font-family:georgia,\">Escalate breaches and incidents for control breaches that require senior management direction as per the appropriate escalation processes, including active participation in the remedial actions.</span></li>\r\n</ul>\r\n\r\n<div style=\"-webkit-text-stroke-width:0px; margin-bottom:0in; text-align:left\"><span style=\"font-size:13px\"><span style=\"color:#555555\"><span style=\"background-color:#ffffff\"><strong><em><span style=\"font-family:georgia,\">People Management &amp; Administration</span></em></strong></span></span></span></div>\r\n\r\n<ul style=\"list-style-type:disc; margin-left:0px; margin-right:0px\">\r\n	<li><span style=\"font-family:georgia,\">Lead and manage the Control function and ensure effective management of human capital.</span></li>\r\n	<li><span style=\"font-family:georgia,\">Agree performance contracts, monitor, review and appraise performance of staff within the unit. Develop and maintain a talent development plan.</span></li>\r\n	<li><span style=\"font-family:georgia,\">Evaluate and manage the performance of to achieve a high standard of competence, motivation and service orientation, focusing on the development and retention of promising staff.</span></li>\r\n	<li><span style=\"font-family:georgia,\">Identify knowledge/skills/ development needs, capability gaps ensure that appropriate training initiatives and or interventions are determined and executed in collaboration with the pertinent stakeholders.</span></li>\r\n	<li><span style=\"font-family:georgia,\">Manage the annual leave planning and utilisation.</span></li>\r\n	<li><span style=\"font-family:georgia,\">Monitor, manage budget and expenditure for the Control function.</span></li>\r\n</ul>', '<div style=\"-webkit-text-stroke-width:0px; margin-bottom:0in; text-align:left\"><span style=\"font-size:13px\"><span style=\"color:#555555\"><span style=\"background-color:#ffffff\"><strong><em><span style=\"font-family:georgia,\">Strategy:</span></em></strong></span></span></span></div>\r\n\r\n<ul style=\"list-style-type:disc; margin-left:0px; margin-right:0px\">\r\n	<li><span style=\"font-family:georgia,\">Determine the control strategy for the bank in consultation with business / enabler partners, Risk, Compliance, Internal Audit aligned to the bank and ROA strategies.</span></li>\r\n	<li><span style=\"font-family:georgia,\">Build effective, collaborative relationships with the country&rsquo;s senior management team, business lines and all relevant stakeholders.</span></li>\r\n</ul>\r\n\r\n<div style=\"-webkit-text-stroke-width:0px; margin-bottom:0in; text-align:left\"><span style=\"font-size:13px\"><span style=\"color:#555555\"><span style=\"background-color:#ffffff\"><strong><em><span style=\"font-family:georgia,\">Execution and Monitoring:</span></em></strong></span></span></span></div>\r\n\r\n<ul style=\"list-style-type:disc; margin-left:0px; margin-right:0px\">\r\n	<li><span style=\"font-family:georgia,\">Development of the annual control assurance reviews universe in collaboration with the Risk, Compliance and Internal Audit stakeholders.</span></li>\r\n	<li><span style=\"font-family:georgia,\">Perform appropriate monitoring activities to provide assurance on the effectiveness and state of the control environment of the bank to the executive management and all relevant stakeholders.</span></li>\r\n	<li><span style=\"font-family:georgia,\">Ensure that formal planned reviews and spot checks are conducted across the bank in line with the risk based engagement methodologies, including the production of reports.</span></li>\r\n	<li><span style=\"font-family:georgia,\">Facilitate the translation of regulatory directives into operational processes &amp; controls.</span></li>\r\n	<li><span style=\"font-family:georgia,\">Keenly monitor implemented risk and compliance management processes &ndash; as identified and assessed by Risk and Compliance to ensure adherence to standards, policies and procedures.</span></li>\r\n	<li><span style=\"font-family:georgia,\">Identify inadequate processes and controls and provide Operational Risk and Compliance and/or Business Units/ Enablers with the irregularities to facilitate the modification of processes where required.</span></li>\r\n	<li><span style=\"font-family:georgia,\">Ensure that formal root cause analysis for control failures is conducted across the bank and appropriate remedial actions are identified and implemented.</span></li>\r\n	<li><span style=\"font-family:georgia,\">Conduct special reviews upon specific request by business unit/ enabler management as appropriate.</span></li>\r\n	<li><span style=\"font-family:georgia,\">Monitor that tracking of remedial actions from internal audits, regulatory reviews, FCC investigations, control reviews and other such assurance reviews is undertaken as agreed with the business units. This will involve validation of implemented interventions prior to closure of the issues.</span></li>\r\n	<li><span style=\"font-family:georgia,\">Ensure that appropriate training initiatives towards improvement of the control environment are planned and executed as required. Ensure that coaching &amp; support opportunities are properly identified and the appropriate interventions are implemented.</span></li>\r\n	<li><span style=\"font-family:georgia,\">Actively participate in the bank&rsquo;s business initiatives, forums, committees, policy / process development or reviews, e.g. risk &amp; compliance committees, new products, projects etc. to ensure that control requirements are appropriately considered executed and reported.</span></li>\r\n	<li><span style=\"font-family:georgia,\">Effective implementation of the operational risk framework i.e. loss control, incident management, RCSA &amp; KRIs, BCM, IRM roles as per the approved risk management framework.</span></li>\r\n	<li><span style=\"font-family:georgia,\">Foster an environment of innovation for simpler, better and yet effective solutions to enhance key control capabilities within the control function and across the bank.</span></li>\r\n	<li><span style=\"font-family:georgia,\">Allocate available resources to individual engagements on a risk based perspective in line with the Unit and bank&rsquo;s overall strategy.</span></li>\r\n</ul>\r\n\r\n<div style=\"-webkit-text-stroke-width:0px; margin-bottom:0in; text-align:left\"><span style=\"font-size:13px\"><span style=\"color:#555555\"><span style=\"background-color:#ffffff\"><strong><em><span style=\"font-family:georgia,\">Reporting:</span></em></strong></span></span></span></div>\r\n\r\n<ul style=\"list-style-type:disc; margin-left:0px; margin-right:0px\">\r\n	<li><span style=\"font-family:georgia,\">Timely provision of routine dashboards as per determined frequency, monthly and quarterly reports on activities and the state of the control environment to executive, business / enabler unit management, risk, compliance, internal audit and&nbsp; ROA risk partners.</span></li>\r\n	<li><span style=\"font-family:georgia,\">Present routine monitoring and control review reports to business / process owners and ensure their understanding and commitment to the report and agreed action plans.</span></li>\r\n	<li><span style=\"font-family:georgia,\">Escalate breaches and incidents for control breaches that require senior management direction as per the appropriate escalation processes, including active participation in the remedial actions.</span></li>\r\n</ul>\r\n\r\n<div style=\"-webkit-text-stroke-width:0px; margin-bottom:0in; text-align:left\"><span style=\"font-size:13px\"><span style=\"color:#555555\"><span style=\"background-color:#ffffff\"><strong><em><span style=\"font-family:georgia,\">People Management &amp; Administration</span></em></strong></span></span></span></div>\r\n\r\n<ul style=\"list-style-type:disc; margin-left:0px; margin-right:0px\">\r\n	<li><span style=\"font-family:georgia,\">Lead and manage the Control function and ensure effective management of human capital.</span></li>\r\n	<li><span style=\"font-family:georgia,\">Agree performance contracts, monitor, review and appraise performance of staff within the unit. Develop and maintain a talent development plan.</span></li>\r\n	<li><span style=\"font-family:georgia,\">Evaluate and manage the performance of to achieve a high standard of competence, motivation and service orientation, focusing on the development and retention of promising staff.</span></li>\r\n	<li><span style=\"font-family:georgia,\">Identify knowledge/skills/ development needs, capability gaps ensure that appropriate training initiatives and or interventions are determined and executed in collaboration with the pertinent stakeholders.</span></li>\r\n	<li><span style=\"font-family:georgia,\">Manage the annual leave planning and utilisation.</span></li>\r\n	<li><span style=\"font-family:georgia,\">Monitor, manage budget and expenditure for the Control function.</span></li>\r\n</ul>', '<ul>\r\n	<li>UGX 600,000 basic monthly salary</li>\r\n	<li>UGX 3,000,000 average monthly bonuses and technical sales commissions.</li>\r\n	<li>Transport allowance and free lunch.</li>\r\n	<li>Healthcare coverage</li>\r\n	<li>Official Car upon proven performance.</li>\r\n	<li>Home ownership support.</li>\r\n	<li>Free mobile devices in tablets and phones.</li>\r\n	<li>International travels for trainings and conventions.</li>\r\n	<li>Retirement gratuity and pensions.</li>\r\n	<li>Stocks and shares in various multinational companies</li>\r\n</ul>', '<p>All candidates who wish to join the one of Africa&rsquo;s biggest Banking Groups, Stanbic Bank in the aforementioned capacity are encouraged to Apply Online by visiting Link below.</p>', '2018-01-31 16:00:00', 1, 'Web Administrator'),
(2, '2018-01-04 17:30:17', 'MTN Graduate Development Program 2018', 'UGA/2017/0001', 'MTN', 'Uganda', 'Kampala', 'Personnel Development Officer', '<p>MTN-Uganda is the leading telecommunications Company in Uganda, providing payphone, fixed lines, fax/data, internet and mobile services.</p>', '<p>MTN seeks fresh graduates who seek to align their careers by joining the MTN Graduate Development Program.</p>', '<p>None</p>', '<p>None</p>', '<p>None</p>', '<p>All applicants who wish to join the MTN Graduate Development Program 2018 should send or hand deliver their applications with detailed resumes / CVs including certified copies of academic certificates along with the names and addresses of three referees to Senior Manager, Learning &amp; Development MTN Uganda, Nyonyi Gardens P.O. Box 24624, Kampalaâ€‹. Uganda</p>', '2018-01-31 17:00:00', 1, 'Web Administrator');

-- --------------------------------------------------------

--
-- Table structure for table `job_application`
--

CREATE TABLE `job_application` (
  `applicant_names` varchar(100) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `other_names` varchar(30) NOT NULL,
  `father_name` varchar(100) NOT NULL,
  `father_contact` varchar(100) NOT NULL,
  `mother_name` varchar(100) NOT NULL,
  `mother_contact` varchar(100) NOT NULL,
  `next_of_kin` varchar(100) NOT NULL,
  `next_of_kin_contact` varchar(100) NOT NULL,
  `county` varchar(100) NOT NULL,
  `date_of_birth` date NOT NULL,
  `gender` varchar(100) NOT NULL,
  `date_of_issuance` date NOT NULL,
  `religion` varchar(100) NOT NULL,
  `marital_status` varchar(100) NOT NULL,
  `nationality` varchar(100) NOT NULL,
  `applicant_contact` varchar(100) NOT NULL,
  `other_contact` varchar(20) NOT NULL,
  `date_of_application` date NOT NULL,
  `position_applied` varchar(100) NOT NULL,
  `agent` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `id` int(11) NOT NULL,
  `passport_number` varchar(100) NOT NULL,
  `passport_profession` varchar(50) NOT NULL,
  `date_of_expiry` date NOT NULL,
  `id_no` varchar(20) NOT NULL,
  `applicant_info_id` bigint(20) NOT NULL,
  `job_ref` varchar(50) NOT NULL,
  `apply` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `job_application`
--

INSERT INTO `job_application` (`applicant_names`, `first_name`, `last_name`, `other_names`, `father_name`, `father_contact`, `mother_name`, `mother_contact`, `next_of_kin`, `next_of_kin_contact`, `county`, `date_of_birth`, `gender`, `date_of_issuance`, `religion`, `marital_status`, `nationality`, `applicant_contact`, `other_contact`, `date_of_application`, `position_applied`, `agent`, `address`, `id`, `passport_number`, `passport_profession`, `date_of_expiry`, `id_no`, `applicant_info_id`, `job_ref`, `apply`) VALUES
('', 'Adons', 'Pius', 'Moki', 'Roberto Santos', '+2566743798', 'Jolene Hillary', '+256898458909', 'Makambo Peterson', '2567889845099', 'Ajonoo', '2017-08-10', 'MALE', '2018-01-01', 'Christian', 'SINGLE', 'Ugandan', '+256780294', '+25678984089', '2018-01-10', 'Head - Internal Control', 'WEB CLIENT', 'Kampala', 1, 'BS7439380', 'Driver', '2018-03-24', 'CMX48340HS34', 1, 'UGA/2017/0002', 1),
('', 'Adukule', 'Robert', 'Bright', 'Wadla', '+2568734093', 'Anna', '+2569834983', 'Sadicki', '2568745988', 'Burra', '1999-12-12', 'MALE', '2012-03-13', 'Christian', 'MARRIED', 'Ugandan', '+25678398438', '+256873984', '2018-01-11', 'MTN Graduate Development Program 2018', 'WEB CLIENT', 'Kampala', 2, 'BT93490H9', 'Adminsitrator', '2020-03-13', 'CS38238S', 5, 'UGA/2017/0001', 1),
('', 'Gerald', 'Chaku', 'Abidrabo', 'Jackson', '+256778306166', 'Phoebe', '+256772522399', 'Nickson', '256788339966', 'Oluko', '2007-01-02', 'MALE', '2018-01-02', 'Christian', 'OTHERS', 'Andorran', '+256704729612', '+256779666092', '2018-01-11', 'Head - Internal Control', 'WEB CLIENT', 'Mpererwe', 3, 'b56789', 'dancer', '2018-01-06', '234567', 6, 'UGA/2017/0002', 1);

-- --------------------------------------------------------

--
-- Table structure for table `news_feed`
--

CREATE TABLE `news_feed` (
  `id` bigint(20) NOT NULL,
  `news_date` datetime NOT NULL,
  `topic` varchar(255) NOT NULL,
  `article` longtext NOT NULL,
  `author` varchar(50) NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `news_feed`
--

INSERT INTO `news_feed` (`id`, `news_date`, `topic`, `article`, `author`, `published`) VALUES
(1, '2018-01-03 20:30:21', 'The Story of Christmas', '<p>Now the birth of Jesus Christ was as follows: After His mother Mary was betrothed to Joseph, before they came together, she was found with child of the Holy Spirit. Then Joseph her husband, being a just man, and not wanting to make her a public example, was minded to put her away secretly. But while he thought about these things, behold, an angel of the Lord appeared to him in a dream, saying, &ldquo;Joseph, son of David, do not be afraid to take to you Mary your wife, for that which is conceived in her is of the Holy Spirit. And she will bring forth a Son, and you shall call His name Jesus, for He will save His people from their sins.&rdquo;</p>\r\n\r\n<p><img alt=\"\" src=\"/APPS/sauman-web/web-admin/fileman/Uploads/Images/honthorst_christmas_manger_820x7.jpg\" style=\"float:left; height:342px; margin:10px; width:400px\" />So all this was done that it might be fulfilled which was spoken by the Lord through the prophet, saying:&nbsp;<strong>&ldquo;Behold, the virgin shall be with child, and bear a Son, and they shall call His name Immanuel&rdquo; [Isaiah 7:14]</strong>&nbsp;which is translated, &ldquo;God with us.&rdquo; Then Joseph, being aroused from sleep, did as the angel of the Lord commanded him and took to him his wife. . .&nbsp;<strong>(Matthew 1:18-25)</strong></p>\r\n\r\n<hr />\r\n<p>And it came to pass in those days that a decree went out from Caesar Augustus that all the world should be registered. This census first took place while Quirinius was governing Syria. So all went to be registered, every one to his own city.</p>\r\n\r\n<p>Joseph also went up from Galilee, out of the city of Nazareth, into Judea, to the city of David, which is called Bethlehem, because he was of the house and lineage of David, to be registered with Mary, his betrothed wife, who was with child.</p>\r\n\r\n<p>So it was, that while they were there, the days were completed for her to be delivered. And she brought forth her firstborn Son, and wrapped him in swaddling cloths, and laid him in a manger, because there was no room for them in the inn.</p>\r\n\r\n<p>Now there were in the same country shepherds living out in the fields, keeping watch over their flock by night.</p>\r\n\r\n<p>And behold, an angel of the Lord stood before them, and the glory of the Lord shone around them, and they were greatly afraid. Then the angel said to them,</p>\r\n\r\n<blockquote>\r\n<p><em>&ldquo;Do not be afraid, for behold, I bring you good tidings of great joy which will be to all people. For there is born to you this day in the city of David a Savior, who is Christ the Lord. And this will be the sign to you: You will find a Babe wrapped in swaddling cloths, lying in a manger.&rdquo;</em></p>\r\n</blockquote>\r\n\r\n<p>And suddenly there was with the angel a multitude of the heavenly host praising God and saying,<em>&nbsp;</em></p>\r\n\r\n<blockquote>\r\n<p><em>&ldquo;Glory to God in the highest, and on earth peace, goodwill toward men!&rdquo;</em></p>\r\n</blockquote>\r\n\r\n<p>So it was, when the angels had gone away from them into heaven, that the shepherds said to one another, &ldquo;Let us now go to Bethlehem and see this thing that has come to pass, which the Lord has made known to us. And they came with haste and found Mary and Joseph, and the babe lying in a manger.</p>\r\n\r\n<p>Now when they had seen Him, they made widely known the saying which was told them concerning this Child. And all those who heard it marveled at those things which were told them by the shepherds. But Mary kept all these things and pondered them in her heart.</p>\r\n\r\n<p>Then the shepherds returned, glorifying and praising God for all the things that they had heard and seen, as it was told them.&nbsp;<strong>(Luke 2:1-20)</strong></p>\r\n\r\n<p>Now after Jesus was born in Bethlehem of Judea in the days of Herod the King, behold, wise men from the East came to Jerusalem, saying, &ldquo;Where is He who has been born King of the Jews? For we have seen His star in the East and have come to worship Him.</p>\r\n\r\n<p><img alt=\"\" src=\"/APPS/sauman-web/web-admin/fileman/Uploads/Images/magi_tissot_590x407.jpg\" style=\"float:right; height:345px; width:500px\" /></p>\r\n\r\n<p>When Herod the king heard this, he was troubled, and all Jerusalem with him. And when he had gathered all the chief priests and scribes of the people together, he inquired of them where the Christ was to be born.</p>\r\n\r\n<p>So they said to him,&nbsp;&ldquo;In Bethlehem of Judea, for thus it is written by the prophet [Micah 5:2]:</p>\r\n\r\n<blockquote>\r\n<p><em>&lsquo;But you, Bethlehem, in the land of Judah, are not the least among the rulers of Judah; For out of you shall come a Ruler Who will shepherd My people Israel.&#39;&rdquo;</em></p>\r\n</blockquote>\r\n\r\n<p>Then Herod, when he had secretly called the wise men, determined from them what time the star appeared. And he sent them to Bethlehem and said, &ldquo;Go and search carefully for the young child, and when you have found Him, bring back word to me, that I may come and worship Him also.&rdquo;</p>\r\n\r\n<p>When they heard the king, they departed; and behold, the star which they had seen in the East went before them, till it came and stood over where the young Child was. When they saw the star, they rejoiced with exceedingly great joy. And when they had come into the house, they saw the young child with Mary His mother, and fell down and worshipped Him. And when they had opened their treasures, they presented gifts to Him: gold, frankincense, and myrrh.</p>\r\n\r\n<p>Then, being divinely warned in a dream that they should not return to Herod, they departed for their own country.<strong>&nbsp;(Matthew 2:1-12)</strong></p>\r\n\r\n<blockquote>\r\n<p><em>For unto us a child is born, unto us a son is given, and the government will be upon his shoulders, and his name shall be called wonderful, counselor, mighty God, the everlasting father, the Prince of Peace. (Isaiah 9:6)</em></p>\r\n</blockquote>', 'Web Administrator', 1);

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE `photos` (
  `id` bigint(20) NOT NULL,
  `caption` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `file` varchar(100) NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `date_created` datetime NOT NULL,
  `created_by` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `photos`
--

INSERT INTO `photos` (`id`, `caption`, `description`, `file`, `published`, `date_created`, `created_by`) VALUES
(1, 'Demo Photo', 'Demo', '1515171546.jpg', 1, '2018-01-03 17:58:00', 'admin'),
(2, 'Another Amazing moments at Office', 'Determined', '1514992023.jpg', 1, '2018-01-03 18:07:03', 'admin'),
(3, 'Great Team Members', 'We aim to build and maintain long term relationships with both our clients and our candidates.', '1515171799.JPG', 1, '2018-01-05 14:53:04', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `religions`
--

CREATE TABLE `religions` (
  `id` int(11) NOT NULL,
  `religion` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `religions`
--

INSERT INTO `religions` (`id`, `religion`, `description`) VALUES
(2, 'Muslim', 'Islamic based faith affiliations'),
(4, 'Christian', 'All Christian faith based religious affiliations');

-- --------------------------------------------------------

--
-- Table structure for table `slideshow`
--

CREATE TABLE `slideshow` (
  `id` bigint(20) NOT NULL,
  `caption` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `file` varchar(100) NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `date_created` datetime NOT NULL,
  `created_by` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `slideshow`
--

INSERT INTO `slideshow` (`id`, `caption`, `description`, `file`, `published`, `date_created`, `created_by`) VALUES
(1, 'Great Team Members', 'We aim to build and maintain long term relationships with both our clients and our candidates.', '1515155217.jpg', 1, '2018-01-05 14:54:24', 'admin'),
(2, 'Colaboration Team Group', 'Sauman Service Limited specializes in permanent and temporary job placements from junior staff, professionals to senior management.', '1515155405.jpg', 1, '2018-01-05 15:10:22', 'admin'),
(3, 'Euthestic Memebership Atitude', 'Sauman Service Limited offerâ€™s you truly exceptional advantages; The ability to be flexible and responsive to your needs and decisions. The ability and capability to source, recruit, interview and supply the appropriate or sufficient labour force given', '1515154982.jpg', 1, '2018-01-05 15:13:15', 'admin'),
(4, 'Great Work', 'We are able to offer a wide choice of the latest experiences in the new systems and techniques in the markets when it comes to placement of vacancies. We aim to build and maintain long term relationships with both our clients and our candidates.', '1515155324.jpg', 1, '2018-01-05 15:28:44', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `full_names` varchar(100) NOT NULL,
  `last_visit` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `full_names`, `last_visit`) VALUES
(2, 'admin', 'admin@s', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Admin', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `id` bigint(20) NOT NULL,
  `caption` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `youtube_link` varchar(100) NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `date_created` datetime NOT NULL,
  `created_by` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`id`, `caption`, `description`, `youtube_link`, `published`, `date_created`, `created_by`) VALUES
(1, 'Hyperloop in Dubai 2020', 'Hyper loops', 'https://www.youtube.com/watch?v=mK85--PpvAY', 1, '2018-01-03 19:28:34', 'admin'),
(2, 'Apple Spaces', 'Largest Office spaces in the world', 'https://www.youtube.com/watch?v=hMtVr9C_2HI', 1, '2018-01-05 17:05:23', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `web_pages`
--

CREATE TABLE `web_pages` (
  `id` int(11) NOT NULL,
  `name` varchar(20) DEFAULT NULL,
  `parent_page` varchar(20) NOT NULL DEFAULT 'None',
  `title` varchar(50) NOT NULL,
  `content` longtext NOT NULL,
  `offline_text` text NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `created_on` datetime NOT NULL,
  `created_by` varchar(60) NOT NULL,
  `last_updated_on` datetime NOT NULL,
  `last_updated_by` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `web_pages`
--

INSERT INTO `web_pages` (`id`, `name`, `parent_page`, `title`, `content`, `offline_text`, `published`, `created_on`, `created_by`, `last_updated_on`, `last_updated_by`) VALUES
(1, 'login', 'None', 'Login', 'Login Information', 'Login info', 1, '2018-01-02 18:08:02', 'admin', '0000-00-00 00:00:00', ''),
(2, 'footnote', 'None', 'Footer Note', '<p><u><strong>Sauman Service Limited</strong></u> brings a fresh and innovative approach to consulting services, acting as liaison between the job seekers and the foreign employers and also provides and harnesses employment migration and development to both the home and destination countries.<a href=\"about.php\">Read more</a></p>', '<p>Content under maintenance&nbsp;</p>', 1, '2018-01-02 18:25:35', 'admin', '2018-01-04 18:32:35', 'admin'),
(3, 'home', 'None', 'Home', '<p>Sauman Service Limited is an employment company registered under Ugandan Law and deals with foreign placement solutions/services located in Kampala &ndash; Uganda.<img alt=\"\" class=\"img-thumbnail\" src=\"/APPS/sauman-web/web-admin/fileman/Uploads/Images/image3.jpg\" style=\"float:left; height:199px; margin:10px; width:200px\" /><br />\r\nSauman Service Limited brings a fresh and innovative approach to consulting services, acting as liaison between the job seekers and the foreign employers and also provides and harnesses employment migration and development to both the home and destination countries.<br />\r\nWe aim to build and maintain long term relationships. The company has reported substantial organic growth over the past ten years ... undoubtedly as a result of this philosophy.<br />\r\nSauman Service Limited is your first stop to your next career move in any field and is the one that you can totally trust to work with and find the appointment that meets your needs and expectations.<br />\r\nSauman Service Limited specializes in permanent and temporary placements of work positions from junior staff, professionals to senior management.</p>', '<p>This page is under maintenance</p>', 1, '2018-01-02 19:06:29', 'admin', '2018-01-05 15:37:50', 'admin'),
(4, '404', 'None', '404 - Page Not Found', '<p>The page you are trying to access is unavailable or does not exist. Try browse to another valid page or goto <a href=\"./\">HOME PAGE</a></p>', '<p>Page Not found</p>', 1, '2018-01-02 19:13:41', 'admin', '0000-00-00 00:00:00', ''),
(5, 'about', 'None', 'About Us', '<p>Sauman Service Limited brings a fresh and innovative approach to consulting services, acting as liaison between the job seekers and the foreign employers and also provides and harnesses employment migration and development to both the home and destination countries.</p>\r\n\r\n<p>We aim to build and maintain long term relationships. The company has reported substantial organic growth over the past ten years&hellip;undoubtedly as a result of this philosophy.</p>\r\n\r\n<p><img alt=\"\" src=\"/APPS/sauman-web/web-admin/fileman/Uploads/Images/about1.jpg\" style=\"height:805px; width:459px\" /></p>', '<p>This page is under maintenace, try later</p>', 1, '2018-01-02 19:27:56', 'admin', '2018-01-04 18:34:35', 'admin'),
(6, 'service', 'None', 'Our Services', '<p>Sauman Service Limited is your first stop to your next career move in any field and is the one that you can totally trust to work with and find the appointment that meets your needs and expectations..</p>\r\n\r\n<p>Sauman Service Limited specializes in permanent and temporary job placements from junior staff, professionals to senior management. We are always on the lookout for determined, enthusiastic people who are passionate about a career.</p>\r\n\r\n<p><img alt=\"\" src=\"/APPS/sauman-web/web-admin/fileman/Uploads/Images/service1.jpg\" style=\"height:394px; width:400px\" /></p>', '<p>This page us under maintenance</p>', 1, '2018-01-02 19:28:32', 'admin', '2018-01-04 18:38:28', 'admin'),
(7, 'jobs', 'None', 'Our Jobs', '<p><br />\r\n<img alt=\"\" src=\"/APPS/sauman-web/web-admin/fileman/Uploads/Images/about1.jpg\" style=\"float:left; height:805px; margin:10px; width:459px\" /></p>', '<p>This page is under maintenance</p>', 1, '2018-01-02 19:29:11', 'admin', '2018-01-04 18:08:11', 'admin'),
(8, 'contact', 'None', 'Contact Us', '<p>Sauman Service Limited is an employment company registered under Ugandan Law and deals with foreign placement solutions/services located in Kampala &ndash; Uganda.</p>', '<p>This page is under maintenance</p>', 1, '2018-01-02 19:29:50', 'admin', '2018-01-04 19:37:22', 'admin'),
(10, 'news', 'None', 'News Feed', '<p><img alt=\"\" src=\"/APPS/sauman-web/web-admin/fileman/Uploads/Images/service1.jpg\" style=\"height:394px; width:400px\" /></p>', '<p>Page under maintenance</p>', 1, '2018-01-04 18:27:16', 'admin', '0000-00-00 00:00:00', ''),
(11, 'objective', 'about', 'Main Objective', '<h3>Our Main Objective</h3>\r\n\r\n<p>At Sauman Service Limited, it&rsquo;s our sincere desire to deliver a qualified and experienced work force to our clients and candidates, which extends beyond their expectations by providing a level of customer service that cannot be rivaled! Our goal is to exceed the expectations of every client by offering outstanding customer service, increase success as a company that is leading in employment recruitment services and that has a loyal customer following.<br />\r\nOur jobseekers are distinguished by their profession and matched with jobs that suite their skills combined with their hands-on experience thereby ensuring that our clients receive the most effective and professional services.</p>', '<p>Page Under Maintenance</p>', 1, '2018-01-04 19:12:24', 'admin', '2018-01-04 19:32:24', 'admin'),
(12, 'mission', 'about', 'Mission Statement', '<h3>Our Mission Statement</h3>\r\n\r\n<p>Sauman Service Limited is committed to placing the right candidate in the right job every time and pride ourselves of outstanding levels of customer satisfaction.<br />\r\nWe are passionate, wanting to improve everything we do. The service offered to our customers will be conducted professionally, honestly and with total integrity to ensure strong and everlasting business relations. &ldquo;We are always on the lookout for determined, enthusiastic People who are passionate about a career.&rdquo;<br />\r\nWe can also support your development by providing a very experienced and qualified work force and you can rest assured to be part of a very exciting team in your company.<br />\r\n<strong>Our Duties and Tasks</strong><br />\r\nWe are able to offer a wide choice of the latest experiences in the new systems and techniques in the markets when it comes to placement of vacancies.</p>\r\n\r\n<p>We aim to build and maintain long term relationships with both our clients and our candidates.</p>', '<p>Page under maintenance</p>', 1, '2018-01-04 19:23:32', 'admin', '2018-01-04 19:33:25', 'admin'),
(13, 'terms', 'None', 'Terms and Conditions', '<p>T&amp;Cs</p>', '<p>Under maintenace</p>', 1, '2018-01-11 11:44:34', 'admin', '0000-00-00 00:00:00', ''),
(14, 'policy', 'None', 'Data Policy', '<p>DP</p>', '<p>Under maintenance</p>', 1, '2018-01-11 11:45:25', 'admin', '0000-00-00 00:00:00', ''),
(15, 'gallery', 'None', 'Media Gallery', '<p>Gallery</p>', '<p>Under maintenance</p>', 1, '2018-01-11 12:11:13', 'admin', '0000-00-00 00:00:00', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applicant_info`
--
ALTER TABLE `applicant_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `emai_address` (`email_address`),
  ADD UNIQUE KEY `contact` (`contact`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `alpha_2_code` (`alpha_2_code`),
  ADD UNIQUE KEY `alpha_3_code` (`alpha_3_code`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_application`
--
ALTER TABLE `job_application`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `passport_number` (`passport_number`);

--
-- Indexes for table `news_feed`
--
ALTER TABLE `news_feed`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `religions`
--
ALTER TABLE `religions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `religion` (`religion`);

--
-- Indexes for table `slideshow`
--
ALTER TABLE `slideshow`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `web_pages`
--
ALTER TABLE `web_pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title` (`title`),
  ADD UNIQUE KEY `name` (`name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applicant_info`
--
ALTER TABLE `applicant_info`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=895;
--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `job_application`
--
ALTER TABLE `job_application`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `news_feed`
--
ALTER TABLE `news_feed`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `photos`
--
ALTER TABLE `photos`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `religions`
--
ALTER TABLE `religions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `slideshow`
--
ALTER TABLE `slideshow`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `web_pages`
--
ALTER TABLE `web_pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;COMMIT;

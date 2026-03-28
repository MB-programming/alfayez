-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 28, 2026 at 10:23 AM
-- Server version: 10.6.25-MariaDB
-- PHP Version: 8.4.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lawfayez_business`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(2000) NOT NULL,
  `message` text NOT NULL,
  `files` text DEFAULT NULL,
  `replay` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `name` varchar(255) NOT NULL,
  `pastel_code` varchar(255) DEFAULT NULL,
  `side` varchar(255) DEFAULT NULL,
  `Building` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `unit` varchar(255) DEFAULT NULL,
  `tel` varchar(255) DEFAULT NULL,
  `living` text DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `district` varchar(255) DEFAULT NULL,
  `other` text DEFAULT NULL,
  `street` varchar(255) DEFAULT NULL,
  `mail_box` varchar(255) DEFAULT NULL,
  `files` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `user_id`, `name`, `pastel_code`, `side`, `Building`, `mobile`, `unit`, `tel`, `living`, `email`, `district`, `other`, `street`, `mail_box`, `files`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 6, 'محمد علي فنانه', '00970', 'خاصة', 'معهد الامل', '0597233620', '8/22', '2803864', 'ملك', 'mohf_1992@hotmail.com', 'الشجاعية', NULL, 'النزاز', '00970', '1469124149.docx', '2016-07-21 18:02:29', '2016-08-07 10:45:50', '2016-08-07 10:45:50');

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `path` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `path`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '1545900553.png', '2018-12-27 07:49:13', '2018-12-27 07:51:58', '2018-12-27 07:51:58'),
(2, '1545900555.png', '2018-12-27 07:49:15', '2018-12-27 07:51:55', '2018-12-27 07:51:55'),
(3, '1545900646.phtml', '2018-12-27 07:50:46', '2018-12-27 07:51:50', '2018-12-27 07:51:50'),
(4, '1545900765.png', '2018-12-27 07:52:45', '2018-12-27 07:55:21', '2018-12-27 07:55:21'),
(5, '1545900778.phtml', '2018-12-27 07:52:58', '2018-12-27 07:55:17', '2018-12-27 07:55:17');

-- --------------------------------------------------------

--
-- Table structure for table `issues`
--

CREATE TABLE `issues` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `number` varchar(255) NOT NULL,
  `Advisor` varchar(255) NOT NULL,
  `side` varchar(255) NOT NULL,
  `almitraf` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `prosecutor` varchar(255) NOT NULL,
  `report` text NOT NULL,
  `defendant` varchar(255) NOT NULL,
  `files` text DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `issues`
--

INSERT INTO `issues` (`id`, `title`, `number`, `Advisor`, `side`, `almitraf`, `subject`, `employee_id`, `customer_id`, `prosecutor`, `report`, `defendant`, `files`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'عنوان القضية', '123123', 'المستشار', 'الجهة القضائية', 5, '<p><span style=\"font-family: beINNormal, Mj_SazehLight, tahoma, arial, helvetica; line-height: 20px;\">التفاصيل</span><br></p>', 5, 1, 'المدعي', '<p><span style=\"font-family: beINNormal, Mj_SazehLight, tahoma, arial, helvetica; line-height: 20px;\">التقرير الخاص</span><br></p>', 'المدعى عليه', '1469158645.docx', '2016-07-22 03:37:25', '2016-07-22 05:11:59', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `detail` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `status` enum('ACTIVE','INACTIVE') CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT 'ACTIVE',
  `lang` enum('AR','EN') CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT 'AR',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs_app`
--

CREATE TABLE `jobs_app` (
  `id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `mobile` varchar(255) CHARACTER SET utf32 COLLATE utf32_general_ci NOT NULL,
  `cv_path` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lang`
--

CREATE TABLE `lang` (
  `id` int(11) NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` text NOT NULL,
  `lang` enum('AR','EN') NOT NULL DEFAULT 'AR',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `lang`
--

INSERT INTO `lang` (`id`, `key`, `value`, `lang`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'site_title', 'عبدالله الفايز', 'AR', '2016-06-11 04:12:11', '2016-06-25 08:03:53', NULL),
(2, 'home', 'الرئيسية', 'AR', '2016-06-11 04:12:11', '2016-06-11 12:49:36', NULL),
(3, 'about', 'عبدالله الفايز', 'AR', '2016-06-11 04:12:11', '2016-06-25 08:03:53', NULL),
(4, 'board_of_directors', 'رئيس مجلس الإدارة', 'AR', '2016-06-11 04:12:11', '2016-06-11 04:12:11', NULL),
(5, 'partners', 'الإستثمارات', 'AR', '2016-06-11 04:12:11', '2016-06-11 04:12:11', NULL),
(6, 'media', 'المركز الإعلامي', 'AR', '2016-06-11 04:12:11', '2016-06-11 04:12:11', NULL),
(7, 'contactus', 'اتصل بنا', 'AR', '2016-06-11 04:12:11', '2016-06-11 04:12:11', NULL),
(8, 'read_more', 'اقرأ المزيد', 'AR', '2016-06-11 04:12:11', '2016-06-11 04:12:11', NULL),
(9, 'companies', 'شركات المجموعة', 'AR', '2016-06-11 04:12:11', '2016-06-11 04:12:11', NULL),
(10, 'some_bintwar', 'مجموعة بن طوار', 'AR', '2016-06-11 04:12:11', '2016-06-11 04:12:11', NULL),
(11, 'know_the_new', 'تعرف على كل جديد', 'AR', '2016-06-11 04:12:11', '2016-06-11 04:12:11', NULL),
(12, 'descriptions', 'التفاصيل', 'AR', '2016-06-11 04:12:11', '2016-06-11 04:12:11', NULL),
(13, 'copywrite', 'كافة الحقوق محفوظة', 'AR', '2016-06-11 04:12:11', '2016-06-11 04:12:11', NULL),
(14, 'vision', 'الرؤية', 'AR', '2016-06-11 04:12:11', '2016-06-11 04:12:11', NULL),
(15, 'message', 'نص الرسالة', 'AR', '2016-06-11 04:12:11', '2016-06-11 04:12:11', NULL),
(16, 'value', 'القيمة', 'AR', '2016-06-11 04:12:11', '2016-06-11 04:12:11', NULL),
(17, 'new_news', 'اخر الأخبار', 'AR', '2016-06-11 04:12:11', '2016-06-11 04:12:11', NULL),
(18, 'albums', 'البوم الصور', 'AR', '2016-06-11 04:12:11', '2016-06-11 04:12:11', NULL),
(19, 'videos', 'الفيديوهات', 'AR', '2016-06-11 04:12:11', '2016-06-11 04:12:11', NULL),
(20, 'events', 'الفعاليات', 'AR', '2016-06-11 04:12:11', '2016-06-11 04:12:11', NULL),
(21, 'send_us_message', 'ارسل لنا رسالة', 'AR', '2016-06-11 04:12:11', '2016-06-11 04:12:11', NULL),
(22, 'contct_info', 'بيانات الاتصال المباشر', 'AR', '2016-06-11 04:12:11', '2016-06-11 04:12:11', NULL),
(23, 'send_now', 'ارسل الأن', 'AR', '2016-06-11 04:12:11', '2016-06-11 04:12:11', NULL),
(24, 'name', 'الاسم', 'AR', '2016-06-11 04:12:11', '2016-06-11 04:12:11', NULL),
(25, 'email', 'البريد الإلكتروني', 'AR', '2016-06-11 04:12:11', '2016-06-11 04:12:11', NULL),
(26, 'success', 'نجاح', 'AR', '2016-06-11 04:12:11', '2016-06-11 04:12:11', NULL),
(27, 'error', 'خطأ', 'AR', '2016-06-11 04:12:11', '2016-06-11 04:12:11', NULL),
(28, 'date_time', 'التاريخ والوقت', 'AR', '2016-06-11 04:12:11', '2016-06-11 04:12:11', NULL),
(29, 'site', 'موقع الشركة', 'AR', '2016-06-11 04:12:11', '2016-06-11 12:49:19', NULL),
(30, 'site_title', 'Bin Towar & Co.', 'EN', '2016-06-11 12:52:33', '2016-06-11 13:00:31', NULL),
(31, 'home', 'Home', 'EN', '2016-06-11 12:52:33', '2016-06-11 12:52:45', NULL),
(32, 'about', 'Bin Towar & Co.', 'EN', '2016-06-11 12:52:33', '2016-06-11 13:00:31', NULL),
(33, 'board_of_directors', 'Chairman of Board of Directors', 'EN', '2016-06-11 12:52:33', '2016-06-11 13:00:31', NULL),
(34, 'partners', 'Investments', 'EN', '2016-06-11 12:52:33', '2016-06-11 13:00:31', NULL),
(35, 'media', 'Media Center', 'EN', '2016-06-11 12:52:33', '2016-06-11 13:00:31', NULL),
(36, 'contactus', 'Contact Us', 'EN', '2016-06-11 12:52:33', '2016-06-11 13:00:31', NULL),
(37, 'read_more', 'Read More', 'EN', '2016-06-11 12:52:33', '2016-06-11 13:00:31', NULL),
(38, 'companies', 'Companies Group', 'EN', '2016-06-11 12:52:33', '2016-06-11 13:00:31', NULL),
(39, 'some_bintwar', 'Bin Towar group', 'EN', '2016-06-11 12:52:33', '2016-06-11 13:00:31', NULL),
(40, 'know_the_new', 'Learn all-new', 'EN', '2016-06-11 12:52:33', '2016-06-11 13:00:31', NULL),
(41, 'descriptions', 'Details', 'EN', '2016-06-11 12:52:33', '2016-06-11 13:00:31', NULL),
(42, 'copywrite', 'All rights reserved.', 'EN', '2016-06-11 12:52:33', '2016-06-11 13:00:31', NULL),
(43, 'vision', 'Vision', 'EN', '2016-06-11 12:52:33', '2016-06-11 13:00:31', NULL),
(44, 'message', 'The Letter', 'EN', '2016-06-11 12:52:33', '2016-06-11 13:00:31', NULL),
(45, 'value', 'The Value', 'EN', '2016-06-11 12:52:33', '2016-06-11 13:00:31', NULL),
(46, 'new_news', 'New News', 'EN', '2016-06-11 12:52:33', '2016-06-11 13:00:31', NULL),
(47, 'albums', 'Images Albums', 'EN', '2016-06-11 12:52:33', '2016-06-11 13:00:31', NULL),
(48, 'videos', 'Videos', 'EN', '2016-06-11 12:52:33', '2016-06-11 13:00:31', NULL),
(49, 'events', 'Eventss', 'EN', '2016-06-11 12:52:33', '2016-06-11 13:00:31', NULL),
(50, 'send_us_message', 'Send us a message', 'EN', '2016-06-11 12:52:33', '2016-06-11 13:00:31', NULL),
(51, 'contct_info', 'Direct contact details', 'EN', '2016-06-11 12:52:33', '2016-06-11 13:00:31', NULL),
(52, 'send_now', 'Send Now', 'EN', '2016-06-11 12:52:33', '2016-06-11 13:00:31', NULL),
(53, 'name', 'Name', 'EN', '2016-06-11 12:52:33', '2016-06-11 13:00:31', NULL),
(54, 'email', 'E-mail', 'EN', '2016-06-11 12:52:33', '2016-06-11 13:00:31', NULL),
(55, 'success', 'Successs', 'EN', '2016-06-11 12:52:33', '2016-06-11 13:00:31', NULL),
(56, 'error', 'Error', 'EN', '2016-06-11 12:52:33', '2016-06-11 13:00:31', NULL),
(57, 'date_time', 'Date & Time', 'EN', '2016-06-11 12:52:33', '2016-06-11 13:00:31', NULL),
(58, 'site', 'Company Site', 'EN', '2016-06-11 12:52:33', '2016-06-11 13:00:31', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `detail` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `job_title` varchar(255) NOT NULL,
  `type` enum('PAGE','PEOPLE','SKILL','SYSTEM') NOT NULL DEFAULT 'PAGE',
  `order` int(11) NOT NULL DEFAULT 0,
  `lang` enum('AR','EN') NOT NULL DEFAULT 'AR',
  `vision` text DEFAULT NULL,
  `value` text DEFAULT NULL,
  `message` text DEFAULT NULL,
  `auther` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `detail`, `image`, `job_title`, `type`, `order`, `lang`, `vision`, `value`, `message`, `auther`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'عن المكتب', '<p style=\"transition-duration: 250ms; margin-bottom: 30px; font-family: CoHeadlineTrial-Regular, sans-serif; color: rgb(255, 255, 255); padding: 5px 7.5px 0px 30px; text-align: justify;\"><span style=\"font-family: CoHeadlineTrial-Regular, sans-serif;\">منذ تأسيس (مكتب عبدالله الفايز محامون ومستشارون ومحكّمون) وانطلاقته بموجب التصريح الصادر له من الإدارة العامَّة للمحاماة بوزارة العدل رقم (33/29) وتاريخ: 06/06/1429هجري أصبح واحداً من مكاتب المحاماة الرائدة في المملكة العربيَّة السعوديَّة، لما يقدمه من أداء عالي الجودة من الخدمات القانونية المقدمة على أسس من المهنية والالتزام. لقد استطاع (مكتب عبدالله الفايز محامون ومستشارون ومحكّمون) أن يصنع له اسماً لامعاً بين مكاتب المحاماة الرائدة؛ فنما بخطوات واثقة، ممّا حدا بالشركات ورجال الأعمال والمستثمرين للارتباط مع المكتب والحصول على خدماته القانونية</span><br></p><div class=\"clearfix\" style=\"box-sizing: border-box; outline: none; transition: all 250ms ease-in-out; color: rgb(127, 127, 127); font-family: CoHeadlineTrial-Regular, sans-serif; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 27.2px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px;\"></div><div class=\"clearfix\" style=\"transition-duration: 250ms; color: rgb(127, 127, 127); font-family: CoHeadlineTrial-Regular, sans-serif; font-size: 16px; line-height: 27.2px;\"></div>', '', '', 'PAGE', 0, 'AR', '<p><span style=\"font-family: beINNormal, Mj_SazehLight, tahoma, arial, helvetica;\">الريادة العالمية والتميز في تقديم الخدمات القانونية والمحاماة</span><br></p>', NULL, '<p><span style=\"font-family: beINNormal, Mj_SazehLight, tahoma, arial, helvetica;\">الريادة والتميز في تقديم الخدمات القانونية في مجال المحاماة والاستشارات الشرعية والقانونية والتحكيم والتدريب القانوني، وتطوير الرعاية الحقوقية المبنية على الرؤية المتعمقة للأنظمة القضائية والبحث العلمي والتثقيف القانوني، وفقاً لمباديء المصداقية والثقة والالتزام المهني والدفاع عن الحق والعدل وشرف المهنة.</span></p>', NULL, '2016-07-08 05:15:36', '2016-07-11 17:05:15', NULL),
(2, 'أنظمة وقوانين الأعمال', '<p><span class=\"Apple-tab-span\" style=\"white-space: pre;\">	</span>يقدم مكتبنا خدماته القانونية إلى مجموعة من المنشآت المحلية والأجنبية ورجال الأعمال في إطار العناية الفردية القصوى لكل عملائنا لفهم وتلبية متطلباتهم بسرعة وفاعلية، وتزويدهم بالوسائل والنصائح القانونية الواضحة والعملية، وقد وضعنا نصب أعيننا أن نجتهد في خدمة عملائنا وتلبية احتياجاتهم بالعلم والمعرفة والثقة والقدرة على مواجهة التحديات؛ ومن ذلك:<br></p><p>- العقود والاتفاقيات والوثائق القانونية المتعلقة بالتجارة والأعمال.</p><p>- الاستثمار المحلي والأجنبي:</p><p><span class=\"Apple-tab-span\" style=\"white-space:pre\">	</span>إننا ننظر بعناية إلى أهمية الاستثمارات في المملكة العربية السعودية ونقدم أقصى إمكانياتنا لخدمة حاجات عملائنا من المستثمرين القائمين أو المحتملين، حيث نزودهم بمعلومات كاملة ومفصّلة عن المناخ الاستثماري والتشريع القانوني في المملكة، ونعمل على إيجاد الإطار الأمثل والأكثر جدوى لدخول المستثمر إلى بيئة الأعمال في المملكة.</p><p><span class=\"Apple-tab-span\" style=\"white-space:pre\">	</span>نقدم توصياتنا إلى المستثمرين بموضوعية وتجرّد، وبوصفنا جزءًا من المجتمع القانوني السعودي فإننا نضع في سلّم أولوياتنا متابعة أي تغييرات تشريعية محتملة يمكن أن تؤثر إيجاباً على عملائنا من المستثمرين.</p><p>- الوكالات التجارية والتوزيع.                            </p><p>- التجارة الدولية.</p><p>- حقوق وتراخيص الامتياز.</p><p>-الملكية الفكرية (حقوق النشر والعلامات التجارية وبراءات الاختراع):</p><p>    قوق الملكية الفكرية (من براءات الاختراع والعلامات التجارية وحقوق التأليف) أحد أصول المنشأة الأكثر أهميةً، والتي ينبغي حمايتها بغطاء قانوني مُحكم، وتعتبر خدماتنا في مجال حقوق الملكية الفكرية شاملة لجميع الإجراءات، بدءًا من إعداد وتقديم ومتابعة طلبات التسجيل داخل المملكة العربية السعودية وخارجها، وأيضاً المرافعة والتمثيل القضائي، وكذلك الدفاع في ادعاءات التعدي على ملكية براءات الاختراع أو حقوق النشر أو العلامات التجارية. نقدم أيضاً التوصيات القانونية لعملائنا حول الحقوق والمسؤوليات المرتبطة باستخدام حقوق الملكية الفكرية وممارسات المنافسة، وتقوم إستراتيجيتنا على بذل أقصى الجهود لحماية حقوق الملكية الفكرية مع تجنب اللجوء للقضاء قدر الإمكان.</p><p>-الملكية الصناعية.</p><p>-الأنظمة المالية وأسواق المال.</p><p>- الزكاة والنظام الضريبي:</p><p><span class=\"Apple-tab-span\" style=\"white-space:pre\">	</span>على خلاف الأحكام الشرعية الثابتة المنظِّمة للزكاة والمستمدة من الشريعة الإسلامية، فإنَّ نظام الضريبة في المملكة العربية السعودية – المطبق على المنشآت والاستثمارات الأجنبية – قد خضع لإعادة هيكلة وبعض التغييرات مؤخراً، وهو ما يتوافق معه دورنا في تحليل المناخ الضريبي وتقديم النصح إلى عملائنا حول الالتزامات الضريبية المطبقة في المملكة، ويتضمن تحليلنا وتوصياتنا ما يخص التبعات الضريبية على مختلف التصرفات ومساعدة عملائنا على تنظيم شؤونهم الضريبية، علاوةً على ذلك فإننا نقوم بتمثيل عملائنا أمام مصلحة الزكاة والدخل.</p><p>- التأمين وإعادة التأمين.</p><p>-العمل والعمال والضمان الاجتماعي:</p><p><span class=\"Apple-tab-span\" style=\"white-space:pre\">	</span>فاستناداً على المزاولة القانونية الطويلة لمكتبنا في خدمة مجموعة من كبار أصحاب العمل في المملكة العربية السعودية، فإننا مؤهلين لتقديم أنظمة العمل الداخلية والهياكل الخاصة بحقوق ومزايا الموظفين بما يتفق مع نظام العمل، كما تشمل خدماتنا التفاوض بين أصحاب العمل والمستخدمين وإعداد اتفاقيات التوظيف الجماعية والفردية ومتابعة إجراءات التقاضي وتسوية المنازعات العمالية.</p><p>-الملكية العقارية: </p><p><span class=\"Apple-tab-span\" style=\"white-space:pre\">	</span>يمتلك مكتبنا خبرات عملية واسعة تغطي مختلف أنواع الصفقات والتصرفات العقارية؛ ويشمل ذلك التفاوض وصياغة عقود التملك، ترتيبات التمويل والسداد، عقود الإيجار، عقود المقاولات والإنشاءات، عقود الانتفاع، ومختلف أنواع المستندات القانونية الخاصة بالتصرفات العقارية التجارية أو السكنية. ومن جانبٍ آخر فإننا نقوم بالبحث</p><p><span class=\"Apple-tab-span\" style=\"white-space:pre\">	</span>والتحليل للأوضاع القانونية للعقارات ورفع التوصيات اللازمة للوصول إلى المركز القانوني الأمثل، ويضاف لهذه الخدمات المقدَّمة منا في متابعة استخراج الصكوك وحجج الاستحكام.</p>', '1467463576.png', '', 'PAGE', 0, 'AR', NULL, NULL, NULL, NULL, '2016-07-02 09:21:44', '2016-07-11 17:34:51', NULL),
(3, 'الاختصاصات النوعية', '<p><span style=\"font-family: beINNormal, Mj_SazehLight, tahoma, arial, helvetica;\">أ- الأحكام المتعلقة بالشركات والمؤسسات:</span><br></p><p><span style=\"font-family: beINNormal, Mj_SazehLight, tahoma, arial, helvetica;\"><span class=\"Apple-tab-span\" style=\"white-space:pre\">	</span>يقدم مكتب عبدالله الفايز محامون ومستشارون حزمة متكاملة من الخدمات القانونية في مختلف مجالات نظام الشركات، بدءاً من التسجيل وهيكلة التنظيم إلى التصفية وشطب التسجيل، نقدم من بين خدماتنا الاستشارات القانونية بشأن الاندماج والاستحواذ وفصل وتقسيم الشركات، كما نعمل كمستشار قانوني عام للشركات لتنفيذ جميع احتياجاتها القانونية، بما في ذلك تمثيل العملاء لدى المراجع القضائية، وتحليل النتائج القانونية التي تترتب على الصفقات والتعاقدات التي ترغب الشركة في إبرامها وتقديم النصح بشأنها، وتولي الأمور القانونية المتعلقة بالتصرفات القانونية على العقارات. ومن ضمن هذه الخدمات:</span></p><p><span style=\"font-family: beINNormal, Mj_SazehLight, tahoma, arial, helvetica;\"><span class=\"Apple-tab-span\" style=\"white-space:pre\">	</span>1 -تأسيس وتسجيل الشركات والمؤسسات.</span></p><p><span style=\"font-family: beINNormal, Mj_SazehLight, tahoma, arial, helvetica;\"><span class=\"Apple-tab-span\" style=\"white-space:pre\">	</span>2- الاندماج والاستحواذ {التملك الكامل للشركات}.</span></p><p><span style=\"font-family: beINNormal, Mj_SazehLight, tahoma, arial, helvetica;\"><span class=\"Apple-tab-span\" style=\"white-space:pre\">	</span>3- المشاركة والائتلاف التضامني .</span></p><p><span style=\"font-family: beINNormal, Mj_SazehLight, tahoma, arial, helvetica;\"><span class=\"Apple-tab-span\" style=\"white-space:pre\">	</span>4- اتفاقيات المساهمات والحصص.</span></p><p><span style=\"font-family: beINNormal, Mj_SazehLight, tahoma, arial, helvetica;\"><span class=\"Apple-tab-span\" style=\"white-space:pre\">	</span>5- الإفلاس والتصفية.</span></p><p><span style=\"font-family: beINNormal, Mj_SazehLight, tahoma, arial, helvetica;\">ب- الاختصاصات المتعلقة بالشركات الحكومية:</span></p><p><span style=\"font-family: beINNormal, Mj_SazehLight, tahoma, arial, helvetica;\"><span class=\"Apple-tab-span\" style=\"white-space:pre\">	</span>1- عقود المناقصات والمشاريع الحكومية.</span></p><p><span style=\"font-family: beINNormal, Mj_SazehLight, tahoma, arial, helvetica;\"><span class=\"Apple-tab-span\" style=\"white-space:pre\">	</span>2- عقود بناء وإدارة واستثمار ونقل المشاريع.</span></p><p><span style=\"font-family: beINNormal, Mj_SazehLight, tahoma, arial, helvetica;\"><span class=\"Apple-tab-span\" style=\"white-space:pre\">	</span>3- تصديق وتوثيق الصكوك والمستندات.</span></p>', '1467463584.png', '', 'PAGE', 0, 'AR', NULL, NULL, NULL, NULL, '2016-07-02 09:22:21', '2016-07-11 17:28:45', NULL),
(4, 'تسوية المنازعات', '<p><span style=\"font-family: beINNormal, Mj_SazehLight, tahoma, arial, helvetica;\">أ- المقاضاة والتحكيم:</span></p><p><span style=\"font-family: beINNormal, Mj_SazehLight, tahoma, arial, helvetica;\"><span class=\"Apple-tab-span\" style=\"white-space:pre\">	</span>يملك مكتبنا سجلاً حافلاً بالنجاحات في هذا المجال، فنحن نسعى بشكل مستمر ونكرِّس الكثير من الوقت والجهد للوصول إلى المفاهمات الودية والحلول وتسوية النزاعات بين عملائنا وخصومهم، لكننا بالمقابل نضطلع بدورنا بكل حزم ووعي وتصميم في متابعة القضايا لدى مختلف المحاكم والجهات الإدارية والقضائية في مختلف اختصاصات القانون، خلال إجراءات التقاضي وقبل بدئها نعمل بالتنسيق المتواصل مع عملائنا لوضع وتأسيس أفضل الاستراتيجيات اللازمة للادعاء أو الدفاع.</span></p><p><span style=\"font-family: beINNormal, Mj_SazehLight, tahoma, arial, helvetica;\"><span class=\"Apple-tab-span\" style=\"white-space:pre\">	</span>من ناحية أخرى فإنّ لدينا فريقاً تحكيميّاً متمكناً يضم مجموعة من المحكِّمين المتمرِّسين من ذوي النزاهة المهنية والاحتراف، ولهم تجربة شاملة كمستشارين ووسطاء ومحكِّمين في عدّة إجراءات تسوية منازعات.</p></span></p><p><span style=\"font-family: beINNormal, Mj_SazehLight, tahoma, arial, helvetica;\">ب- الوساطة والمصالحة.</span><br></p><p><span style=\"font-family: beINNormal, Mj_SazehLight, tahoma, arial, helvetica;\">    في ضوء الطبيعة الخاصة لبعض النزاعات ومراعاتنا لاحتياجات العملاء فإننا نبذل ما بوسعنا لتوجيه أطراف النزاع نحو التفاوض،  وذلك بهدف تجنب إجراءات التقاضي الطويلة وتوفير وقت العميل وماله والحفاظ على علاقة تجارية مستقبلية طيبة مع خصومه بعد حل الخلاف، وفي هذا فإننا نقوم بتمثيل عملائنا أثناء المفاوضات ومناقشة مقترحات التسوية المقبولة لعملائنا، وبالتالي الوصول بالأطراف في معظم الحالات إلى المصالحة ومن ثَمَّ صياغة وتوثيق الاتفاق.</span><br></p>', '1467463592.png', '', 'PAGE', 0, 'AR', NULL, NULL, NULL, NULL, '2016-07-02 09:22:45', '2016-07-11 17:26:48', NULL),
(5, 'خدمات أخرى', '<p><span style=\"font-family: beINNormal, Mj_SazehLight, tahoma, arial, helvetica;\">الخدمات القانونية والتقليدية العامة؛ وتشمل:</span><br></p><p><span style=\"font-family: beINNormal, Mj_SazehLight, tahoma, arial, helvetica;\">أ- شؤون الأحوال الشخصية وقضايا الشركات وغيرها.</span></p><p><span style=\"font-family: beINNormal, Mj_SazehLight, tahoma, arial, helvetica;\">ب- تحصيل الديون والذمم:</span></p><p><span style=\"font-family: beINNormal, Mj_SazehLight, tahoma, arial, helvetica;\"><span class=\"Apple-tab-span\" style=\"white-space:pre\">	</span>حيث يُعدّ تحصيل الديون في كثير من الحالات عملية مرهقة، وتستغرق وقتاً طويلاًِ يفضِّل الغالبية إحالتها إلى طرفٍ آخر للقيام بها. إنّ أحد عناصر الخدمات القانونية في مكتب عبدالله الفايز محامون ومستشارون مساندة العملاء في عملية التحصيل من خلال تقديم حلول ناجحة لمشاكل التحصيل وسياسات الائتمان؛ كما نقوم بمتابعة تحصيل الديون والذمم من خلال المحاكم والسلطات الرسمية وبالاستفادة من جميع الإجراءات التي تكفلها المحاكم والأنظمة، بما فيها جميع خيارات التنفيذ على المدين.</span></p><p><span style=\"font-family: beINNormal, Mj_SazehLight, tahoma, arial, helvetica;\">ت- الدراسات والأبحاث القانونية:</span></p><p><span style=\"font-family: beINNormal, Mj_SazehLight, tahoma, arial, helvetica;\"><span class=\"Apple-tab-span\" style=\"white-space:pre\">	</span>وذلك من خلال استخدامنا الفعَّال لجميع مواردنا العلمية والبشرية يقوم مكتبنا بشكل مستمر بإِعداد بحوث وتحليلات ودراسات قانونية في المجالات التي تكون إمَّا موضع اهتمام عملائنا أو المستجدات القانونية في مختلف فروع القانون، وهو ما يثري خبراتنا العملية بالبحوث القانونية المنهجية المتقدمة، ويعزِّز من مكانة المقترحات والتوصيات القانونية التي نقدمها إلى عملائنا، والتي تخص بعض الحالات القانونية المعقّدة.</span></p>', '1467463566.png', '', 'PAGE', 0, 'AR', NULL, NULL, NULL, NULL, '2016-07-02 09:23:04', '2016-07-11 17:30:18', NULL),
(6, 'أنظمة الأعمال والتجارة', '<p><span style=\"font-family: beINNormal, Mj_SazehLight, tahoma, arial, helvetica;\">أنظمة الأعمال والتجارة </span>أنظمة الأعمال والتجارة أنظمة الأعمال والتجارة <br></p>', '1467488843.png', '', 'SKILL', 0, 'AR', NULL, NULL, NULL, NULL, '2016-07-02 16:47:23', '2016-07-16 11:56:37', NULL),
(7, ' أنظمة الشركاتوالمؤسسات والمنشآت', '<p><br></p>', '1467488874.png', '', 'SKILL', 0, 'AR', NULL, NULL, NULL, NULL, '2016-07-02 16:47:54', '2016-07-02 16:47:54', NULL),
(8, 'الاستثمار', '<p><br></p>', '1467488891.png', '', 'SKILL', 0, 'AR', NULL, NULL, NULL, NULL, '2016-07-02 16:48:11', '2016-07-02 16:48:11', NULL),
(9, 'التأمين', '<p><br></p>', '1467488916.png', '', 'SKILL', 0, 'AR', NULL, NULL, NULL, NULL, '2016-07-02 16:48:36', '2016-07-02 16:48:36', NULL),
(10, 'العمل والضمان الاجتماعي', '<p><br></p>', '1467488950.png', '', 'SKILL', 0, 'AR', NULL, NULL, NULL, NULL, '2016-07-02 16:49:10', '2016-07-02 16:49:10', NULL),
(11, ' الملكية الفكرية', '<p><br></p>', '1467488985.png', '', 'SKILL', 0, 'AR', NULL, NULL, NULL, NULL, '2016-07-02 16:49:45', '2016-07-02 16:49:45', NULL),
(12, 'حقوق وترخيصالامتياز (عقود الفرنشايز)', '<p><br></p>', '1467489008.png', '', 'SKILL', 0, 'AR', NULL, NULL, NULL, NULL, '2016-07-02 16:50:08', '2016-07-02 16:50:08', NULL),
(13, ' الملكية العقارية، وغيرها من الاختصاصات النظاميَّة وَالقانونية', '<p><br></p>', '1467489040.png', '', 'SKILL', 0, 'AR', NULL, NULL, NULL, NULL, '2016-07-02 16:50:40', '2016-07-02 16:50:40', NULL),
(14, 'عبدالله الفايز', '<p><br></p>', '1467967426.jpg', 'مدير عام', 'PEOPLE', 0, 'AR', NULL, NULL, NULL, NULL, '2016-07-08 05:33:26', '2016-07-08 05:43:46', NULL),
(15, 'سليمان العوشن', '<p><br></p>', '1467966655.jpg', 'مسئول الموقع الالكتروني', 'PEOPLE', 0, 'AR', NULL, NULL, NULL, NULL, '2016-07-08 05:30:55', '2016-07-08 05:30:55', NULL),
(16, 'السيرة الذاتية', '<div>\n	<br />\n	<span style=\"color: rgb(0, 0, 128);\">المعلومات الشخصية:</span></div>\n<div>\n	<address>\n		 المحامي/ عبدالله بن عبدالرحمن بن إبراهيم الفايز، الممارس للمهنة بموجب الترخيص الصادر من وزارة العدل برقم (29/33).</address>\n	<p>\n		 </p>\n	<p>\n		 </p>\n	<address dir=\"RTL\">\n		<span style=\"color:#000080;\">المؤهلات:</span></address>\n	<p>\n		- بكالوريوس – كلية الشريعة – جامعة الإمام محمد بن سعود الإسلامية بالرياض.</p>\n	<p>\n		- ماجستير فقه مقارن من المعهد العالي للقضاء – جامعة الإمام محمد بن سعود الإسلامية بالرياض.</p>\n	<p>\n		- باحث لمرحلة الدكتوراه في الفقه المقارن من المعهد العالي للقضاء – جامعة الإمام محمد بن سعود الإسلامية بالرياض.</p>\n	<p>\n		- دبلوم محاماة – جامعة الإمام محمد بن سعود الإسلامية بالرياض.</p>\n	<p>\n		- عضو الجمعية العلمية القضائية.</p>\n	<p>\n		 </p>\n	<p>\n		 </p>\n	<address>\n		<span style=\"color:#000080;\">الخبرات العلمية:</span></address>\n	<p>\n		1. العمل في المحاماة والاستشارات القانونية والشرعية لدى مكتب عبدالعزيز القاسم محامون ومستشارون.</p>\n	<p>\n		2. العمل في المحاماة والاستشارات القانونية والشرعية لدى الإدارة القانونية في مجلس إدارة أعمال الشيخ صالح بن عبدالعزيز الراجحي.</p>\n	<p>\n		3. العمل في المحاماة والاستشارات القانونية والشرعية في مكتب المشورة محامون ومستشارون.</p>\n	<p>\n		4. العمل في حقل التربية والتعليم معلماً.</p>\n</div>\n<p>\n	 </p>\n', '', '', 'PAGE', 0, 'AR', NULL, NULL, NULL, NULL, '2016-07-11 18:01:27', '2016-07-17 08:18:23', NULL),
(17, 'نظام الملكية الفردية', 'نظام الملكية الفردية نظام الملكية الفردية نظام الملكية الفردية نظام الملكية الفردية نظام الملكية الفردية نظام الملكية الفردية ', '', '', 'SYSTEM', 0, 'AR', NULL, NULL, NULL, NULL, '2016-07-16 12:35:39', '2016-07-16 12:35:39', NULL),
(18, 'النظام الجديد للعمل والعمال', '<p><span style=\"font-family: beINNormal, Mj_SazehLight, tahoma, arial, helvetica;\">النظام الجديد للعمل والعمال </span>النظام الجديد للعمل والعمال <span style=\"font-family: beINNormal, Mj_SazehLight, tahoma, arial, helvetica;\">النظام الجديد للعمل والعمال </span>النظام الجديد للعمل والعمال <span style=\"font-family: beINNormal, Mj_SazehLight, tahoma, arial, helvetica;\">النظام الجديد للعمل والعمال </span>النظام الجديد للعمل والعمال <span style=\"font-family: beINNormal, Mj_SazehLight, tahoma, arial, helvetica;\">النظام الجديد للعمل والعمال </span>النظام الجديد للعمل والعمال <span style=\"font-family: beINNormal, Mj_SazehLight, tahoma, arial, helvetica;\">النظام الجديد للعمل والعمال </span>النظام الجديد للعمل والعمال <span style=\"font-family: beINNormal, Mj_SazehLight, tahoma, arial, helvetica;\">النظام الجديد للعمل والعمال </span>النظام الجديد للعمل والعمال <br></p>', '', '', 'SYSTEM', 0, 'AR', NULL, NULL, NULL, NULL, '2016-07-16 12:36:20', '2016-07-16 12:36:20', NULL),
(19, 'اهم مايحتاجه كتاب العدل والموثقون ومراجعيهم', '<p>اهم مايحتاجه كتاب العدل والموثقون ومراجعيهم اهم مايحتاجه كتاب العدل والموثقون ومراجعيهم اهم مايحتاجه كتاب العدل والموثقون ومراجعيهم اهم مايحتاجه كتاب العدل والموثقون ومراجعيهم اهم مايحتاجه كتاب العدل والموثقون ومراجعيهم <br></p>', '', '', 'SYSTEM', 0, 'AR', NULL, NULL, NULL, NULL, '2016-07-16 12:36:45', '2016-07-16 12:36:45', NULL),
(20, 'الدعاوي الخارجة عن اختصاص المحاكم', '<p>الدعاوي الخارجة عن اختصاص المحاكم الدعاوي الخارجة عن اختصاص المحاكم الدعاوي الخارجة عن اختصاص المحاكم الدعاوي الخارجة عن اختصاص المحاكم الدعاوي الخارجة عن اختصاص المحاكم الدعاوي الخارجة عن اختصاص المحاكم الدعاوي الخارجة عن اختصاص المحاكم <br></p>', '', '', 'SYSTEM', 0, 'AR', NULL, NULL, NULL, NULL, '2016-07-16 12:37:21', '2016-07-16 12:37:21', NULL),
(21, 'شرح مجلة الاحكام العدلية', '<p>شرح مجلة الاحكام العدلية شرح مجلة الاحكام العدلية شرح مجلة الاحكام العدلية شرح مجلة الاحكام العدلية شرح مجلة الاحكام العدلية شرح مجلة الاحكام العدلية شرح مجلة الاحكام العدلية شرح مجلة الاحكام العدلية <br></p>', '', '', 'SYSTEM', 0, 'AR', NULL, NULL, NULL, NULL, '2016-07-16 12:37:46', '2016-07-16 12:37:46', NULL),
(22, 'ترتيب جديد لنظام المرافعات الشرعية', '<p>ترتيب جديد لنظام المرافعات الشرعية ترتيب جديد لنظام المرافعات الشرعية ترتيب جديد لنظام المرافعات الشرعية ترتيب جديد لنظام المرافعات الشرعية ترتيب جديد لنظام المرافعات الشرعية ترتيب جديد لنظام المرافعات الشرعية ترتيب جديد لنظام المرافعات الشرعية <br></p>', '', '', 'SYSTEM', 0, 'AR', NULL, NULL, NULL, NULL, '2016-07-16 12:38:14', '2016-07-16 12:38:14', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `partners`
--

CREATE TABLE `partners` (
  `id` int(11) NOT NULL,
  `title` varchar(2000) NOT NULL,
  `detail` text DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `bg_image` varchar(255) DEFAULT NULL,
  `link` text DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `lang` enum('AR','EN') NOT NULL DEFAULT 'AR',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `partners`
--

INSERT INTO `partners` (`id`, `title`, `detail`, `image`, `bg_image`, `link`, `order`, `lang`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'شركه مخزن الادويه العربي السعودي المحدوده', NULL, '1.jpg', NULL, 'http://sites.al-waan.net/lawfayez', 0, 'AR', '2016-07-02 22:32:40', NULL, NULL),
(2, 'فـن المرمى | الأنجيلة الصناعية', NULL, '2.jpg', NULL, 'http://www.goalart.net/Ar/grass.aspx', 0, 'AR', '2016-07-02 22:32:40', NULL, NULL),
(3, 'شركة حياة للعطورات ومستحضرات التجميل', NULL, '3.jpg', NULL, 'http://sites.al-waan.net/lawfayez', 0, 'AR', '2016-07-02 22:32:40', NULL, NULL),
(4, 'شركة الماجد للعود', NULL, '4.jpg', NULL, 'http://www.almajed4oud.com.sa/', 0, 'AR', '2016-07-02 22:32:40', NULL, NULL),
(5, 'شركة العواد للإستثمار والتطوير', NULL, '5.jpg', NULL, 'https://twitter.com/AlawadCompany', 0, 'AR', '2016-07-02 22:32:40', NULL, NULL),
(6, 'شركة التميمي للمقاولات', NULL, '6.jpg', NULL, 'http://sites.al-waan.net/lawfayez', 0, 'AR', '2016-07-02 22:32:40', NULL, NULL),
(7, 'بوابة المجد', NULL, '7.jpg', NULL, 'http://sites.al-waan.net/lawfayez', 0, 'AR', '2016-07-02 22:32:40', NULL, NULL),
(8, 'تحسين الأداء للتدريب', NULL, '8.jpg', NULL, 'http://tahseenalada.com/default.htm', 0, 'AR', '2016-07-02 22:32:40', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`id`, `email`, `token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(4, 'jobeerd@gmail.com', 'a04e2693008278e0d11e08245d966f19c17b1f6c7b8bfec3e63e660751f6461c', '2016-04-16 14:29:20', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(11) NOT NULL,
  `title_ar` varchar(255) DEFAULT NULL,
  `title_en` varchar(255) DEFAULT NULL,
  `controller` varchar(255) NOT NULL,
  `function` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `title_ar`, `title_en`, `controller`, `function`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'إضافة مستخدم', 'Add User', 'users', 'add', '2016-04-03 03:33:03', NULL, NULL),
(2, 'تعديل مستخدم', 'Edit User', 'users', 'edit', '2016-04-03 03:46:46', NULL, NULL),
(3, 'حذف مستخدم', 'Delete User', 'users', 'delete', '2016-04-03 03:46:46', NULL, NULL),
(4, 'تعديل صلاحيات مستخدم', 'User Permissions Control', 'users', 'permissions', '2016-04-03 03:46:47', NULL, NULL),
(5, 'إضافة تصنيف', 'Add categories', 'categories', 'add', '2016-04-03 04:41:04', NULL, '2016-07-20 21:00:00'),
(6, 'تعديل تصنيف', 'Edit categories', 'categories', 'edit', '2016-04-03 04:41:04', NULL, '2016-07-20 21:00:00'),
(7, 'حذف تصنيف', 'Delete categories', 'categories', 'delete', '2016-04-03 04:41:04', NULL, '2016-07-20 21:00:00'),
(8, 'إضافة صفحة', 'Add pages', 'pages', 'add', '2016-04-03 12:51:14', NULL, '2016-07-20 21:00:00'),
(9, 'تعديل صفحة', 'Edit pages', 'pages', 'edit', '2016-04-03 12:51:15', NULL, '2016-07-20 21:00:00'),
(10, 'تعديل صفحة', 'delete pages', 'pages', 'delete', '2016-04-03 12:51:15', NULL, '2016-07-20 21:00:00'),
(11, 'إضافة خبر', 'Add News', 'news', 'add', '2016-04-03 03:33:03', NULL, '2016-07-27 21:00:00'),
(12, 'تعديل خبر', 'Edit News', 'news', 'edit', '2016-04-03 03:46:46', NULL, '2016-07-20 21:00:00'),
(13, 'حذف خبر', 'Delete News', 'news', 'delete', '2016-04-03 03:46:46', NULL, '2016-07-20 21:00:00'),
(14, 'إضافة فريق العمل', 'Add managers', 'managers', 'add', '2016-04-03 03:33:03', NULL, '2016-07-20 21:00:00'),
(15, 'تعديل  فريق العمل', 'Edit managers', 'managers', 'edit', '2016-04-03 03:46:46', NULL, '2016-07-20 21:00:00'),
(16, 'حذف  فريق العمل', 'Delete managers', 'managers', 'delete', '2016-04-03 03:46:46', NULL, '2016-07-27 21:00:00'),
(17, 'إضافة شركة', 'Add company', 'partners', 'add', '2016-04-03 03:33:03', NULL, '2016-07-20 21:00:00'),
(18, 'تعديل شركة', 'Edit company', 'partners', 'edit', '2016-04-03 03:46:46', NULL, '2016-07-20 21:00:00'),
(19, 'حذف شركة', 'Delete company', 'partners', 'delete', '2016-04-03 03:46:46', NULL, '2016-07-20 21:00:00'),
(20, 'إضافة منتج', 'Add products', 'products', 'add', '2016-04-03 03:33:03', NULL, '2016-04-06 21:00:00'),
(21, 'تعديل منتج', 'Edit products', 'products', 'edit', '2016-04-03 03:46:46', NULL, '2016-04-06 21:00:00'),
(22, 'حذف منتج', 'Delete products', 'products', 'delete', '2016-04-03 03:46:46', NULL, '2016-04-14 21:00:00'),
(23, 'إضافة سلايدر', 'Add sliders', 'sliders', 'add', '2016-04-03 03:33:03', NULL, '2016-07-27 21:00:00'),
(24, 'تعديل سلايدر', 'Edit sliders', 'sliders', 'edit', '2016-04-03 03:46:46', NULL, '2016-07-20 21:00:00'),
(25, 'حذف سلايدر', 'Delete sliders', 'sliders', 'delete', '2016-04-03 03:46:46', NULL, '2016-07-20 21:00:00'),
(26, 'إضافة سؤال شائع', 'Add faqs', 'faqs', 'add', '2016-04-03 03:33:03', NULL, '2016-04-06 21:00:00'),
(27, 'تعديل سؤال شائع', 'Edit faqs', 'faqs', 'edit', '2016-04-03 03:46:46', NULL, '2016-04-27 21:00:00'),
(28, 'حذف سؤال شائع', 'Delete faqs', 'faqs', 'delete', '2016-04-03 03:46:46', NULL, '2016-04-27 21:00:00'),
(29, 'التحكم في الاعدادات', 'Settings', 'settings', '', '2016-04-11 06:37:01', NULL, NULL),
(30, 'عرض والرد على رسائل اتصل بنا', 'View and Replay Contact us', 'contactus', 'edit', '2016-04-14 16:46:39', NULL, NULL),
(31, 'حذف اتصل بنا', 'Delete Contact us', 'contactus', 'delete', '2016-04-14 16:47:31', NULL, NULL),
(32, 'عرض القائمة البريدية', 'view mail list', 'maillist', 'index', '2016-04-14 18:52:52', NULL, '2016-04-01 21:00:00'),
(33, 'حذف ايمل من القائمة البريدية', 'delete email from mail list', 'maillist', 'delete', '2016-04-14 18:53:33', NULL, '2016-03-31 21:00:00'),
(34, 'إضافة فيديوهات', 'Add Video', 'albummedias', 'add', '2016-05-20 16:06:23', NULL, '2016-07-20 21:00:00'),
(35, 'تعديل بيانات فيديو', 'Edit video', 'albummedias', 'edit', '2016-05-20 16:06:23', NULL, '2016-07-20 21:00:00'),
(36, 'حذف فيديو', 'Delete Video', 'albummedias', 'delete', '2016-05-20 16:06:48', NULL, '2016-07-20 21:00:00'),
(37, 'اضافة خبراتنا', NULL, 'skills', 'add', '2016-07-02 19:40:02', NULL, '2016-07-20 21:00:00'),
(38, 'تعديل خبراتنا', NULL, 'skills', 'edit', '2016-07-02 19:40:02', NULL, '2016-07-21 21:00:00'),
(39, 'حذف خبراتنا', NULL, 'skills', 'delete', '2016-07-02 19:40:02', NULL, '2016-07-20 21:00:00'),
(40, 'إضافة أنظمة ولوائح', NULL, 'systems', 'add', '2016-07-16 15:32:51', NULL, '2016-07-20 21:00:00'),
(41, 'تعديل انظمة ولوائح', NULL, 'systems', 'edit', '2016-07-16 15:32:51', NULL, '2016-07-20 21:00:00'),
(42, 'حذف انظمة ولوائح', NULL, 'systems', 'delete', '2016-07-16 15:33:16', NULL, '2016-07-20 21:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` int(11) NOT NULL,
  `date` varchar(255) NOT NULL,
  `date_confirmation` enum('YES','NO') NOT NULL DEFAULT 'NO',
  `customer_id` int(11) NOT NULL,
  `issues_id` int(11) NOT NULL DEFAULT 0,
  `employee_id` int(11) NOT NULL DEFAULT 0,
  `side` varchar(255) DEFAULT NULL,
  `circuit` varchar(255) DEFAULT NULL,
  `judge` text DEFAULT NULL,
  `files` text DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `date`, `date_confirmation`, `customer_id`, `issues_id`, `employee_id`, `side`, `circuit`, `judge`, `files`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '2016/07/22 07:06', 'NO', 1, 1, 5, 'الجهة القضائية', 'الدائرة القضائية', 'القاضي', '1469160394.docx', '2016-07-22 04:06:34', '2016-07-22 04:09:09', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sessions_reports`
--

CREATE TABLE `sessions_reports` (
  `id` int(11) NOT NULL,
  `day` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `issues_id` int(11) DEFAULT 0,
  `employee_id` int(11) NOT NULL DEFAULT 0,
  `place` varchar(255) NOT NULL,
  `detail` text NOT NULL,
  `reqierd` text NOT NULL,
  `next_time` varchar(255) NOT NULL,
  `files` text DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `sessions_reports`
--

INSERT INTO `sessions_reports` (`id`, `day`, `date`, `customer_id`, `issues_id`, `employee_id`, `place`, `detail`, `reqierd`, `next_time`, `files`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '', '2016/07/22 07:45', 1, 1, 5, 'مكان الجلسة', '<p><span style=\"font-family: beINNormal, Mj_SazehLight, tahoma, arial, helvetica; line-height: 20px;\">التفاصيل</span><br></p>', '<p><span style=\"font-family: beINNormal, Mj_SazehLight, tahoma, arial, helvetica; line-height: 20px;\">المطلوب</span><br></p>', '2016/07/22 07:45', '1469162745.docx', '2016-07-22 04:45:45', '2016-07-22 04:45:45', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `key` varchar(2000) NOT NULL,
  `value` text DEFAULT NULL,
  `lang` enum('AR','EN') NOT NULL DEFAULT 'AR',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `issues_id` int(11) NOT NULL DEFAULT 0,
  `employee_id` int(11) NOT NULL DEFAULT 0,
  `side` varchar(255) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  `detail` text DEFAULT NULL,
  `report` text DEFAULT NULL,
  `reqierd` text DEFAULT NULL,
  `files` text DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `title`, `issues_id`, `employee_id`, `side`, `date`, `detail`, `report`, `reqierd`, `files`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'العنوان', 1, 5, 'الجهة', '2016/07/22 06:00', '<p><span style=\"font-family: beINNormal, Mj_SazehLight, tahoma, arial, helvetica; line-height: 20px;\">التفاصيل</span><br></p>', '<p><span style=\"font-family: beINNormal, Mj_SazehLight, tahoma, arial, helvetica; line-height: 20px;\">التقرير الخاص</span><br></p>', '<p><span style=\"font-family: beINNormal, Mj_SazehLight, tahoma, arial, helvetica; line-height: 20px;\">المطلوب</span><br></p>', '1482592732.txt', '2016-07-22 03:01:14', '2016-12-24 15:18:52', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` enum('ACTIVE','INACTIVE') NOT NULL DEFAULT 'ACTIVE',
  `permissions` text DEFAULT NULL,
  `role` enum('ADMIN','CUSTOMER','EMPLOYEE') NOT NULL DEFAULT 'EMPLOYEE',
  `remember_token` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `password`, `status`, `permissions`, `role`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'admin', 'admin', 'admin@hotmail.com', '$2y$10$OWZheS82z1.fNDZLmNxIBu3HnEGD.ecIIabrZYTVbXaVmrasPwU4a', 'ACTIVE', '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,23,24,25,29,30,31,34,35,36,37,38,39,40,41,42', 'ADMIN', 'SFRzZXtMtMRXEImxOuFRB60gWXLdSZy9LGFa0wFgVshA5ne5RMjB1hH2L6e6', '2016-04-01 12:30:51', '2017-01-09 08:35:58', NULL),
(5, 'employee', 'employee', 'employee@hotmail.com', '$2y$10$Sdvash63S2rtss5skgwn0OSeTIFQbp2jRXIXIPVuyjRZeuLyj7U3a', 'ACTIVE', '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,23,24,25,29,30,31,34,35,36,37,38,39,40,41,42', 'EMPLOYEE', 'tARavDRnpN0fnR3dwlc3YyT5DzPzbvt2Va2NTLJn67BAc3nNqyu1b2gW4wNI', '2016-07-21 15:02:29', '2016-07-22 02:49:42', NULL),
(6, 'customer', 'customer', 'customer@hotmail.com', '$2y$10$igO10fpISsfuFvltF2RqneBbTut1dBsY/PEYNpi2aRqze9yn7nWC6', 'ACTIVE', '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,23,24,25,29,30,31,34,35,36,37,38,39,40,41,42', 'CUSTOMER', '45V1M9IgiyKvxsfzHQEOInoGfKkvOsq2EYyGkr5QAyzRq9MKpMdxXyupw02b', '2016-07-21 17:05:35', '2016-07-21 17:30:39', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `issues`
--
ALTER TABLE `issues`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs_app`
--
ALTER TABLE `jobs_app`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lang`
--
ALTER TABLE `lang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `partners`
--
ALTER TABLE `partners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions_reports`
--
ALTER TABLE `sessions_reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `issues`
--
ALTER TABLE `issues`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs_app`
--
ALTER TABLE `jobs_app`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lang`
--
ALTER TABLE `lang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `partners`
--
ALTER TABLE `partners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sessions_reports`
--
ALTER TABLE `sessions_reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

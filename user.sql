/*
 Navicat Premium Data Transfer

 Source Server         : Iocalhost
 Source Server Type    : MySQL
 Source Server Version : 50710
 Source Host           : localhost
 Source Database       : user

 Target Server Type    : MySQL
 Target Server Version : 50710
 File Encoding         : utf-8

 Date: 02/19/2016 01:09:14 AM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `ci_sessions`
-- ----------------------------
DROP TABLE IF EXISTS `ci_sessions`;
CREATE TABLE `ci_sessions` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `ci_sessions`
-- ----------------------------
BEGIN;
INSERT INTO `ci_sessions` VALUES ('034808b76c0f9a61a3bb15080d1b65b2accb3035', '127.0.0.1', '1455685854', 0x5f5f63695f6c6173745f726567656e65726174657c693a313435353638353834393b757365725f69647c693a373b757365726e616d657c733a343a2261626364223b6c6f676765645f696e7c623a313b69735f61646d696e7c623a303b), ('0ba70d6f650344bbe81e6a0f0140fbb1651e9ec3', '127.0.0.1', '1455717336', 0x5f5f63695f6c6173745f726567656e65726174657c693a313435353731373333343b757365725f69647c693a373b757365726e616d657c733a343a2261626364223b6c6f676765645f696e7c623a313b69735f61646d696e7c623a303b), ('10fa9b0371261f4584e90fd373e7392eba3eb5d3', '127.0.0.1', '1455725564', 0x5f5f63695f6c6173745f726567656e65726174657c693a313435353732353236353b757365725f69647c693a373b757365726e616d657c733a343a2261626364223b6c6f676765645f696e7c623a313b69735f61646d696e7c623a303b), ('1919617580d48e9d901f6dee8269758a9f132ccf', '127.0.0.1', '1455725131', 0x5f5f63695f6c6173745f726567656e65726174657c693a313435353732343834303b757365725f69647c693a373b757365726e616d657c733a343a2261626364223b6c6f676765645f696e7c623a313b69735f61646d696e7c623a303b), ('19567bfc2b2ddd21e9fb9b7b7c3229b8e717e022', '127.0.0.1', '1455789046', 0x5f5f63695f6c6173745f726567656e65726174657c693a313435353738383937313b), ('19df47d4392cef42b6f39e01e63a87cc5e8ac811', '127.0.0.1', '1455803708', 0x5f5f63695f6c6173745f726567656e65726174657c693a313435353830333531383b), ('21f5e3eced1dc5b9ace4ede0632f4f2dd1aad60e', '127.0.0.1', '1455809990', 0x5f5f63695f6c6173745f726567656e65726174657c693a313435353830393730303b), ('39e1770b4408880b6eaca590e64a1e3a34850377', '127.0.0.1', '1455718573', 0x5f5f63695f6c6173745f726567656e65726174657c693a313435353731383537333b757365725f69647c693a373b757365726e616d657c733a343a2261626364223b6c6f676765645f696e7c623a313b69735f61646d696e7c623a303b), ('3e04b4ff434caee7c6cb40d4f28d802d07d2b175', '127.0.0.1', '1455467912', 0x5f5f63695f6c6173745f726567656e65726174657c693a313435353436373930383b), ('3efd3caa395dc127eb3c4ffe27516c5bbbc29949', '127.0.0.1', '1455791421', 0x5f5f63695f6c6173745f726567656e65726174657c693a313435353739313231363b), ('4390939bd534345c6df07f40cef12cbd32ae7aa3', '127.0.0.1', '1455814735', 0x5f5f63695f6c6173745f726567656e65726174657c693a313435353831343637323b757365725f69647c693a373b757365726e616d657c733a343a2261626364223b6c6f676765645f696e7c623a313b69735f61646d696e7c623a303b), ('44b0a0e2e3ea11e316aa4c5b53a9fb593ba5662d', '127.0.0.1', '1455815253', 0x5f5f63695f6c6173745f726567656e65726174657c693a313435353831353137383b), ('49e9792d0feb16c7127a2c8915cf20df688cb40b', '127.0.0.1', '1455790383', 0x5f5f63695f6c6173745f726567656e65726174657c693a313435353739303338333b), ('4cd5aa988bd0bfdba60c33ddd8badea28915dc82', '127.0.0.1', '1455727147', 0x5f5f63695f6c6173745f726567656e65726174657c693a313435353732373031303b757365725f69647c693a373b757365726e616d657c733a343a2261626364223b6c6f676765645f696e7c623a313b69735f61646d696e7c623a303b), ('544a00de981a04c0c2b13ba93cf805abb1a5260b', '127.0.0.1', '1455804162', 0x5f5f63695f6c6173745f726567656e65726174657c693a313435353830343136323b), ('597247e954a71d083bf9c8d3d75e87536eb47d6b', '127.0.0.1', '1455683592', 0x5f5f63695f6c6173745f726567656e65726174657c693a313435353638333537383b757365725f69647c693a373b757365726e616d657c733a343a2261626364223b6c6f676765645f696e7c623a313b69735f61646d696e7c623a303b), ('67cd44eb1f4b0b7f5617e49223123c5531fa3c5b', '127.0.0.1', '1455803733', 0x5f5f63695f6c6173745f726567656e65726174657c693a313435353830333733333b), ('6b7fe563eb58981ed7bdb08b11a8a38cd4210d98', '127.0.0.1', '1455809450', 0x5f5f63695f6c6173745f726567656e65726174657c693a313435353830393336393b), ('7da15b4f2eb85bf70a0a43e315680dc700648ee5', '127.0.0.1', '1455809107', 0x5f5f63695f6c6173745f726567656e65726174657c693a313435353830383931303b), ('83a3c5cba0452c9840ea5d82d3e1c9a850d42bab', '127.0.0.1', '1455775551', 0x5f5f63695f6c6173745f726567656e65726174657c693a313435353737353535313b), ('8a8d351197e1b0254a4351941a3545eb5d5ed751', '127.0.0.1', '1455812743', 0x5f5f63695f6c6173745f726567656e65726174657c693a313435353831323439383b), ('9028b952297e0bffc7e40db30c98bee91109d6e8', '127.0.0.1', '1455770481', 0x5f5f63695f6c6173745f726567656e65726174657c693a313435353737303239353b757365725f69647c693a373b757365726e616d657c733a343a2261626364223b6c6f676765645f696e7c623a313b69735f61646d696e7c623a303b), ('92b79c51f51602f381717e917d9ca20e8a37c4eb', '127.0.0.1', '1455787450', 0x5f5f63695f6c6173745f726567656e65726174657c693a313435353738373435303b), ('92eaca3daecc1deb6a0aff62e0d20862b2c31bbb', '127.0.0.1', '1455594723', 0x5f5f63695f6c6173745f726567656e65726174657c693a313435353539343732323b), ('a0e79765dd025ce94aeb34ae32b319f35affbd49', '127.0.0.1', '1455725766', 0x5f5f63695f6c6173745f726567656e65726174657c693a313435353732353736363b), ('a2c3e3fce6dc70ce0ac6fc0534e4911b62ace170', '127.0.0.1', '1455681600', 0x5f5f63695f6c6173745f726567656e65726174657c693a313435353638313431383b), ('a69d29208c665ec8c557adf998a51964e71f3992', '127.0.0.1', '1455814948', 0x5f5f63695f6c6173745f726567656e65726174657c693a313435353831343837323b), ('a8ea2b99efc2205a3cf23cb2acf0dfb3ccdf4df3', '127.0.0.1', '1455813592', 0x5f5f63695f6c6173745f726567656e65726174657c693a313435353831333434333b), ('b035f99f593196b12dc1c22d32407d58fbbe25c0', '127.0.0.1', '1455811174', 0x5f5f63695f6c6173745f726567656e65726174657c693a313435353831303838333b), ('b68ed3ac111a85c1039dffe7c0077fead14c6d0d', '127.0.0.1', '1455728989', 0x5f5f63695f6c6173745f726567656e65726174657c693a313435353732383938363b757365725f69647c693a373b757365726e616d657c733a343a2261626364223b6c6f676765645f696e7c623a313b69735f61646d696e7c623a303b), ('b80c0d24dad8ed060c7f00509ed5dc13a4ee419f', '127.0.0.1', '1455769644', 0x5f5f63695f6c6173745f726567656e65726174657c693a313435353736393633323b757365725f69647c693a373b757365726e616d657c733a343a2261626364223b6c6f676765645f696e7c623a313b69735f61646d696e7c623a303b), ('bb3cd20555edab1f2b5a6d63db9e40add1b636aa', '127.0.0.1', '1455793290', 0x5f5f63695f6c6173745f726567656e65726174657c693a313435353739333233303b), ('bc1d1d7b10b1b1b061a632577a6d39fefd4dba6b', '127.0.0.1', '1455813435', 0x5f5f63695f6c6173745f726567656e65726174657c693a313435353831333133373b), ('c0380ad71f7d3399bcea5c828a4d20c9c1e0f4c9', '127.0.0.1', '1455688922', 0x5f5f63695f6c6173745f726567656e65726174657c693a313435353638383932323b757365725f69647c693a373b757365726e616d657c733a343a2261626364223b6c6f676765645f696e7c623a313b69735f61646d696e7c623a303b), ('c1444cd6ee8e2c7227cf871aca3d089cc68b07ba', '127.0.0.1', '1455811822', 0x5f5f63695f6c6173745f726567656e65726174657c693a313435353831313632313b), ('c56e08c5e95fadc7fd530d9e4104dc009f147702', '127.0.0.1', '1455790387', 0x5f5f63695f6c6173745f726567656e65726174657c693a313435353739303338373b), ('cb03fe0637809132574455d77aa74b389f889b8e', '127.0.0.1', '1455776821', 0x5f5f63695f6c6173745f726567656e65726174657c693a313435353737363832313b), ('cd4a40e2d479deb3e3d2dcc9925e851c7b768225', '127.0.0.1', '1455728229', 0x5f5f63695f6c6173745f726567656e65726174657c693a313435353732383231373b757365725f69647c693a373b757365726e616d657c733a343a2261626364223b6c6f676765645f696e7c623a313b69735f61646d696e7c623a303b), ('d3641af2175679e6a0857f013b6e42847d4f63f4', '127.0.0.1', '1455685721', 0x5f5f63695f6c6173745f726567656e65726174657c693a313435353638353730323b), ('d83f2e72cf1aa99dd575c0480c256ad2b168587a', '127.0.0.1', '1455814775', 0x5f5f63695f6c6173745f726567656e65726174657c693a313435353831343530353b), ('df27c500bdf128bd2d46924b6984c9aab3fc1152', '127.0.0.1', '1455814329', 0x5f5f63695f6c6173745f726567656e65726174657c693a313435353831343132393b), ('e3871099a570dffcb20587125a8254f11097ef10', '127.0.0.1', '1455792570', 0x5f5f63695f6c6173745f726567656e65726174657c693a313435353739323334383b), ('eca68bbe17a64804f8f090170d58b47b03082b93', '127.0.0.1', '1455692609', 0x5f5f63695f6c6173745f726567656e65726174657c693a313435353639323630393b), ('f05352b735f419394140a643a5f1dbb6cc8be49f', '127.0.0.1', '1455777313', 0x5f5f63695f6c6173745f726567656e65726174657c693a313435353737373331313b757365725f69647c693a373b757365726e616d657c733a343a2261626364223b6c6f676765645f696e7c623a313b69735f61646d696e7c623a303b), ('f546386c70c0a863c5413194a7904e50a8c7afaf', '127.0.0.1', '1455688918', 0x5f5f63695f6c6173745f726567656e65726174657c693a313435353638383538343b757365725f69647c693a373b757365726e616d657c733a343a2261626364223b6c6f676765645f696e7c623a313b69735f61646d696e7c623a303b), ('f678a9473915331cd13a4164db511b1b833ab9b4', '127.0.0.1', '1455810434', 0x5f5f63695f6c6173745f726567656e65726174657c693a313435353831303239383b), ('f91ba92f4eaa255ddcb4114282c6342dca44a50a', '127.0.0.1', '1455814085', 0x5f5f63695f6c6173745f726567656e65726174657c693a313435353831333739373b), ('fe449309f2d3ec744ec3ce9d9ce0bd6ada66bc0d', '127.0.0.1', '1455792152', 0x5f5f63695f6c6173745f726567656e65726174657c693a313435353739323031333b), ('ff07c0ae7ea6c12272a71b8ea68e242c672251f6', '127.0.0.1', '1454744447', 0x5f5f63695f6c6173745f726567656e65726174657c693a313435343734343233313b757365725f69647c693a373b757365726e616d657c733a343a2261626364223b6c6f676765645f696e7c623a313b69735f61646d696e7c623a303b);
COMMIT;

-- ----------------------------
--  Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `password` varchar(255) NOT NULL DEFAULT '',
  `created_at` datetime NOT NULL,
  `is_admin` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_confirmed` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `username_hash` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `users`
-- ----------------------------
BEGIN;
INSERT INTO `users` VALUES ('1', 'iservice', 'iservice@njupt.edu.cn', '$2y$10$58.QaDBPXkYGK8p9BE3tkuyeRyChnxt6CP7.2/pre/UWzS4WmKDrG', '2016-01-23 08:58:29', '1', '1', null), ('6', 'thunderrun', 'b14040410@njupt.edu.cn', '$2y$10$Je2rbBLu/yFYu5X95AHM6OD6gbT/6BEFG21bEbEDodgaPtfdAiAku', '2016-02-01 09:56:28', '0', '1', 'e0ca7b642a21c770319af54ff4d9f33f'), ('7', 'abcd', '879045141@qq.com', '$2y$10$E/4PE8AX/GhnWwlh4cdGPevW2mJ/Q6x9QtooP9.RfhtpMcgx9dt/2', '2016-02-06 15:29:27', '0', '1', 'e2fc714c4727ee9395f324cd2e7f331f');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;

-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2019 at 10:20 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `invenventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `item_name` varchar(128) NOT NULL,
  `type` varchar(128) NOT NULL,
  `category` varchar(128) NOT NULL,
  `location` varchar(128) NOT NULL,
  `vendor` varchar(128) NOT NULL,
  `quantity` int(128) NOT NULL,
  `last_modified` varchar(128) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_email` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `item_name`, `type`, `category`, `location`, `vendor`, `quantity`, `last_modified`, `user_id`, `user_email`) VALUES
(17, 'Sepatu Nike', 'Birthday', 'Sepatu', 'Surabaya Warehouse', 'Nike', 2000, '1575339547', 7, 'Alessandro Luiz Kartika'),
(19, 'Sandal Swallow', 'Sandal', 'Sandal', 'Jakarta Warehouse', 'Swallow', 100, '1575340378', 9, 'grand@gmail.com'),
(20, 'Sepatu Nike', 'Sepatu', 'Sepatu', 'Jakarta Warehouse', 'Nike', 1000, '1575534196', 7, 'sandro@gmail.com'),
(21, 'Baju Anak', 'Baju', 'Baju', 'Surabaya warehouse', 'H&amp;M', 1200, '1575534509', 7, 'sandro@gmail.com'),
(24, '123213', '123123', '1321231', '123213', '1321231', 123123, '1575534925', 9, 'grand@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `image`, `password`, `role_id`, `is_active`, `date_created`) VALUES
(6, 'Denny Admin', 'denny@gmail.com', '483845_3945271089391_742344881_n.jpg', '$2y$10$3bBpAPHICfvXTZlMCEzXEe78ArpTk/vDunMGUhGZoLHssC2buf2Jm', 1, 1, 1572239504),
(7, 'Alessandro Luiz Kartika', 'sandro@gmail.com', 'default.jpg', '$2y$10$G9gMOpbZ5EG6P5f3jm8ATerHMxtPdLIjE4d00Vxod6Lg7c.8fH2cm', 2, 1, 1572284094),
(8, 'Eugene Sebastian', 'eugene@gmail.com', 'default.jpg', '$2y$10$c.SljcIAdJLXIZG2Rm54SeJ1pKpAi4tnOVnqQSxgmtz/en4C3t0p2', 2, 1, 1572315304),
(9, 'Grand Marcell', 'grand@gmail.com', 'default.jpg', '$2y$10$mm96sYNVGKF2zZE6zNeawe84kWcWW96bypgAatMZeJhIxZzKboYwK', 2, 1, 1573180008),
(10, 'raymond denny', 'raymond@gmail.com', 'default.jpg', '$2y$10$KqJoJIRf0z.pJh0oR2u7c..7tOw.JnxRAv.ws3ihYqMxWUOu023Sa', 1, 1, 1573620391),
(11, 'klemens wiyanto', 'klemens@gmail.com', 'default.jpg', '$2y$10$WhmRYaLL1pq816Bl4z4b1.0kVtZa/u83XPk4HTZUtkZ86r3bEKhGG', 2, 0, 1575526250),
(14, 'Denny Raymond', 'dennyraymondd@gmail.com', 'default.jpg', '$2y$10$2cOYl2O7draUnM6hQO/w/.ZnYwE.KZ7b904MoJ94Ye.XYPDd92W3O', 2, 1, 1575532709);

-- --------------------------------------------------------

--
-- Table structure for table `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 2),
(4, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`) VALUES
(1, 'Admin'),
(2, 'User'),
(3, 'Menu');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'Administrator'),
(2, 'Member');

-- --------------------------------------------------------

--
-- Table structure for table `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title_submenu` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title_submenu`, `url`, `icon`, `is_active`) VALUES
(1, 1, 'Dashboard', 'admin', 'fas fa-fw fa-tachometer-alt', 1),
(2, 2, 'My Profile', 'user', 'fas fa-fw fa-user', 1),
(9, 3, 'Menu Management', 'menu', 'fas fa-fw fa-folder-open', 1),
(10, 3, 'Submenu Management', 'menu/submenu', 'far fa-folder-open', 1),
(12, 2, 'Items', 'user/items', 'fas fa-fw fa-boxes', 1),
(15, 2, 'Help & FAQ', 'user/help', 'fas fa-fw fa-hands-helping', 1),
(17, 1, 'Role', 'admin/role', 'fas fa-fw fa-user-tie', 1),
(18, 2, 'Edit Profile', 'user/edit', 'fas fa-fw fa-user-edit', 1),
(19, 2, 'Change Password', 'user/changepassword', 'fas fa-fw fa-key', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_token`
--

CREATE TABLE `user_token` (
  `id` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `token` varchar(128) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_token`
--
ALTER TABLE `user_token`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

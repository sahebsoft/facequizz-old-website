

--
-- Database: `facequiz_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `answer`
--

CREATE TABLE `answer` (
  `id` int NOT NULL,
  `quiz_id` int NOT NULL,
  `question_id` int DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `points` int NOT NULL DEFAULT '0',
  `image` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Triggers `answer`
--
DELIMITER $$
CREATE TRIGGER `answer_after_insert` AFTER INSERT ON `answer` FOR EACH ROW insert ignore into score (quiz_id,answer_id,result_id,score_value)
(select new.quiz_id,new.id,a.id,0 
from result a where a.quiz_id = new.quiz_id)
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `answer_seq_update` BEFORE INSERT ON `answer` FOR EACH ROW update table_seq set id = NEW.id where table_name='answer'
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int NOT NULL,
  `name` text NOT NULL,
  `subject` text NOT NULL,
  `email` text NOT NULL,
  `message` text NOT NULL,
  `send_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `division`
--

CREATE TABLE `division` (
  `id` int NOT NULL,
  `title` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `lookup`
--

CREATE TABLE `lookup` (
  `major_code` varchar(6) NOT NULL,
  `minor_code` varchar(6) NOT NULL,
  `title` varchar(50) CHARACTER SET ucs2 COLLATE ucs2_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `lookup`
--

INSERT INTO `lookup` (`major_code`, `minor_code`, `title`) VALUES
('0', '1', 'status'),
('0', '2', 'Quiz Type'),
('1', '1', 'active'),
('1', '2', 'not active'),
('2', '1', 'Personality'),
('2', '2', 'Points'),
('2', '3', 'Puzzle');

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `id` int NOT NULL,
  `quiz_id` int NOT NULL,
  `title` text NOT NULL,
  `image` text,
  `youtube_code` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Triggers `question`
--
DELIMITER $$
CREATE TRIGGER `question_seq_update` BEFORE INSERT ON `question` FOR EACH ROW update table_seq set id = NEW.id where table_name='question'
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `quiz`
--

CREATE TABLE `quiz` (
  `id` int NOT NULL,
  `title` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `image` varchar(200) CHARACTER SET ucs2 COLLATE ucs2_general_ci DEFAULT NULL,
  `username` varchar(20) DEFAULT NULL,
  `division_id` int NOT NULL DEFAULT '1',
  `quiz_type` smallint NOT NULL DEFAULT '1',
  `create_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int NOT NULL DEFAULT '2',
  `sub_title` text,
  `random_flag` int DEFAULT '0',
  `adsense_flag` int NOT NULL DEFAULT '0',
  `star_flag` int NOT NULL DEFAULT '0',
  `publish_date` timestamp NULL DEFAULT NULL,
  `score_flag` int UNSIGNED DEFAULT '2',
  `fb_flag` int NOT NULL DEFAULT '0',
  `visits` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Triggers `quiz`
--
DELIMITER $$
CREATE TRIGGER `quiz_after_update` BEFORE UPDATE ON `quiz` FOR EACH ROW begin
set NEW.update_date = NOW();
if NEW.status = 1 then
set NEW.publish_date = NOW();
end if;
end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `quiz_seq_update` BEFORE INSERT ON `quiz` FOR EACH ROW update table_seq set id = NEW.id where table_name='quiz'
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `result`
--

CREATE TABLE `result` (
  `id` int NOT NULL,
  `quiz_id` int NOT NULL,
  `title` varchar(200) CHARACTER SET ucs2 COLLATE ucs2_general_ci NOT NULL,
  `image` varchar(255) CHARACTER SET ucs2 COLLATE ucs2_general_ci DEFAULT NULL,
  `sub_title` text,
  `point_from` int NOT NULL DEFAULT '0',
  `point_to` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Triggers `result`
--
DELIMITER $$
CREATE TRIGGER `result_after_insert` AFTER INSERT ON `result` FOR EACH ROW insert ignore into score (quiz_id,result_id,answer_id,score_value)
(select NEW.quiz_id,NEW.id,a.id,0 from answer a where a.quiz_id = NEW.quiz_id)
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `result_seq_update` BEFORE INSERT ON `result` FOR EACH ROW update table_seq set id = NEW.id where table_name='result'
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `score`
--

CREATE TABLE `score` (
  `id` int NOT NULL,
  `quiz_id` int NOT NULL,
  `answer_id` int NOT NULL,
  `result_id` int NOT NULL,
  `score_value` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `table_seq`
--

CREATE TABLE `table_seq` (
  `id` int NOT NULL,
  `table_name` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `table_seq`
--

INSERT INTO `table_seq` (`id`, `table_name`) VALUES
(0, 'result'),
(0, 'answer'),
(7026, 'question'),
(646, 'quiz');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(20) NOT NULL,
  `password` varchar(64) DEFAULT NULL,
  `title` varchar(50) CHARACTER SET ucs2 COLLATE ucs2_general_ci DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `user_type` varchar(6) NOT NULL DEFAULT 'u',
  `division_id` int NOT NULL DEFAULT '1',
  `status` int DEFAULT NULL,
  `ad_slot` bigint NOT NULL DEFAULT '6162941872'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answer`
--
ALTER TABLE `answer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_id` (`question_id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `division`
--
ALTER TABLE `division`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lookup`
--
ALTER TABLE `lookup`
  ADD PRIMARY KEY (`major_code`,`minor_code`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quiz_id` (`quiz_id`);

--
-- Indexes for table `quiz`
--
ALTER TABLE `quiz`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quiz_FK1` (`username`),
  ADD KEY `visits` (`visits`);
ALTER TABLE `quiz` ADD FULLTEXT KEY `sub_title` (`sub_title`);
ALTER TABLE `quiz` ADD FULLTEXT KEY `title` (`title`);

--
-- Indexes for table `result`
--
ALTER TABLE `result`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quiz_id` (`quiz_id`);

--
-- Indexes for table `score`
--
ALTER TABLE `score`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `answer_id` (`answer_id`,`result_id`),
  ADD KEY `answer_fk2` (`result_id`),
  ADD KEY `quiz_id` (`quiz_id`,`answer_id`,`result_id`);

--
-- Indexes for table `table_seq`
--
ALTER TABLE `table_seq`
  ADD PRIMARY KEY (`table_name`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answer`
--
ALTER TABLE `answer`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quiz`
--
ALTER TABLE `quiz`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `result`
--
ALTER TABLE `result`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `score`
--
ALTER TABLE `score`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `answer`
--
ALTER TABLE `answer`
  ADD CONSTRAINT `answer_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `question` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `score`
--
ALTER TABLE `score`
  ADD CONSTRAINT `score_ibfk_1` FOREIGN KEY (`answer_id`) REFERENCES `answer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `score_ibfk_2` FOREIGN KEY (`result_id`) REFERENCES `result` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

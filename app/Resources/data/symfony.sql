
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `symfony`
--

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`id`, `title`, `content`) VALUES
(1, 'An Article', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr'),
(2, 'Another one', 'consetetur sadipscing elitr'),
(3, 'Here we go again', 'sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat'),
(4, 'And again', 'At vero eos et accusam et justo duo dolores'),
(5, 'This is not the end', 'Whatever this means.'),
(6, 'This is not the beginning', 'But it may be one day'),
(7, 'The end', 'Sadly its over');

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `article_id`, `title`, `content`) VALUES
(1, 1, 'First', 'This is the first comment!'),
(2, 1, 'Damn', 'Second comment for this aritcle'),
(3, 3, 'Just for fun', 'I dont know what I was thinking...'),
(4, 4, 'Lorem what', 'I wonder who reads this.'),
(5, 7, 'Good buy', 'Hope to see you soon');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

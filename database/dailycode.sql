-- SQL Dump

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `codes` (
  `id` int(11) NOT NULL,
  `language` varchar(15) NOT NULL,
  `code` text NOT NULL,
  `output` varchar(30) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `codes` (`id`, `language`, `code`, `output`, `date`) VALUES
(1, 'JavaScript', 'const val1 = \"5\" - 3;\nconst val2 = \"5\" + 3;\nconst val3 = val1 + val2;\n\nconsole.log(val3);', '253', '2026-02-03'),
(2, 'Python', 'def add_to(item, count=0, list_data=[]):\n    list_data.append(item)\n    return len(list_data) + count\n\nprint(add_to(10, 2))\nprint(add_to(20, 3))', '3 5', '2026-02-04'),
(3, 'Ruby', 'a = nil\nb = 20\nc = 10\n\na ||= b\na += c\nb = nil\n\nputs a', '30', '2026-02-05'),
(6, 'Python', 'value = 1\r\nfor i in range(3):\r\n    value += i * value\r\nprint(value)\r\n', '7', '2026-02-06'),
(7, 'JavaScript', 'let a = \"2\";\r\nlet b = a + 3;\r\nlet c = b - 1;\r\nconsole.log(c);\r\n', '22', '2026-02-07'),
(8, 'C++', '#include <iostream>\r\nusing namespace std;\r\n\r\nint main() {\r\n    int x = 5;\r\n    x = x++ + ++x;\r\n    cout << x;\r\n}\r\n', '12', '2026-02-08'),
(9, 'Ruby', 'text = \"Hi\"\r\n3.times do |i|\r\n  text = text + i.to_s\r\nend\r\nputs text.length\r\n', '5', '2026-02-09'),
(10, 'Php', '<?php\r\n$x = \"5\";\r\n$y = $x + 2;\r\n$z = $x . 2;\r\necho $y + strlen($z);\r\n?>\r\n', '10', '2026-02-10'),
(11, 'Java', 'public class Main {\r\n    public static void main(String[] args) {\r\n        int a = 4;\r\n        int b = a++ + ++a;\r\n        System.out.print(b);\r\n    }\r\n}\r\n', '10', '2026-02-11'),
(12, 'C#', 'using System;\r\n\r\nclass Program {\r\n    static void Main() {\r\n        int x = 3;\r\n        int y = x * x++;\r\n        Console.Write(y);\r\n    }\r\n}\r\n', '9', '2026-02-12'),
(13, 'Go', 'package main\r\nimport \"fmt\"\r\n\r\nfunc main() {\r\n    x := 2\r\n    for i := 0; i < 3; i++ {\r\n        x += i + x\r\n    }\r\n    fmt.Println(x)\r\n}\r\n', '22', '2026-02-13'),
(14, 'Python', 'nums = [1, 2, 3]\r\nresult = nums[0]\r\nnums[0] = nums[1]\r\nresult += nums[0]\r\nprint(result)\r\n', '3', '2026-02-14'),
(15, 'JavaScript', 'let str = \"Hi\";\r\nstr += 3 + 2;\r\nconsole.log(str);\r\n', 'Hi5', '2026-02-15'),
(16, 'Go', 'text = \"Go\"\r\n3.times { |i| text += (i+1).to_s }\r\nputs text\r\n', 'Go123', '2026-02-16'),
(17, 'C++', '#include <iostream>\r\nusing namespace std;\r\n\r\nint main() {\r\n    int a = 6;\r\n    int b = 2;\r\n    a += b++ * a;\r\n    cout << a;\r\n}\r\n', '18', '2026-02-17'),
(18, 'Java', 'public class Main {\r\n    public static void main(String[] args) {\r\n        String s = \"3\";\r\n        int x = Integer.parseInt(s) + s.length();\r\n        System.out.print(x);\r\n    }\r\n}\r\n', '4', '2026-02-18');

CREATE TABLE `dates` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `code_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `dates` (`id`, `date`, `code_id`) VALUES
(1, '2026-02-03', 1),
(2, '2026-02-04', 2),
(179, '2026-02-05', 3);

ALTER TABLE `codes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `date` (`date`);

ALTER TABLE `dates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `date` (`date`),
  ADD KEY `code_id` (`code_id`);

ALTER TABLE `codes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

ALTER TABLE `dates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=227;

ALTER TABLE `dates`
  ADD CONSTRAINT `1` FOREIGN KEY (`code_id`) REFERENCES `codes` (`id`);
COMMIT;

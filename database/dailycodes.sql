-- SQL Dump

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

CREATE DATABASE IF NOT EXISTS `dailycode`;
USE `dailycode`;

CREATE TABLE `codes` (
  `id` int(11) NOT NULL,
  `language` varchar(15) NOT NULL,
  `code` text NOT NULL,
  `output` varchar(30) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `codes` (`id`, `language`, `code`, `output`, `date`) VALUES
(1, 'JavaScript', 'const val1 = "5" - 3;\nconst val2 = "5" + 3;\nconst val3 = val1 + val2;\n\nconsole.log(val3);', '253', '2026-02-03'),

(2, 'Python', 'def add_to(item, count=0, list_data=[]):\n    list_data.append(item)\n    return len(list_data) + count\n\nprint(add_to(10, 2))\nprint(add_to(20, 3))', '3 5', '2026-02-04'),

(3, 'Ruby', 'a = nil\nb = 20\nc = 10\n\na ||= b\na += c\nb = nil\n\nputs a', '30', '2026-02-05'),

(6, 'Python', 'value = 1\nfor i in range(3):\n    value += i * value\nprint(value)', '7', '2026-02-06'),

(7, 'JavaScript', 'let a = "2";\nlet b = a + 3;\nlet c = b - 1;\nconsole.log(c);', '22', '2026-02-07'),

(8, 'C++', '#include <iostream>\nusing namespace std;\n\nint main() {\n    int x = 5;\n    x = x++ + ++x;\n    cout << x;\n}', '12', '2026-02-08'),

(9, 'Ruby', 'text = "Hi"\n3.times do |i|\n  text = text + i.to_s\nend\nputs text.length', '5', '2026-02-09'),

(10, 'PHP', '<?php\n$x = "5";\n$y = $x + 2;\n$z = $x . 2;\necho $y + strlen($z);\n?>', '10', '2026-02-10'),

(11, 'Java', 'public class Main {\n    public static void main(String[] args) {\n        int a = 4;\n        int b = a++ + ++a;\n        System.out.print(b);\n    }\n}', '10', '2026-02-11'),

(12, 'C#', 'using System;\n\nclass Program {\n    static void Main() {\n        int x = 3;\n        int y = x * x++;\n        Console.Write(y);\n    }\n}', '9', '2026-02-12'),

(13, 'Go', 'package main\nimport "fmt"\n\nfunc main() {\n    x := 2\n    for i := 0; i < 3; i++ {\n        x += i + x\n    }\n    fmt.Println(x)\n}', '22', '2026-02-13'),

(14, 'Python', 'nums = [1, 2, 3]\nresult = nums[0]\nnums[0] = nums[1]\nresult += nums[0]\nprint(result)', '3', '2026-02-14'),

(15, 'JavaScript', 'let str = "Hi";\nstr += 3 + 2;\nconsole.log(str);', 'Hi5', '2026-02-15'),

(16, 'Ruby', 'text = "Go"\n3.times { |i| text += (i+1).to_s }\nputs text', 'Go123', '2026-02-16'),

(17, 'C++', '#include <iostream>\nusing namespace std;\n\nint main() {\n    int a = 6;\n    int b = 2;\n    a += b++ * a;\n    cout << a;\n}', '18', '2026-02-17'),

(18, 'Java', 'public class Main {\n    public static void main(String[] args) {\n        String s = "3";\n        int x = Integer.parseInt(s) + s.length();\n        System.out.print(x);\n    }\n}', '4', '2026-02-18');

ALTER TABLE `codes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `date` (`date`);

ALTER TABLE `codes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

COMMIT;

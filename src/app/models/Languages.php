<?php

namespace Rafa\Dailycode\models;

class Languages
{
    public function getIconAndFormatting($language): array
    {
        return match ($language) {
            'Python' => ['icon' => 'python.png', 'formatting' => 'language-python'],
            'JavaScript' => ['icon' => 'javascript.png', 'formatting' => 'language-javascript'],
            'Ruby' => ['icon' => 'ruby.png', 'formatting' => 'language-ruby'],
            'Php' => ['icon' => 'php.png', 'formatting' => 'language-php'],
            'Java' => ['icon' => 'java.png', 'formatting' => 'language-java'],
            'Go' => ['icon' => 'go.png', 'formatting' => 'language-go'],
            'C#' => ['icon' => 'csharp.png', 'formatting' => 'language-csharp'],
            'C++' => ['icon' => 'cpp.png', 'formatting' => 'language-cpp']
        };
    }
}
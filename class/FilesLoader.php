<?php

require '/class/WordCountList/WordCountListArray.php';
require '/class/WordCountList/WordCountListTable.php';

class FilesLoader
{
    const UPPER_CASE_START = 65;
    const UPPER_CASE_END = 90;
    const LOWER_CASE_START = 97;
    const LOWER_CASE_END = 122;

    private $filenames = array();
    /**
     * @var WordCountList
     */
    private $wordCountList = null;

    public function __construct($rootDir)
    {
        $this->scanDir($rootDir);
        $this->wordCountList = new WordCountListTable();
    }

    /**
     * @param $char
     * @return boolean
     */
    private function isLetter($char)
    {
        if (1 !== strlen($char)) {
            trigger_error(sprintf('Input character must be a single character but given `%s`', $char));
        }
        $char = ord($char);
        if ($char >= self::UPPER_CASE_START && $char <= self::UPPER_CASE_END) {
            return true;
        } elseif ($char >= self::LOWER_CASE_START && $char <= self::LOWER_CASE_END) {
            return true;
        }
        return false;
    }

    private function scanDir($dir)
    {
        $files = scandir($dir);
        foreach ($files as $name) {
            if ('.' == substr($name, 0, 1)) {
                continue;
            }
            $filename = realpath($dir . DIRECTORY_SEPARATOR . $name);
            if (is_dir($filename)) {
                $this->scanDir($filename);
            }
            if (!is_file($filename)) {
                continue;
            }
            array_push($this->filenames, $filename);
        }
        return true;
    }

    /**
     * @return WordCountList
     */
    public function processFiles()
    {
        foreach ($this->filenames as $filename) {
            $this->processText(file_get_contents($filename));
        }
        return $this->wordCountList;
    }

    /**
     * @param string $text
     * @return array
     */
    private function processText($text)
    {
        $length = strlen($text);
        for ($i = 0; $i < $length;) {
            if ($this->isLetter($text[$i])) {
                $word = '';
                while ($i < $length && $this->isLetter($text[$i])) {
                    $word .= $text[$i];
                    $i++;
                }
                $this->wordCountList->addWord($word);
            } else {
                $i++;
                continue;
            }
        }
    }
}


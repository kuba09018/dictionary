<?php
set_include_path(get_include_path() . PATH_SEPARATOR . __DIR__ . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'Library' . DIRECTORY_SEPARATOR);
require './class/FilesLoader.php';
require_once 'Zend/Loader/Autoloader.php';
$AL = Zend_Loader_Autoloader::getInstance();
if ('cli' === PHP_SAPI) {
    echo "Processing files";
    $directory = new FilesLoader('C:\Users\Jakub\workspace\php\files');
    $wordsObj = $directory->processFiles();
} else {
    $wordsObj = new WordCountListTable();
    $words = $wordsObj->getWords();
}
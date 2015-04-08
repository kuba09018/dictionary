<?php

interface WordCountListInterface
{

    /**
     * @param $word
     */
    public function isWordExists($word);

    /**
     * @param string $word
     */
    public function addWord($word);

    /**
     * @return array
     */
    public function getWords();
}

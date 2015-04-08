<?php
require_once 'Interface.php';

class WordCountListArray implements WordCountListInterface
{

    /**
     * Multidmiensional array
     * each item contain array in structure:
     * array(
     *    'word' => string
     *    'count' => integer
     * )
     * @var $words array
     */
    private $words = array();

    /**
     * @param string $word
     * @return boolean
     */
    private function wordCounterIncrement($word)
    {
        foreach ($this->words as $key => $value) {
            if ($value['word'] == $word) {
                if ($word !== '' && $word !== ' ') {
                    $this->words[$key]['count']++;
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * @param string $word
     * @return boolean
     */
    public function isWordExists($word)
    {
        foreach ($this->words as $value) {
            if ($value['word'] == $word) {
                return true;
            }
        }
        return false;
    }

    /**
     * @param string $word
     */
    public function addWord($word)
    {
        if ($this->isWordExists($word)) {
            $this->wordCounterIncrement($word);
        } else {
            if ($word !== null || $word !== '') {
                array_push($this->words, array('word' => $word, 'count' => 1));
            } else {
                return false;
            }
        }
    }

    /**
     * @return array
     */
    public function getWords()
    {
        function mySort($b, $a)
        {
            return $a['count'] > $b['count'];
        }
        usort($this->words, 'mySort');
        return $this->words;
    }

}

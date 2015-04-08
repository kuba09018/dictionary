<?php
require_once 'Interface.php';

class WordCountListTable implements WordCountListInterface
{
    private $dbConfig = array(
        'host' => 'localhost',
        'username' => 'postgres',
        'password' => '123456',
        'dbname' => 'my_db'
    );
    private $db = null;

    public function __construct()
    {
        $this->db = Zend_Db::factory('PDO_PGSQL', $this->dbConfig);
    }

    /**
     * @param $word
     * @return bool
     */
    public function isWordExists($word)
    {
        $q = sprintf("SELECT COUNT(*) as count FROM dictionary.word WHERE name='%s'", $word);
        $result = $this->db->query($q)->fetch();
        return ((int)$result['count']) > 0 ? true : false;
    }

    public function addWord($word)
    {
        if (!$this->isWordExists($word)) {
            $q = sprintf("INSERT INTO dictionary.word (name) VALUES ('%s')", $word);
            $result = $this->db->query($q)->rowCount();
            return ($result !== 1) ? true : false;
        } else {
            $q = sprintf("UPDATE dictionary.word SET count=count+1 WHERE name='%s'", $word);
            $result = $this->db->query($q)->rowCount();
            return ($result !== 1) ? true : false;
        }
    }

    public function getWords()
    {
        return $this->db->select()->from('dictionary.word')->order('count DESC')->query()->fetchAll();
    }
}
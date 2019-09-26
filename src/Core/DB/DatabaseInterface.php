<?php
/**
 * Created by PhpStorm.
 * User: stagiaires
 * Date: 26/09/2019
 * Time: 08:30
 */

namespace Core\DB;
use \PDO;

interface DatabaseInterface{
    public function queryOne(string $sql, array $params);
    public function queryAll(string $sql,array $params);
    public function executeQuery(string $sql,array $params);
}
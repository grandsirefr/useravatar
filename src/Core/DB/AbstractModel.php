<?php

namespace Core\DB;

use Core\DB\Database;

// include_once 'Database.php';

abstract class AbstractModel {
	protected $db;

	public function __construct(Database $db) {
		$this->db = $db;
	}
}

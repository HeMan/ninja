<?php defined('SYSPATH') or die('No direct access allowed.');

class Database_Pdomysql_Driver extends Database_Pdogeneric_Driver {
	public function __construct($config)
	{
		parent::__construct($config);
		Kohana::log('debug', 'PDO Mysql driver initialized');
	}

	public function connect()
	{
		if (is_resource($this->link))
			return $this->link;

		extract($this->db_config['connection']);

		if (!isset($dsn) || !$dsn) {
			$dsn = 'mysql:';
			if (isset($host) && $host)
				$dsn .= 'host='.$host;
			elseif (isset($socket) && $socket)
				$dsn .= 'unix_socket='.$socket;
			else
				throw new Kohana_Database_Exception('database.error',
					"This driver (".__CLASS__.") requires either the host or the socket property to be set.");

			if (isset($database) && $database)
				$dsn .= ';dbname='.$database;
			else
				throw new Kohana_Database_Exception('database.error',
					"This driver (".__CLASS__.") requires the database property to be set.");
			if (isset($port) && $port)
				$dsn .= ';port='.$port;
		}
		$this->dsn = $dsn;
		try {
			$attr = array(PDO::ATTR_CASE => PDO::CASE_NATURAL,
						  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
						  PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => TRUE);

			$this->link = new PDO($this->dsn, $user, $pass,$attr);

			if($charset = $this->db_config['character_set'])
				$this->set_charset($charset);
		}
		catch (PDOException $e) {
			throw new Kohana_Database_Exception('database.error',
			                                    $e->getMessage());
		}

		// Clear password after successful connect
		$this->db_config['connection']['pass'] = NULL;

		return $this->link;
	}

	public function set_charset($charset)
	{
		$charset = str_replace('-','', $charset);
		$this->link->query('SET NAMES '.$this->escape_str($charset));
	}

	public function mylimit($sql, $limit, $offset = 0)
	{
		return $sql . ' LIMIT '.$offset.', '.$limit;
	}

	public function escape_str($str)
	{
		if ( ! $this->db_config['escape'])
			return $str;

		$quoted = false;
		if ($this->link)
			$quoted = $this->link->quote($str);
		# oci's quoter is unreliable, so keep fallback
		if ($quoted)
			return substr($quoted, 1, -1);
		else
			return str_replace("'", "''", $str);
	}

	public function list_tables(Database $db)
	{
		$sql = 'SHOW TABLES FROM '.$this->escape_table($this->db_config['connection']['database']);

		try {
			$res = $db->query($sql);
			$list = array();
			foreach ($res->result(FALSE) as $row) {
				$list[] = current($row);
			}

			unset($res);
			$tables = $list;
			return $tables;
		} catch (PDOException $e) {
			throw new Kohana_Database_Exception('database.error', $e->getMessage());
		}
	}
}

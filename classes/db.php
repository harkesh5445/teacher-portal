<?php

@define("ADD_SUCCESS", "1");
@define("UPDATE_SUCCESS", "1");
@define("DELETE_SUCCESS", "1");
@define( 'NO_RECORDS', 0 );
@define( 'DB_ERROR', 1 );

$conn = new dbConn(DBHOST,DBUSER,DBPASSWORD,DBNAME);

class dbConn {
	private $db;
	private $row;
	private $num_rows;
	private $rows_affected;

	private $error = '';

	public function __construct($host, $user, $pass, $db) {
		if ( !$this->db = mysqli_connect( $host, $user, $pass, $db ) ) {
			die( 'Could not connect: ' . mysqli_error( $this->db) );
		}
	}

	public function escape( $string ) {
		if($string){
			return mysqli_real_escape_string($this->db, $string);
		}

	}
	
    public function prepare($sql) {
        return mysqli_prepare($this->db, $sql);
    }
	
	public function query( $sql ) {
		if ( $result = mysqli_query( $this->db, $sql ) ) {
			if (stristr($sql,"select")) {
				$this->num_rows = mysqli_num_rows( $result );
			}
			$this->rows_affected = 0;
			return $result;
		} else {
			$this->error = mysqli_error( $this->db);
			return false;
		}
	}

	public function fetch( $result ) {
		if ( $row = @mysqli_fetch_assoc( $result ) )
			return $row;
		else
			return NO_RECORDS;
	}

	public function exec( $sql ) {
		if ( mysqli_query( $this->db, $sql ) ) {
			$this->rows_affected = mysqli_affected_rows($this->db);
			return SUCCESS;
		} else {
			$this->error = mysqli_error( $this->db);
			return false;
		}
	}

	public function num_rows() {
		return ( $this->num_rows );
	}

	public function rows_affected() {
		return ( $this->rows_affected );
	}

	public function & getQueryCount( $sql ) {
		if ( $result = mysqli_query( $this->db, $sql ) ) {
			$row = mysqli_fetch_row( $result );
			$this->num_rows = $row[0];
			return $this->num_rows;
		} else {
			$this->error = mysqli_error( $this->db);
			return NO_RECORDS;
		}
	}

	public function & insert_id() {
		$id = mysqli_insert_id($this->db);
		return $id ;
	}

	function error() {
		$error = ( $this->error ) ? $this->error : '';
		return $error;
	}

	public function cleanArray($arr) { 
		$cleaned = array();
		if(!empty($arr)) {
			$x = array();
			$x = $arr;
			foreach($x as $key=>$value) {
				if(is_array($value)) {
					$cleaned[$key] = $this->cleanArray($value);
				} else {
						$cleaned[$key] = @htmlspecialchars($value);
				}
			}
		}
		return $cleaned;
	}
	
		
	public function cleanTags($arr) { 
		$cleaned = array();
		if(!empty($arr)) {
			$x = array();
			$x = $arr;
			foreach($x as $key=>$value) {
				if(is_array($value)) {
					$cleaned[$key] = $this->cleanTags($value);
				} else {
					$cleaned[$key] = strip_tags($value);
				}
			}
		}
		return $cleaned;
	}

	public function beginTransaction() {
		mysqli_begin_transaction(  $this->db , MYSQLI_TRANS_START_READ_WRITE);
	}
	
	public function commitTransaction() {
		mysqli_commit($this->db);
	}


	public function create($table, $data) {
        $columns = implode(", ", array_keys($data));
        $values  = implode(", ", array_map([$this, 'quoteValue'], array_values($data)));

        $query = "INSERT INTO $table ($columns) VALUES ($values)";
        
        if (mysqli_query($this->db, $query)) {
            return mysqli_insert_id($this->db);
        } else {
            $this->error = 'Error: ' . mysqli_error($this->db);
            return false;
        }
    }

    public function update($table, $data, $where) {
        $set = [];
        foreach ($data as $column => $value) {
            $set[] = "$column = " . $this->quoteValue($value);
        }
        $set = implode(", ", $set);

        $query = "UPDATE $table SET $set WHERE $where";
        
        if (mysqli_query($this->db, $query)) {
            return mysqli_affected_rows($this->db);
        } else {
            $this->error = 'Error: ' . mysqli_error($this->db);
            return false;
        }
    }
	private function quoteValue($value) {
        return "'" . mysqli_real_escape_string($this->db, $value) . "'";
    }

    public function getError() {
        return $this->error;
    }

}
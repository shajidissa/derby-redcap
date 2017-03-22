<?php

/*****************************************************************************************
**  REDCap is only available through ACADMEMIC USER LICENSE with Vanderbilt University
******************************************************************************************/

/**
 * SQLTableCheck
 * This class provides methods for evaluating tables or parts of tables that are missing
 * from among REDCap's MySQL tables, and provides output to fix those tables.
 */
class SQLTableCheck
{

	// Constructor
	public function __construct()
	{
		// Make sure sql_mode isn't set to ANSI_QUOTES
		db_query("SET SQL_MODE=TRADITIONAL");
	}

	/**
	 * OBTAIN "CREATE TABLE" STATEMENT FOR ALL REDCAP TABLES
	 * Return array with table name as array key.
	 */
	public function get_create_table_for_all_tables()
	{
		$tables = array();
		// Get CREATE TABLE statement of all "redcap_" tables
		$sql = "show tables like 'redcap\_%'";
		$q = db_query($sql);
		while ($row = db_fetch_array($q)) {
			$q2 = db_query("show create table `{$row[0]}`");
			$row2 = db_fetch_assoc($q2);
			$tables[$row2['Table']] = $row2['Create Table'];
		}
		// Sort tables alphabetically for consistency
		ksort($tables);
		// Return tables
		return $tables;
	}


	/**
	 * BUILD ARRAY OF CURRENT TABLE STRUCTURE AND DO A DIFF OF IT WITH INSTALL.SQL AND INSTALL_DATA.SQL
	 */
	public function build_table_fixes()
	{
		## PARSE INSTALL.SQL
		// Obtain install.sql from Resources/sql/ directory
		$install_sql = file_get_contents(APP_PATH_DOCROOT . "Resources/sql/install.sql");
		// Replace all \r\n with just \n for compatibility
		$install_sql = str_replace("\r\n", "\n", $install_sql);
		// Obtain a version of install.sql from current table structure
		$this_install_sql = $this->build_install_file_from_tables();
		// Array for placing the table differences
		$diff_tables = $diff_fks = array();
		// Parse the install SQL files into an array with table attributes
		$install_tables = $this->parse_install_sql($install_sql);
		$this_install_tables = $this->parse_install_sql($this_install_sql);
		// Loop through install.sql array and note anything missing or different from it
		foreach ($install_tables as $table=>$attr) {
			// If table is missing
			if (!isset($this_install_tables[$table])) {
				$diff_tables[] = $attr['create_table'];
				if (isset($attr['create_table_fks']) && $attr['create_table_fks'] != '') {
					$diff_fks[] = $attr['create_table_fks'];
				}
				// Go to next loop since there's nothing else to do here
				continue;
			}
			// Check all fields
			if ($attr['fields'] !== $this_install_tables[$table]['fields']) {
				// Loop through fields
				$prev_field = null;
				foreach ($attr['fields'] as $field=>$line) {
					// If field is missing
					if (!isset($this_install_tables[$table]['fields'][$field])) {
						$diff_tables[] = "ALTER TABLE `$table` ADD $line" . ($prev_field == null ? "" : " AFTER $prev_field;");
					}
					// If field is different
					elseif ($line != $this_install_tables[$table]['fields'][$field]) {
						$diff_tables[] = "ALTER TABLE `$table` CHANGE `$field` $line;";
					}
					// Set for next loop
					$prev_field = $field;
				}
			}
			// Check primary key
			if ($attr['pk'] != $this_install_tables[$table]['pk']) {
				// If primary key is missing
				if ($this_install_tables[$table]['pk'] == '') {
					$diff_tables[] = "ALTER TABLE `$table` ADD {$attr['pk']};";
				}
				// If primary key is different
				else {
					$diff_tables[] = "ALTER TABLE `$table` DROP INDEX `PRIMARY`;";
					$diff_tables[] = "ALTER TABLE `$table` ADD {$attr['pk']};";
				}
			}
			// Check unique keys
			if ($attr['uks'] !== $this_install_tables[$table]['uks']) {
				// Loop through uks
				foreach ($attr['uks'] as $key=>$line) {
					// If key is missing
					if (!isset($this_install_tables[$table]['uks'][$key])) {
						// If key already exists as a normal key, then drop the key first
						if (isset($this_install_tables[$table]['keys'][$key])) {
							$diff_tables[] = "ALTER TABLE `$table` DROP INDEX `$key`;";
						}
						$diff_tables[] = "ALTER TABLE `$table` ADD $line;";
					}
					// If key is different
					elseif ($line != $this_install_tables[$table]['uks'][$key]) {
						$diff_tables[] = "ALTER TABLE `$table` DROP INDEX `$key`;";
						$diff_tables[] = "ALTER TABLE `$table` ADD $line;";
					}
				}
			}
			// Check keys
			if ($attr['keys'] !== $this_install_tables[$table]['keys']) {
				// Loop through uks
				foreach ($attr['keys'] as $key=>$line) {
					// If key is missing
					if (!isset($this_install_tables[$table]['keys'][$key])) {
						// If key already exists as a unique key, then drop the unique key first
						if (isset($this_install_tables[$table]['uks'][$key])) {
							$diff_tables[] = "ALTER TABLE `$table` DROP INDEX `$key`;";
						}
						$diff_tables[] = "ALTER TABLE `$table` ADD $line;";
					}
					// If key is different
					elseif ($line != $this_install_tables[$table]['keys'][$key]) {
						$diff_tables[] = "ALTER TABLE `$table` DROP INDEX `$key`;";
						$diff_tables[] = "ALTER TABLE `$table` ADD $line;";
					}
				}
			}
			// Check foreign keys
			if ($attr['fks'] !== $this_install_tables[$table]['fks']) {
				// Loop through uks
				foreach ($attr['fks'] as $key=>$line) {
					// If key is missing
					if (!isset($this_install_tables[$table]['fks'][$key])) {
						$diff_fks[] = "ALTER TABLE `$table` ADD $line;";
					}
					// If key is different
					elseif ($line != $this_install_tables[$table]['fks'][$key]) {
						$diff_fks[] = "ALTER TABLE `$table` DROP FOREIGN KEY `$key`;";
						$diff_fks[] = "ALTER TABLE `$table` ADD $line;";
					}
				}
			}
		}

		## PARSE INSTALL_DATA.SQL
		// Now obtain SQL for any missing rows for tables in install_data.sql
		$install_data_sql_fixes = $this->parse_install_data_sql();

		// Merge all SQL together and return as SQL
		$sql = trim(implode("\n", array_merge($diff_tables, $diff_fks, $install_data_sql_fixes)));
		return $sql;
	}


	/**
	 * PARSE "INSERT" STATEMENTS IN INSTALL_DATA.SQL AND PLACE PIECES INTO ARRAY FOR COMPARISON WITH CURRENT ROWS
	 * The table name will be the array key
	 */
	private function parse_install_data_sql()
	{
		// Obtain install_data.sql from Resources/sql/ directory
		$install_data_sql = file_get_contents(APP_PATH_DOCROOT . "Resources/sql/install_data.sql");
		// Replace all \r\n with just \n for compatibility
		$install_data_sql = str_replace("\r\n", "\n", $install_data_sql);
		// Set table name that we're currently on
		$current_table = null;
		// Set insert statement prefix for this table
		$current_table_insert = null;
		// Array that holds table attributes
		$tables = array();
		// Array that holds SQL fixes
		$sql_fixes = array();
		// Loop through file line by line to parse it into an array
		foreach (explode("\n", $install_data_sql) as $line) {
			// Trim it
			$line = trim($line);
			// If blank or a comment, then ignore
			if ($line == '' || substr($line, 0, 3) == '-- ') continue;
			// If first line of table (insert into), then capture table name
			if (strtolower(substr($line, 0, 12)) == 'insert into ') {
				// Get table name
				$current_table = trim(str_replace("`", "", substr($line, 12, strpos($line, " ", 12)-12)));
				// Get insert table prefix
				$tables[$current_table]['insert'] = $line;
				// Detect first field in "insert into" line
				$pos_first_paren = strpos($line, "(")+1;
				$first_field = trim(str_replace("`", "", substr($line, $pos_first_paren, strpos($line, ",")-$pos_first_paren)));
				// Get fields in current table in database
				$tables[$current_table]['fields_current'] = $this->get_current_table_fields($current_table, $first_field);
			}
			// Secondary table line (data row)
			elseif (substr($line, 0, 1) == '(') {
				//$tables[$current_table] = array();
				// Get the value of the first field in the "values" part of the query
				$value = trim(str_replace("'", "", substr($line, 1, strpos($line, ",")-1)));
				// If value does not exist in fields_current, then add to fields_missing
				if (!in_array($value, $tables[$current_table]['fields_current'])) {
					// Remove comma and semi-colon on the end
					if (substr($line, -1) == ',' || substr($line, -1) == ';') {
						$line = substr($line, 0, -1);
					}
					// Add to fixes array
					$sql_fixes[] = $tables[$current_table]['insert'] . " $line;";
				}
			} else {
				// Unknown
				continue;
			}
		}
		// Return string of SQL fix statements
		return $sql_fixes;
	}


	/**
	 * RETURN ARRAY OF FIELDS IN DESIRED COLUMN OF DESIRED TABLE
	 */
	private function get_current_table_fields($current_table, $field_name)
	{
		$fields = array();
		$sql = "select $field_name from $current_table";
		$q = db_query($sql);
		while ($row = db_fetch_assoc($q)) {
			$fields[] = $row[$field_name];
		}
		return $fields;
	}


	/**
	 * PARSE "CREATE TABLE" STATEMENT AND PLACE PIECES INTO ARRAY
	 * The table name will be the array key with sub-array keys "fields", "pk", "uks", "fks", and "keys"
	 */
	private function parse_install_sql($install_sql)
	{
		// Set table name that we're currently on
		$current_table = null;
		// Array that holds table attributes
		$tables = array();
		// Capture the full "create table" and "alter table" statements to keep in case we need the whole thing
		$create_table = $alter_table = null;
		// Some syntax is not capitalized in earlier versions of MySQL, so replace with capitalized versions
		$orig_syntax = array(' auto_increment', ' default ', ' collate ', ' character set ');
		$repl_syntax = array();
		foreach ($orig_syntax as $i) $repl_syntax[] = strtoupper($i);
		// Loop through file line by line to parse it into an array
		foreach (explode("\n", $install_sql) as $line) {
			// If blank, then ignore
			if ($line == '') continue;
			// Check if we're beginning a new table with CREATE TABLE
			if (substr($line, 0, 13) == 'CREATE TABLE ') {
				$create_table = "$line\n";
				$current_table = trim(str_replace('`', '', substr($line, 13, -2)));
				$tables[$current_table] = array("fields"=>array(), "pk"=>'', "uks"=>array(), "keys"=>array(), "fks"=>array(),
												"create_table"=>"", "create_table_fks"=>"");
			}
			// Check if we're beginning a new FK with ALTER TABLE
			elseif (substr($line, 0, 12) == 'ALTER TABLE ') {
				$alter_table = "$line\n";
				$current_table = trim(str_replace('`', '', substr($line, 12)));
			}
			// If a foreign key
			elseif (substr($line, 0, 16) == 'ADD FOREIGN KEY ') {
				$alter_table .= "$line\n";
				if (substr($line, -1) == ';') {
					$tables[$current_table]['create_table_fks'] = trim($alter_table);
				}
				$key_name = trim(str_replace("`", "", substr($line, 17, strpos($line, "`", 19)-17)));
				$line = substr($line, 4, -1);
				$tables[$current_table]['fks'][$key_name] = $line;
			}
			// If a primary key
			elseif (substr($line, 0, 12) == 'PRIMARY KEY ') {
				// Some versions of MySQL might put 2 spaces after "key", so remove the extra space
				$line = str_replace('PRIMARY KEY  ', 'PRIMARY KEY ', $line);
				// Add line
				$create_table .= "$line\n";
				if (substr($line, -1) == ',') $line = substr($line, 0, -1);
				$tables[$current_table]['pk'] = $line;
			}
			// If a unique key
			elseif (substr($line, 0, 11) == 'UNIQUE KEY ') {
				$create_table .= "$line\n";
				$key_name = trim(str_replace("`", "", substr($line, 11, strpos($line, " ", 11)-11)));
				if (substr($line, -1) == ',') $line = substr($line, 0, -1);
				$tables[$current_table]['uks'][$key_name] = $line;
			}
			// If a normal index
			elseif (substr($line, 0, 4) == 'KEY ') {
				$create_table .= "$line\n";
				$key_name = trim(str_replace("`", "", substr($line, 4, strpos($line, " ", 4)-4)));
				if (substr($line, -1) == ',') $line = substr($line, 0, -1);
				$tables[$current_table]['keys'][$key_name] = $line;
			}
			// Last line of "create table"
			elseif (substr($line, 0, 2) == ') ') {
				$create_table .= $line;
				$tables[$current_table]['create_table'] = $create_table;
			}
			// Table field
			else {
				// Some syntax is not capitalized in earlier versions of MySQL, so replace with capitalized versions
				$line = str_replace($orig_syntax, $repl_syntax, $line);
				// Add line
				$create_table .= "$line\n";
				$field_name = trim(str_replace("`", "", substr($line, 0, strpos($line, "`", 2))));
				if (substr($line, -1) == ',') $line = substr($line, 0, -1);
				$tables[$current_table]['fields'][$field_name] = $line;
			}
		}
		// Return array of table attributes
		return $tables;
	}


	/**
	 * GET "CREATE TABLE" STATEMENT AND SEPARATE FOREIGN KEY ALTER TABLES FROM IT
	 */
	private function split_create_table_fks($table_name, $create_table_statement)
	{
		// Make sure all line breaks are \n and not \r
		$create_table_statement = str_replace(array("\r\n", "\r", "\n\n"), array("\n", "\n", "\n"), trim($create_table_statement));
		// Remove auto_increment number
		if (stripos($create_table_statement, "auto_increment")) {
			$create_table_statement = preg_replace("/(\s+)(AUTO_INCREMENT)(\s*)(=)(\s*)(\d+)(\s+)/", " ", $create_table_statement);
		}
		// Place all SQL into strings, segregating create table statements and foreign key statements
		$create_table = $foreign_keys = $primary_key = $unique_keys = "";
		$foreign_key_array = $unique_key_array = $key_array = array();
		// Separate statement into separate lines
		$create_array = explode("\n", $create_table_statement);
		//print_array($create_array);
		// Check each line
		foreach ($create_array as $line)
		{
			// Trim the line
			$line = trim($line);
			// If a foreign key
			if (substr($line, 0, 11) == 'CONSTRAINT ') {
				// Format the line
				$fkword_pos = strpos($line, "FOREIGN KEY ");
				$fkline = trim(substr($line, $fkword_pos));
				if (substr($fkline, -1) == ',') $fkline = substr($fkline, 0, -1);
				$fkline = "ADD ".$fkline;
				// Isolate the field names
				$first_paren_pos = strpos($fkline, "(")+1;
				$fk_field = trim(str_replace("`", "", substr($fkline, $first_paren_pos, strpos($fkline, ")")-$first_paren_pos)));
				// Add FK line to FK array
				$foreign_key_array[$fk_field] = $fkline;
			}
			// If a primary key
			elseif (substr($line, 0, 12) == 'PRIMARY KEY ') {
				$primary_key = $line;
			}
			// If a unique key
			elseif (substr($line, 0, 11) == 'UNIQUE KEY ') {
				$key_name = trim(str_replace("`", "", substr($line, 11, strpos($line, " ", 11)-11)));
				if (substr($line, -1) == ',') $line = substr($line, 0, -1);
				$unique_key_array[$key_name] = $line;
			}
			// If a normal index
			elseif (substr($line, 0, 4) == 'KEY ') {
				$key_name = trim(str_replace("`", "", substr($line, 4, strpos($line, " ", 4)-4)));
				if (substr($line, -1) == ',') $line = substr($line, 0, -1);
				$key_array[$key_name] = $line;
			}
			// Table field
			else {
				$create_table .= "\n$line";
			}
		}
		// Format strings
		$create_table = $this->remove_comma_from_create_table(trim($create_table).";");
		// Insert primary key into create_table statement above the last line
		if ($primary_key != '') {
			$last_line_break_pos = strrpos($create_table, "\n");
			$create_table = substr($create_table, 0, $last_line_break_pos) . ",\n$primary_key" . substr($create_table, $last_line_break_pos);
			$create_table = $this->remove_comma_from_create_table($create_table);
		}
		// Sort the UKs for consistency from install to install and insert into create table statement
		if (!empty($unique_key_array)) {
			ksort($unique_key_array);
			$last_line_break_pos = strrpos($create_table, "\n");
			$create_table = substr($create_table, 0, $last_line_break_pos) . ",\n" . implode(",\n", $unique_key_array) . substr($create_table, $last_line_break_pos);
			$create_table = $this->remove_comma_from_create_table($create_table);
		}
		// Sort the keys for consistency from install to install and insert into create table statement
		if (!empty($key_array)) {
			ksort($key_array);
			$last_line_break_pos = strrpos($create_table, "\n");
			$create_table = substr($create_table, 0, $last_line_break_pos) . ",\n" . implode(",\n", $key_array) . substr($create_table, $last_line_break_pos);
			$create_table = $this->remove_comma_from_create_table($create_table);
		}
		// Sort the FKs for consistency from install to install
		if (!empty($foreign_key_array)) {
			ksort($foreign_key_array);
			$foreign_keys = "ALTER TABLE `$table_name`\n".implode(",\n", $foreign_key_array).";";
		}
		// Return the strings
		return array($create_table, $foreign_keys);
	}


	/**
	 * REMOVE COMMA FROM END OF SECOND-TO-LAST LINE OF "CREATE TABLE" STATEMENT
	 */
	private function remove_comma_from_create_table($create_table)
	{
		$create_array = explode("\n", $create_table);
		$second_to_last_key = count($create_array)-2;
		if (substr($create_array[$second_to_last_key], -1) == ',') {
			$create_array[$second_to_last_key] = substr($create_array[$second_to_last_key], 0, -1);
			$create_table = implode("\n", $create_array);
		}
		return $create_table;
	}


	/**
	 * BUILD INSTALL.SQL FILE FROM "SHOW CREATE TABLE" OF ALL REDCAP TABLES
	 */
	public function build_install_file_from_tables()
	{
		// Place all SQL into strings, segregating create table statements and foreign key statements
		$create_table = $foreign_keys = array();
		// Get create table statement for all tables
		$tables = $this->get_create_table_for_all_tables();
		// Loop through each table and get CREATE TABLE sql
		foreach ($tables as $table=>$create_table_sql) {
			// Get CREATE TABLE statement with separate FK piece
			$this_create_table = $this->split_create_table_fks($table, $create_table_sql);
			// Add SQL to arrays
			$create_table[] = $this_create_table[0];
			if ($this_create_table[1] != '') {
				$foreign_keys[] = $this_create_table[1];
			}
		}
		// Build SQL file
		$sql = implode("\n\n", $create_table) . "\n\n" . implode("\n\n", $foreign_keys);
		// Replace all \r\n with just \n for compatibility
		$sql = str_replace("\r\n", "\n", $sql);
		// Return SQL
		return trim($sql);
	}


	/**
	 * DETECT IF INNODB ENGINE IS ENABLED IN MYSQL. Return boolean.
	 */
	public function innodb_enabled()
	{
		$q = db_query("SHOW ENGINES");
		while ($row = db_fetch_assoc($q)) {
			if ($row['Engine'] == 'InnoDB') {
				return (strtoupper($row['Support']) != 'NO');
			}
		}
		return false;
	}
}
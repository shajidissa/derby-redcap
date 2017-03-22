<?php

/**
 * SESSION HANDLING: DATABASE SESSION STORAGE
 * Adjust PHP session configuration to store sessions in database instead of as file on web server
 */
class Session
{
	public static function start($savePath, $sessionName)
	{
		return true;
	}

	public static function end()
	{
		return true;
	}

	public static function read($key)
	{
		// Force session_id to only have 32 characters (for compatibility issues)
		$key = prep(substr($key, 0, 32));

		$sql = "SELECT session_data FROM redcap_sessions WHERE session_id = '$key' AND session_expiration > '" . NOW . "'";
		$sth = db_query($sql);
		return ($sth ? (string)db_result($sth, 0) : $sth);
	}

	public static function write($key, $val)
	{
		// Force session_id to only have 32 characters (for compatibility issues)
		$key = prep(substr($key, 0, 32));
		$val = prep($val);

		if (session_name() == "survey") {
			// For surveys, set expiration time as 1 day (i.e. arbitrary long time)
			$expiration = date("Y-m-d H:i:s", mktime(date("H"),date("i"),date("s"),date("m"),date("d")+1,date("Y")));
		} else {
			// For non-survey pages (all else), set expiration time using value defined on System Config page
			global $autologout_timer;
			$expiration = date("Y-m-d H:i:s", mktime(date("H"),date("i")+$autologout_timer,date("s"),date("m"),date("d"),date("Y")));
		}

		$sql = "REPLACE INTO redcap_sessions (session_id, session_data, session_expiration) VALUES ('$key', '$val', '$expiration')";
		return (db_query($sql) !== false);
	}

	public static function destroy($key)
	{
		// Force session_id to only have 32 characters (for compatibility issues)
		$key = substr($key, 0, 32);

		$sql = "DELETE FROM redcap_sessions WHERE session_id = '$key'";
		return (db_query($sql) !== false);
	}

	public static function gc($max_lifetime)
	{
		// Delete all sessions more than 1 day old, which is the session expiration time used by surveys (ignore the system setting $max_lifetime)
		$max_session_time = date("Y-m-d H:i:s", mktime(date("H"),date("i"),date("s"),date("m"),date("d")-1,date("Y")));

		$sql = "DELETE FROM redcap_sessions WHERE session_expiration < '$max_session_time'";
		return (db_query($sql) !== false);
	}
	
	public static function writeClose()
	{
		session_write_close();
	}
	
	// Initialize the PHP session for survey pages (they are different from typical REDCap sessions)
	public static function initSurveySession()
	{
		// Begin a session for saving response data as participant moves from page to page
		session_name("survey"); // Give survey pages a different session name to separate it from regular REDCap user's session
		if (!session_id()) @session_start();
	}
}

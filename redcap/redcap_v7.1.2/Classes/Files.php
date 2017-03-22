<?php
/*****************************************************************************************
**  REDCap is only available through a license agreement with Vanderbilt University
******************************************************************************************/


/**
 * FILES Class
 * Contains methods used with regard to uploaded files
 */
class Files
{
	/**
	 * DETERMINE IF WE'RE ON A VERSION OF PHP THAT SUPPORTS ZIPARCHIVE (PHP 5.2.0)
	 * Returns boolean.
	 */
	public static function hasZipArchive()
	{
		return (class_exists('ZipArchive'));
	}


	/**
	 * DETERMINE IF PROJECT HAS ANY "FILE UPLOAD" FIELDS IN METADATA
	 * Returns boolean.
	 */
	public static function hasFileUploadFields()
	{
		global $Proj;
		return $Proj->hasFileUploadFields;
	}


	/**
	 * CALCULATE SERVER SPACE USAGE OF FILES UPLOADED
	 * Returns usage in bytes
	 */
	public static function getEdocSpaceUsage()
	{
		// Default
		$total_edoc_space_used = 0;
		// Get space used by edoc file uploading on data entry forms. Count using table values (since we cannot easily call external server itself).
		$sql = "select if(sum(doc_size) is null, 0, sum(doc_size)) from redcap_edocs_metadata where date_deleted_server is null";
		$total_edoc_space_used += db_result(db_query($sql), 0);
		// Additionally, get space used by send-it files (for location=1 only, because loc=3 is edocs duplication). Count using table values (since we cannot easily call external server itself).
		$sql = "select if(sum(doc_size) is null, 0, sum(doc_size)) from redcap_sendit_docs
				where location = 1 and expire_date > '".NOW."' and date_deleted is null";
		$total_edoc_space_used += db_result(db_query($sql), 0);
		// Return total
		return $total_edoc_space_used;
	}


	/**
	 * RETURN THE CONTENTS AS A STRING OF AN EDOC FILE FROM EDOC STORAGE LOCATION
	 * Returns array of "mime_type" (string), "doc_name" (string), and "contents" (string) or FALSE if failed
	 */
	public static function getEdocContentsAttributes($edoc_id)
	{
		global $lang, $edoc_storage_option, $amazon_s3_key, $amazon_s3_secret, $amazon_s3_bucket;

		if (!is_numeric($edoc_id)) return false;

		// Download file from the "edocs" web server directory
		$sql = "select * from redcap_edocs_metadata where doc_id = ".prep($edoc_id);
		$q = db_query($sql);
		if (!db_num_rows($q)) return false;
		$this_file = db_fetch_assoc($q);

		if ($edoc_storage_option == '0' || $edoc_storage_option == '3') {
			//Download from "edocs" folder (use default or custom path for storage)
			$local_file = EDOC_PATH . $this_file['stored_name'];
			if (file_exists($local_file) && is_file($local_file)) {
				return array($this_file['mime_type'], $this_file['doc_name'], file_get_contents($local_file));
			}
		} elseif ($edoc_storage_option == '2') {
			// S3
			$s3 = new S3($amazon_s3_key, $amazon_s3_secret, SSL);
			if (isset($GLOBALS['amazon_s3_endpoint']) && $GLOBALS['amazon_s3_endpoint'] != '') $s3->setEndpoint($GLOBALS['amazon_s3_endpoint']);
			if ($object = $s3->getObject($amazon_s3_bucket, $this_file['stored_name'])) {
				return array($this_file['mime_type'], $this_file['doc_name'], $object->body);
			}
		} else {
			//  WebDAV
			include APP_PATH_WEBTOOLS . 'webdav/webdav_connection.php';
			$wdc = new WebdavClient();
			$wdc->set_server($webdav_hostname);
			$wdc->set_port($webdav_port); $wdc->set_ssl($webdav_ssl);
			$wdc->set_user($webdav_username);
			$wdc->set_pass($webdav_password);
			$wdc->set_protocol(1); //use HTTP/1.1
			$wdc->set_debug(false);
			if (!$wdc->open()) {
				return false;
			}
			if (substr($webdav_path,-1) != '/') {
				$webdav_path .= '/';
			}
			$http_status = $wdc->get($webdav_path . $this_file['stored_name'], $contents); //$contents is produced by webdav class
			$wdc->close();
			return array($this_file['mime_type'], $this_file['doc_name'], $contents);
		}
	}


	/**
	 * MOVES FILE FROM EDOC STORAGE LOCATION TO REDCAP'S TEMP DIRECTORY
	 * Returns full file path in temp directory, or FALSE if failed to move it to temp.
	 */
	public static function copyEdocToTemp($edoc_id, $prependHashToFilename=false, $prependTimestampToFilename=false)
	{
		global $edoc_storage_option, $amazon_s3_key, $amazon_s3_secret, $amazon_s3_bucket;

		if (!is_numeric($edoc_id)) return false;

		// Get filenames from edoc_id
		$q = db_query("select doc_name, stored_name from redcap_edocs_metadata where delete_date is null and doc_id = ".prep($edoc_id));
		if (!db_num_rows($q)) return false;
		$edoc_orig_filename = db_result($q, 0, 'doc_name');
		$stored_filename = db_result($q, 0, 'stored_name');

		// Set full file path in temp directory. Replace any spaces with underscores for compatibility.		
		$filename_tmp = APP_PATH_TEMP
					  . ($prependTimestampToFilename ? date('YmdHis') . "_" : '')
					  . ($prependHashToFilename ? substr(md5(rand()), 0, 8) . '_' : '')
					  . str_replace(" ", "_", $edoc_orig_filename);

		if ($edoc_storage_option == '0' || $edoc_storage_option == '3') {
			// LOCAL
			if (file_put_contents($filename_tmp, file_get_contents(EDOC_PATH . $stored_filename))) {
				return $filename_tmp;
			}
			return false;
		} elseif ($edoc_storage_option == '2') {
			// S3
			$s3 = new S3($amazon_s3_key, $amazon_s3_secret, SSL); if (isset($GLOBALS['amazon_s3_endpoint']) && $GLOBALS['amazon_s3_endpoint'] != '') $s3->setEndpoint($GLOBALS['amazon_s3_endpoint']);
			if (($object = $s3->getObject($amazon_s3_bucket, $stored_filename, $filename_tmp)) !== false) {
				return $filename_tmp;
			}
			return false;
		} else {
			//  WebDAV
			include APP_PATH_WEBTOOLS . 'webdav/webdav_connection.php';
			$wdc = new WebdavClient();
			$wdc->set_server($webdav_hostname);
			$wdc->set_port($webdav_port); $wdc->set_ssl($webdav_ssl);
			$wdc->set_user($webdav_username);
			$wdc->set_pass($webdav_password);
			$wdc->set_protocol(1); //use HTTP/1.1
			$wdc->set_debug(false);
			if (!$wdc->open()) {
				sleep(1);
				return false;
			}
			if (substr($webdav_path,-1) != '/') {
				$webdav_path .= '/';
			}
			$http_status = $wdc->get($webdav_path . $stored_filename, $contents); //$contents is produced by webdav class
			$wdc->close();
			if (file_put_contents($filename_tmp, $contents)) {
				return $filename_tmp;
			}
			return false;
		}
		return false;
	}


	/**
	 * DETERMINE IF PROJECT HAS AT LEAST ONE FILE ALREADY UPLOADED FOR A "FILE UPLOAD" FIELD
	 * Returns boolean.
	 */
	public static function hasUploadedFiles()
	{
		global $user_rights;
		// If has no file upload fields, then return false
		if (!self::hasFileUploadFields()) return false;
		// If user is in a DAG, limit to only records in their DAG
		$group_sql = "";
		if ($user_rights['group_id'] != "") {
			$group_sql  = "and d.record in (" . pre_query("select record from redcap_data where project_id = ".PROJECT_ID."
						  and field_name = '__GROUPID__' and value = '" . $user_rights['group_id'] . "'") . ")";
		}
		// Check if there exists at least one uploaded file
		$sql = "select 1 from redcap_data d, redcap_metadata m where m.project_id = ".PROJECT_ID."
				and m.project_id = d.project_id and d.field_name = m.field_name $group_sql
				and m.element_type = 'file' and d.value != '' limit 1";
		$q = db_query($sql);
		// Return true if one exists
		return (db_num_rows($q) > 0);
	}


	/**
	 * RETURN HASH OF DOC_ID FOR A FILE IN THE EDOCS_METADATA TABLE
	 * This is used for verifying files, especially when uploaded when the record does not exist yet.
	 * Also to protect from people randomly discovering other people's uploaded files by modifying the URL.
	 */
	public static function docIdHash($doc_id)
	{
		global $salt, $__SALT__;
		return sha1($salt . $doc_id . (isset($__SALT__) ? $__SALT__ : ""));
	}


	/**
	 * REPLACE SINGLE LINE IN FILE USING LINE NUMBER
	 * Using very little memory, replaces given line number in file with $replacement_string.
	 * Assumes \n for line break characters.
	 */
	function replaceLineInFile($file, $replacement_string, $line_to_replace)
	{
		if ($line_to_replace < 1) return false;

		// Get contents of the given line
		$fileSearch = new SplFileObject($file);
		$fileSearch->seek($line_to_replace-1); // this is zero based so need to subtract 1
		$lineContents = $fileSearch->current();
		if ($lineContents == "") return false;

		// Get positions
		$linePosEnd = $fileSearch->ftell();
		$lineLength = strlen($lineContents);
		$linePosBegin = $linePosEnd - $lineLength;
		$fileSearch = null; // Close the file object

		// Append new line character to replacement string
		$replacement_string .= "\n";

		// Copy file's contents to temp file in memory (uses very little memory)
		$fpFile = fopen($file, "rw+");
		$fpTemp = fopen('php://temp', "rw+");
		stream_copy_to_stream($fpFile, $fpTemp);

		// Move file's to the position
		fseek($fpFile, $linePosBegin);
		fseek($fpTemp, $linePosEnd);
		// Add the new line to the file
		fwrite($fpFile, $replacement_string);
		// The file ends up with extra stuff appended to the end, so truncate it (need to get file size first)
		$filestat = fstat($fpFile);
		ftruncate($fpFile, $filestat['size'] - $lineLength + strlen($replacement_string));

		// Replace original file with original's with replaced line
		stream_copy_to_stream($fpTemp, $fpFile);

		// Close files
		fclose($fpFile);
		fclose($fpTemp);

		// Return true
		return true;
	}


	/**
	 * REMOVE LINES IN FILE USING LINE NUMBER
	 * Using very little memory, removes specified lines in file with $replacement_string.
	 * Assumes \n for line break characters. Assumes line 1 is the first line of file.
	 */
	function removeLinesInFile($file, $begin_line_num, $num_lines_remove)
	{
		if ($num_lines_remove < 1) return false;

		// Get contents of the given line
		$fileSearch = new SplFileObject($file);
		$fpTemp = fopen('php://temp', "w+");
		// Loop through file to move designated lines to temp file
		for ($line_num = $begin_line_num; $line_num <= ($begin_line_num + $num_lines_remove - 1); $line_num++) {
			$fileSearch->seek($line_num-1); // this is zero based so need to subtract 1
			// Add this line to temp file
			fwrite($fpTemp, $fileSearch->current());
			// If we're at the end of the file, then stop here
			if ($fileSearch->eof()) break;
		}
		$fileSearch = null;
		// Copy temp file's contents to original file in memory (uses very little memory)
		$fpFile = fopen($file, "w+");
		ftruncate($fpFile, 0);
		fseek($fpTemp, 0);
		stream_copy_to_stream($fpTemp, $fpFile);
		// Close files
		fclose($fpFile);
		fclose($fpTemp);
		// Return true
		return true;
	}


	/**
	 * UPLOAD FILE INTO EDOCS FOLDER (OR OTHER SERVER VIA WEBDAV) AND RETURN EDOC_ID# (OR "0" IF FAILED)
	 * Determine if file uploaded as normal FILE input field or as base64 data image via POST, in which $base64data will not be null.
	 */
	public static function uploadFile($file)
	{
		global $edoc_storage_option;

		// Get basic file values
		$doc_name  = str_replace("'", "", html_entity_decode(stripslashes( $file['name']), ENT_QUOTES));
		$mime_type = $file['type'];
		$doc_size  = $file['size'];
		$tmp_name  = $file['tmp_name'];

		// Default result of success
		$result = 0;
		$file_extension = getFileExt($doc_name);
		$stored_name = date('YmdHis') . "_pid" . PROJECT_ID . "_" . generateRandomHash(6) . getFileExt($doc_name, true);

		if ($edoc_storage_option == '0' || $edoc_storage_option == '3') {
			// LOCAL: Upload to "edocs" folder (use default or custom path for storage)
			if (@move_uploaded_file($tmp_name, EDOC_PATH . $stored_name)) {
				$result = 1;
			}
			if ($result == 0 && @rename($tmp_name, EDOC_PATH . $stored_name)) {
				$result = 1;
			}
			if ($result == 0 && file_put_contents(EDOC_PATH . $stored_name, file_get_contents($tmp_name))) {
				$result = 1;
				unlink($tmp_name);
			}

		} elseif ($edoc_storage_option == '2') {
			// S3
			global $amazon_s3_key, $amazon_s3_secret, $amazon_s3_bucket;
			$s3 = new S3($amazon_s3_key, $amazon_s3_secret, SSL); if (isset($GLOBALS['amazon_s3_endpoint']) && $GLOBALS['amazon_s3_endpoint'] != '') $s3->setEndpoint($GLOBALS['amazon_s3_endpoint']);
			if ($s3->putObjectFile($tmp_name, $amazon_s3_bucket, $stored_name, S3::ACL_PUBLIC_READ_WRITE)) {
				$result = 1;
			}

		} else {

			// WebDAV
			require (APP_PATH_WEBTOOLS . 'webdav/webdav_connection.php');
			$wdc = new WebdavClient();
			$wdc->set_server($webdav_hostname);
			$wdc->set_port($webdav_port); $wdc->set_ssl($webdav_ssl);
			$wdc->set_user($webdav_username);
			$wdc->set_pass($webdav_password);
			$wdc->set_protocol(1); // use HTTP/1.1
			$wdc->set_debug(false); // enable debugging?
			if (!$wdc->open()) {
				sleep(1);
				return 0;
			}
			if (substr($webdav_path,-1) != '/') {
				$webdav_path .= '/';
			}
			if ($doc_size > 0) {
				$fp      = fopen($tmp_name, 'rb');
				$content = fread($fp, filesize($tmp_name));
				fclose($fp);
				if (function_exists('get_magic_quotes_gpc') && get_magic_quotes_gpc()) {
					$doc_name = stripslashes($doc_name);
				}
				$target_path = $webdav_path . $stored_name;
				$http_status = $wdc->put($target_path,$content);
				$result = 1;
			}
			$wdc->close();
		}

		// Return doc_id (return "0" if failed)
		if ($result == 0) {
			// For base64 data images stored in temp directory, remove them when done
			if ($base64data != null) unlink($tmp_name);
			// Return error
			return 0;
		} else {
			// Add file info the redcap_edocs_metadata table for retrieval later
			$q = db_query("INSERT INTO redcap_edocs_metadata (stored_name, mime_type, doc_name, doc_size, file_extension, project_id, stored_date)
						  VALUES ('" . prep($stored_name) . "', '" . prep($mime_type) . "', '" . prep($doc_name) . "',
						  '" . prep($doc_size) . "', '" . prep($file_extension) . "',
						  " . (defined("PROJECT_ID") ? PROJECT_ID : "null") . ", '".NOW."')");
			return (!$q ? 0 : db_insert_id());
		}

	}


	// Return array of mime types
    public static function get_mime_types()
	{
        return array(
            'txt' => 'text/plain',
            'htm' => 'text/html',
            'html' => 'text/html',
            'php' => 'text/html',
            'css' => 'text/css',
            'js' => 'application/javascript',
            'json' => 'application/json',
            'xml' => 'application/xml',
            'swf' => 'application/x-shockwave-flash',
            'flv' => 'video/x-flv',
            // images
            'png' => 'image/png',
            'jpe' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'jpg' => 'image/jpeg',
            'gif' => 'image/gif',
            'bmp' => 'image/bmp',
            'ico' => 'image/vnd.microsoft.icon',
            'tiff' => 'image/tiff',
            'tif' => 'image/tiff',
            'svg' => 'image/svg+xml',
            'svgz' => 'image/svg+xml',
            // archives
            'zip' => 'application/zip',
            'rar' => 'application/x-rar-compressed',
            'exe' => 'application/x-msdownload',
            'msi' => 'application/x-msdownload',
            'cab' => 'application/vnd.ms-cab-compressed',
            // audio/video
            'mp3' => 'audio/mpeg',
            'qt' => 'video/quicktime',
            'mov' => 'video/quicktime',
            // adobe
            'pdf' => 'application/pdf',
            'psd' => 'image/vnd.adobe.photoshop',
            'ai' => 'application/postscript',
            'eps' => 'application/postscript',
            'ps' => 'application/postscript',
            // ms office
            'rtf' => 'application/rtf',
            'doc' => 'application/msword',
            'xls' => 'application/vnd.ms-excel',
            'ppt' => 'application/vnd.ms-powerpoint',
            'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'pptx' => 'application/vnd.openxmlformats-officedocument.presentationml.presentation',
            // open office
            'odt' => 'application/vnd.oasis.opendocument.text',
            'ods' => 'application/vnd.oasis.opendocument.spreadsheet',
        );
	}


	// Determine the file extension based on the Mime Type passed.
	// Return false if not found
    public static function get_file_extension_by_mime_type($mimetype)
	{
		$mimetype = trim(strtolower($mimetype));
		$mime_types = self::get_mime_types();
		return array_search($mimetype, $mime_types);
	}


	// Determine the Mime Type of a file
    public static function mime_content_type($filename)
	{
		$mime_types = self::get_mime_types();
        $ext = strtolower(array_pop(explode('.',$filename)));
        if (array_key_exists($ext, $mime_types)) {
            return $mime_types[$ext];
        }
        elseif (function_exists('finfo_open')) {
            $finfo = finfo_open(FILEINFO_MIME);
            $mimetype = finfo_file($finfo, $filename);
            finfo_close($finfo);
			$semicolonPos = strpos($mimetype, ";");
			if ($semicolonPos !== false) {
				$mimetype = trim(substr($mimetype, 0, $semicolonPos));
			}
            return $mimetype;
        }
        else {
            return 'application/octet-stream';
        }
    }


	// When a script shuts down, delete a file or set it to be deleted by a cron
    public static function delete_file_on_shutdown($handler, $filename, $deleteNow=false)
	{
		// Delete the file now (and if fails, then set cron to delete it)
		if ($deleteNow) {
			// If cannot delete file (if may still be open somehow), then put in db table to delete by cron later
			fclose($handler);
			unlink($filename);
		}
		// Set file to be deleted when this script ends
		else {
			register_shutdown_function('Files::delete_file_on_shutdown', $handler, $filename, true);
		}
	}


	/**
	 * DELETE TEMP FILES AND EXPIRED SEND-IT FILES ONLY AT CERTAIN TIMES
	 * FOR EACH GIVEN WEB REQUEST IN INIT_GLOBAL.PHP AND INIT_PROJECT.PHP
	 */
	public static function manage_temp_files()
	{
		// Clean up any temporary files sitting on the web server (for various reasons)
		// Only force this 5x every 1000 requests to allow each web server to flush temp
		// if using load balancing, which won't be as easily cleared by the cron.
		self::remove_temp_deleted_files(defined("LOG_VIEW_ID") && LOG_VIEW_ID % 1000 <= 5);
	}


	/**
	 * DELETE TEMP FILES AND EXPIRED SEND-IT FILES (RUN ONCE EVERY 20 MINUTES)
	 */
	public static function remove_temp_deleted_files($forceAction=false)
	{
		global $temp_files_last_delete, $edoc_storage_option;

		// Make sure variable is set
		if ($temp_files_last_delete == "" || !isset($temp_files_last_delete)) return;

		// Set X number of minutes to delete temp files
		$checkTimeMin = 20;

		// If temp files have not been checked/deleted in the past X minutes, then run procedure to delete them.
		if ($forceAction || strtotime(NOW)-strtotime($temp_files_last_delete) > $checkTimeMin*60)
		{
			// Initialize counter for number of docs deleted
			$docsDeleted = 0;

			## DELETE ALL FILES IN TEMP DIRECTORY IF OLDER THAN X MINUTES OLD
			// Make sure temp dir is writable and exists
			if (($edoc_storage_option != '3' && is_dir(APP_PATH_TEMP) && is_writeable(APP_PATH_TEMP))
				// If using Google Cloud Storage, ensure that the temp and edocs buckets aren't the same
				// (so we don't accidentally delete permanent files).
				|| !($edoc_storage_option == '3' && APP_PATH_TEMP == EDOC_PATH))
			{
				// Put temp file names into array
				$dh = opendir(APP_PATH_TEMP);
				$files = array();
				while (false !== ($filename = readdir($dh))) {
					$files[] = $filename;
				}
				// Timestamp of X min ago
				$x_min_ago = date("YmdHis", mktime(date("H"),date("i")-$checkTimeMin,date("s"),date("m"),date("d"),date("Y")));
				// Loop through all filed in temp dir
				foreach ($files as $key => $value) {
					// Delete ANY files that begin with a 14-digit timestamp
					$file_time = substr($value, 0, 14);
					// If file is more than one hour old, delete it
					if (is_numeric($file_time) && $file_time < $x_min_ago) {
						// Delete the file
						unlink(APP_PATH_TEMP . $value);
					}
				}
			}

			## DELETE ANY SEND-IT OR EDOC FILES THAT ARE FLAGGED FOR DELETION
			$docid_deleted = array();
			// Loop through list of expired Send-It files (only location=1, which excludes edocs and file repository files)
			// and Edoc files that were deleted by user over 30 days ago.
			$sql = "(select 'sendit' as type, document_id, doc_name from redcap_sendit_docs where location = 1 and expire_date < '".NOW."'
					and date_deleted is null)
					UNION
					(select 'edocs' as type, doc_id as document_id, stored_name as doc_name from redcap_edocs_metadata where
					delete_date is not null and date_deleted_server is null and delete_date < DATE_ADD('".NOW."', INTERVAL -1 MONTH))";
			$q = db_query($sql);

			// Delete from local web server folder
			if ($edoc_storage_option == '0' || $edoc_storage_option == '3')
			{
				while ($row = db_fetch_assoc($q))
				{
					// Delete file, and if successfully deleted, then add to list of files deleted
					if (unlink(EDOC_PATH . $row['doc_name']))
					{
						$docid_deleted[$row['type']][] = $row['document_id'];
					}
				}
			}
			// Delete from S3
			elseif ($edoc_storage_option == '2')
			{
				global $amazon_s3_key, $amazon_s3_secret, $amazon_s3_bucket;
				$s3 = new S3($amazon_s3_key, $amazon_s3_secret, SSL); if (isset($GLOBALS['amazon_s3_endpoint']) && $GLOBALS['amazon_s3_endpoint'] != '') $s3->setEndpoint($GLOBALS['amazon_s3_endpoint']);
				while ($row = db_fetch_assoc($q))
				{
					// Delete file, and if successfully deleted, then add to list of files deleted
					if ($s3->deleteObject($amazon_s3_bucket, $row['doc_name']))
					{
						$docid_deleted[$row['type']][] = $row['document_id'];
					}
				}
			}
			// Delete from external server via webdav
			elseif ($edoc_storage_option == '1')
			{
				// Call webdav class and open connection to external server
				require APP_PATH_WEBTOOLS . "webdav/webdav_connection.php";
				$wdc = new WebdavClient();
				$wdc->set_server($webdav_hostname);
				$wdc->set_port($webdav_port); $wdc->set_ssl($webdav_ssl);
				$wdc->set_user($webdav_username);
				$wdc->set_pass($webdav_password);
				$wdc->set_protocol(1);  // use HTTP/1.1
				$wdc->set_debug(false); // enable debugging?
				$wdc->open();
				if (substr($webdav_path,-1) != "/" && substr($webdav_path,-1) != "\\") {
					$webdav_path .= '/';
				}
				while ($row = db_fetch_assoc($q))
				{
					// Delete file
					$http_status = $wdc->delete($webdav_path . $row['doc_name']);
					// If successfully deleted, then add to list of files deleted
					if ($http_status['status'] != "404")
					{
						$docid_deleted[$row['type']][] = $row['document_id'];
					}
				}
			}

			// For all Send-It files deleted here, add date_deleted timestamp to table
			if (isset($docid_deleted['sendit']))
			{
				db_query("update redcap_sendit_docs set date_deleted = '".NOW."' where document_id in (" . implode(",", $docid_deleted['sendit']) . ")");
				$docsDeleted += db_affected_rows();
			}
			// For all Edoc files deleted here, add date_deleted_server timestamp to table
			if (isset($docid_deleted['edocs']))
			{
				db_query("update redcap_edocs_metadata set date_deleted_server = '".NOW."' where doc_id in (" . implode(",", $docid_deleted['edocs']) . ")");
				$docsDeleted += db_affected_rows();
			}

			## Now that all temp/send-it files have been deleted, reset time flag in config table
			db_query("update redcap_config set value = '".NOW."' where field_name = 'temp_files_last_delete'");

			// Return number of docs deleted
			return $docsDeleted;
		}
	}

}
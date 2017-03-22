<?php
/*****************************************************************************************
**  REDCap is only available through a license agreement with Vanderbilt University
******************************************************************************************/

require_once dirname(dirname(__FILE__)) . '/Config/init_project.php';

// Increase memory limit in case needed for intensive processing
System::increaseMemory(2048);

if (isset($_GET['id']) && is_numeric($_GET['id'])) {

	$id = (int)$_GET['id'];

	/* we need to determine if the document is in the file system or the database */
	$sql = "SELECT d.docs_size, d.docs_type, d.export_file, d.docs_name, e.docs_id, m.stored_name, d.docs_file, m.gzipped
			FROM redcap_docs d
			LEFT JOIN redcap_docs_to_edocs e ON e.docs_id = d.docs_id
			LEFT JOIN redcap_edocs_metadata m ON m.doc_id = e.doc_id
			WHERE d.docs_id = $id and d.project_id = $project_id";
	$result = db_query($sql);
	if ($result)
	{
		// Get query object
		$ddata = db_fetch_object($result);

		// Get file attributes
		$gzipped = $ddata->gzipped;
		$size = $ddata->docs_size;
		$type = $ddata->docs_type;
		$export_file = $ddata->export_file;
		$name = $docs_name = $ddata->docs_name;
		$name = preg_replace("/[^a-zA-Z-._0-9]/", "_", $name);
		$name = str_replace("__","_",$name);
		$name = str_replace("__","_",$name);

		// Determine type of file
		$file_extension = strtolower(substr($docs_name,strrpos($docs_name,".")+1,strlen($docs_name)));

		// Set header content-type
		$type = 'application/octet-stream';
		if (strtolower(substr($name, -4)) == ".csv") {
			$type = 'application/csv';
		}


		if ($ddata->docs_id === NULL) {
			/* there is no reference to edocs_metadata, so the data lives in the database table (legacy) */
			$data = $ddata->docs_file;
		} else {
			if ($edoc_storage_option == '1') {
				//Download using WebDAV
				include APP_PATH_WEBTOOLS . 'webdav/webdav_connection.php';
				//WebDAV method used only by Vanderbilt because of unresolvable server issues with WebDAV method
				if (SERVER_NAME == "www.mc.vanderbilt.edu" || SERVER_NAME == "staging.mc.vanderbilt.edu") {
					if (extension_loaded("dav")) {
						try {
							webdav_connect("http://$webdav_hostname:$webdav_port", $webdav_username, $webdav_password);
							$data = webdav_get($webdav_path . $ddata->stored_name);
							webdav_close();
						} catch ( Exception $e ) {
							$data = $e;
						}
					} else {
						exit($lang['file_download_10']);
					}
				//Default WebDAV method included in REDCap
				} else {
					// Upload using WebDAV
					$wdc = new WebdavClient();
					$wdc->set_server($webdav_hostname);
					$wdc->set_port($webdav_port); $wdc->set_ssl($webdav_ssl);
					$wdc->set_user($webdav_username);
					$wdc->set_pass($webdav_password);
					$wdc->set_protocol(1); // use HTTP/1.1
					$wdc->set_debug(FALSE); // enable debugging?
					if (!$wdc->open()) {
						$error[] = $lang['control_center_206'];
					}
					$data = NULL;
					$http_status = $wdc->get($webdav_path . $ddata->stored_name, $data); /* passed by reference, so file content goes to $data */
					$wdc->close();
				}
			} elseif ($edoc_storage_option == '2') {
				// S3
				$s3 = new S3($amazon_s3_key, $amazon_s3_secret, SSL); if (isset($GLOBALS['amazon_s3_endpoint']) && $GLOBALS['amazon_s3_endpoint'] != '') $s3->setEndpoint($GLOBALS['amazon_s3_endpoint']);
				if (($object = $s3->getObject($amazon_s3_bucket, $ddata->stored_name)) !== false) {
					$data = $object->body;
				} else {
					// Pull $data using readfile_chunked() for better memory management (assumes not an export file or Japanese SJIS encoded file)
					$data = NULL;
				}

			} else {
				/* The file lives in the file system */
				if ($export_file || ($project_encoding == 'japanese_sjis' && function_exists('mb_detect_encoding') && mb_detect_encoding($data) == "UTF-8")) {
					// If need to pull $data into memory
					$data = file_get_contents(EDOC_PATH . $ddata->stored_name);
				} else {
					// Pull $data using readfile_chunked() for better memory management (assumes not an export file or Japanese SJIS encoded file)
					$data = NULL;
				}
			}
		}

		// GZIP decode the file (if is encoded)
		if ($export_file && $gzipped && $data != null)
		{
			list ($data, $name) = gzip_decode_file($data, $name);
		}

		// If exporting R or Stata data file as UTF-8 encoded, then remove the BOM (causes issues in R and Stata)
		if ($export_file && isset($_GET['exporttype']) && ($_GET['exporttype'] == 'R' || $_GET['exporttype'] == 'STATA'))
		{
			$data = removeBOMfromUTF8($data);
		}
		// If a SAS syntax file, replace beginning text so that even very old files work with the SAS Pathway Mapper (v4.6.3+)
		elseif ($export_file && strtolower(substr($name, -4)) == '.sas')
		{
			// Find the position of "infile '" and cut off all text occurring before it
			$pos = strpos($data, "infile '");
			if ($pos !== false) {
				// Now splice the file back together using the new string that occurs on first line (which will work with Pathway Mapper)
				$prefix = "%macro removeOldFile(bye); %if %sysfunc(exist(&bye.)) %then %do; proc delete data=&bye.; run; %end; %mend removeOldFile; %removeOldFile(work.redcap); data REDCAP; %let _EFIERR_ = 0;\n";
				$data = $prefix . substr($data, $pos);
			}
		}

		// Output headers for file
		header('Pragma: anytextexeptno-cache', true);
		header("Content-type: $type");
		header("Content-Disposition: attachment; filename=$name");

		//File encoding will vary by language module
		if ($project_encoding == 'japanese_sjis' && function_exists('mb_detect_encoding') && mb_detect_encoding($data) == "UTF-8") {
			print mb_convert_encoding(removeBOMfromUTF8($data), "SJIS", "UTF-8");
		} else {
			if ($data == NULL) {
				// Use readfile_chunked() for better memory management of large files
				ob_end_flush();
				readfile_chunked(EDOC_PATH . $ddata->stored_name);
			} else {
				// File content is stored in memory as $data, so print it
				print $data;
			}
		}

		## Logging
		// Default logging description
		$descr = "Download file from file repository";
		// Determine type of file
		if ($export_file)
		{
			switch ($file_extension) {
				case "xml":
					if (substr($name, -10) == 'REDCap.xml') {
						$descr = "Download exported REDCap project XML file (metadata & data)";
					} else {
						$descr = "Download exported data file (CDISC ODM)";
					}
					break;
				case "r":
					$descr = "Download exported syntax file (R)";
					break;
				case "do":
					$descr = "Download exported syntax file (Stata)";
					break;
				case "sas":
					$descr = "Download exported syntax file (SAS)";
					break;
				case "sps":
					$descr = "Download exported syntax file (SPSS)";
					break;
				case "csv":
					$descr = (substr($name, 0, 12) == "DATA_LABELS_" || strpos($name, "_DATA_LABELS_20") !== false)
						   ? "Download exported data file (CSV labels)"
						   : "Download exported data file (CSV raw)";
					break;
			}
		}
		// Log it
		Logging::logEvent($sql,"redcap_docs","MANAGE",$id,"docs_id = $id",$descr);

	}
}

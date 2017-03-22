<?php

class SendItController extends Controller
{
	// Render the Send-It upload page
	public function upload()
	{
		SendIt::renderUploadPage();
	}
	
	// Render the Send-It download page
	public function download()
	{
		SendIt::renderDownloadPage();
	}
}
<?php
/*****************************************************************************************
**  REDCap is only available through a license agreement with Vanderbilt University
******************************************************************************************/

/**
 * RepeatInstance Controller
 */
class RepeatInstanceController
{	
	// Output HTML for setup table for repeat instances
	public function renderSetup()
	{
		RepeatInstance::renderSetup();
	}
	
	// Save settings from setup table for repeat instances
	public function saveSetup()
	{
		RepeatInstance::saveSetup();
	}	
}
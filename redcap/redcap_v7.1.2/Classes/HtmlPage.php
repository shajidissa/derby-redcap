<?php

class HtmlPage
{

    /*
    * PRIVATE PROPERTIES
    */

    // @var header string
    // @access private
    var $header;

    // @var footer string
    // @access private
    var $footer;


    /*
    * PUBLIC PROPERTIES
    */

    // @var htmltitle string
    // @access public
    var $htmltitle;

    // @var pagetitle string
    // @access public
    var $pagetitle;

    // @var stylesheets array
    // @access public
    var $stylesheets;

    // @var inlinestyle array
    // @access public
    var $inlinestyle;

    // @var internalJS array
    // @access public
    var $internalJS;

    // @var externalJS array
    // @access public
    var $externalJS;

    // @var externalJS array
    // @access public
    var $breadcrumbs;

    // @var bodyOnLoad array
    // @access public
    var $bodyOnLoad;

    // @var topnav array
    // @access public
    var $topnav;

    // @var pagenav array
    // @access public
    var $pagenav;

    // @var titletext string
    // @access public
    var $titletext;

    /*
    * PRIVATE FUNCITONS
    */

    // @return HtmlPage
    // @access private
    function __construct()
    {
        // Default page title
        $this->htmltitle    = 'REDCap';
        // Array of stylesheets
        $this->stylesheets  = array();
        // Array of inline style
        $this->inlinestyle  = array();
        // Array Internal/inline javascript
        $this->internalJS   = array();
        // Array external javascript files
        $this->externalJS   = array();
        // Array body onLoad javascript commands
        $this->bodyOnLoad   = array();
        // Array of breadcrumbs
        $this->breadcrumbs  = array();
        // Array of top navigation elements
        $this->topnav       = array();
        // Array of page navigation elements
        $this->pagenav      = array();
        // Default titletext to a nonbreaking space
        $this->titletext    = '&nbsp;';
        // Default hovertext to a nonbreaking space. An empty string will result in display errors
        $this->hovertext    = '&nbsp;';
    }

	/**
     * PUBLIC FUNCITONS
     */
	 
	public function ProjectHeader() 
	{
		extract($GLOBALS);
		include APP_PATH_DOCROOT . 'ProjectGeneral/header.php';
	}
	 
	public function ProjectFooter() 
	{
		extract($GLOBALS);
		include APP_PATH_DOCROOT . 'ProjectGeneral/footer.php';
	}

    // @return void
    // @access public
    function PrintHeader() {

		global $isMobileDevice, $isIOS;

       print	   '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">' . "\n" .
                        '<html>' . "\n" .
                        '<head>' . "\n" .
						'<meta name="googlebot" content="noindex, noarchive, nofollow, nosnippet">' . "\n" .
						'<meta name="robots" content="noindex, noarchive, nofollow">' . "\n" .
						'<meta name="slurp" content="noindex, noarchive, nofollow, noodp, noydir">' . "\n" .
						'<meta name="msnbot" content="noindex, noarchive, nofollow, noodp">' . "\n" .
                        '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />' . "\n" .
                        '<meta http-equiv="Cache-Control" content="no-cache">' . "\n" .
                        '<meta http-equiv="Pragma" content="no-cache">' .  "\n" .
                        '<meta http-equiv="expires" content="0">' .  "\n" .
                        '<meta charset="utf-8">' . "\n" .
                        '<meta http-equiv="X-UA-Compatible" content="IE=edge">' . "\n" .
						'<meta name="viewport" content="width=device-width, initial-scale=1">' . "\n" .
						'<title>' . $this->htmltitle . '</title>' . "\n" .
						'<link rel="shortcut icon" href="' . APP_PATH_IMAGES . 'favicon.ico">' . "\n" .
						'<link rel="apple-touch-icon-precomposed" href="' . APP_PATH_IMAGES . 'apple-touch-icon.png">' . "\n";
        // Add all stylesheets
        // -------------------
        foreach($this->stylesheets AS $tag) {
            print  $tag;
        }
        // Add all external javascript file
        // --------------------------------
        foreach($this->externalJS AS $path) {
            print  '<script type="text/javascript" src="' . $path . '"></script>' . "\n";
        }

        // Add any internal javascript code (if it exists)
        // -----------------------------------------------
        if(count($this->internalJS)) {
            print  '<script type="text/javascript">';

            foreach($this->internalJS AS $js) {
                print  $js;
            }

            print  '</script>';
        }

        print  '</head>' . "\n";

        // if there are no onload javascript events to fire
        // ------------------------------------------------
        if(!count($this->bodyOnLoad)) {
            // open body tag
            // -------------
            print  '<body>';
        } else {
            // begin open body tag
            // -------------------
            print  '<body onload="';

            foreach($this->bodyOnLoad AS $js) {
                // add all javascript on load events
                // ---------------------------------
                print  $js;
            }
            // end open body tag
            // -----------------
            print  '">';
        }
		
		// REDCap Hook injection point: Pass PROJECT_ID constant (if defined).
		Hooks::call('redcap_every_page_top', array(defined('PROJECT_ID') ? PROJECT_ID : null));
	
		// Main page container div
        print  '<div id="pagecontainer" class="container-fluid">';

		// iOS CSS Hack for rendering drop-down menus with a background image
		if ($isIOS)
		{
			print  '<style type="text/css">select { padding-right:14px !important; background-image:url("'.APP_PATH_IMAGES.'arrow_state_grey_expanded.png") !important; background-position:right !important; background-repeat:no-repeat !important; }</style>';
		}

		// Add all inlinestyle
        // -------------------
        foreach($this->inlinestyle AS $csstag) {
            print  $csstag;
        }

        print $this->header;

		// Do CSRF token check (using PHP with jQuery)
		System::createCsrfToken();

		// Render Javascript variables needed on all pages for various JS functions
		renderJsVars();

        print(					'<div id="container">' .
                                    '<div id="pagecontent">');

    }

    // @return void
    // @access public
    function PrintHeaderExt() {
		$this->addExternalJS(APP_PATH_JS . "base.js");
		$this->addStylesheet("jquery-ui.min.css", 'screen,print');
		$this->addStylesheet("style.css", 'screen,print');
		$this->addStylesheet("home.css", 'screen,print');
		$this->PrintHeader();
		// Adjust some CSS
		print  "<style type='text/css'>#pagecontent {margin: 0px;} #footer { display:none; }</style>";
	}

    // @return void
    // @access public
    function PrintFooterExt() {
		$this->PrintFooter();
	}

    // @return void
    // @access public
    function PrintFooter() {

		global $redcap_version;

		print   		'</div>' .
					'</div>';

		// Display REDCap copyright (but not in Mobile Site view)
		print 	'<div id="footer" class="hidden-xs col-sm-12">' .
					'<a href="https://projectredcap.org" target="_blank">REDCap ' . $redcap_version . '</a> - &copy; ' . date("Y") . ' Vanderbilt University' .
				'</div>';
		print	'</div>';

		// Initialize auto-logout popup timer and logout reset timer listener
		initAutoLogout();

		// Render hidden divs used by showProgress() javascript function
		renderShowProgressDivs();

		// Render divs holding javascript form-validation text (when error occurs), so they get translated on the page
		renderValidationTextDivs();

		// Display notice that password will expire soon (if utilizing $password_reset_duration for Table-based authentication)
		Authentication::displayPasswordExpireWarningPopup();

		// Check if need to display pop-up dialog to SET UP SECURITY QUESTION for table-based users
		Authentication::checkSetUpSecurityQuestion();

		// Returns hidden div with X number of random characters. This helps mitigate hackers attempting a BREACH attack.
		echo getRandomHiddenText();

		print '</body></html>';

    }

    // @return void
    // @access public
    function addInlineStyle($css_string)
    {
        array_push($this->inlinestyle, "\n<style type=\"text/css\">\n$css_string\n</style>\n");
    }

    // @return void
    // @access public
    function addStylesheet($file, $media)
    {
        $tag = '<link rel="stylesheet" type="text/css" media="' . $media . '" href="' . APP_PATH_CSS . $file . '"/>' . "\n";
        array_push($this->stylesheets, $tag);
    }

    // @return void
    // @access public
    function addStylesheet2($file, $media)
    {
        $tag = '<link rel="stylesheet" type="text/css" media="' . $media . '" href="' . $file . '"/>' . "\n";
        array_push($this->stylesheets, $tag);
    }

    // @return void
    // @access public
    function addInternalJS($js)
    {
        array_push($this->internalJS, $js);
    }

    // @return void
    // @access public
    function addExternalJS($path)
    {
        array_push($this->externalJS, $path);
    }

    function setPageTitle($var)
    {
        //$this->pagetitle = $var;
		$this->htmltitle = $var;
    }

}

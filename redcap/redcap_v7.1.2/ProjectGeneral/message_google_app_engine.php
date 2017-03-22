<?php

// Send email using Google App Engine's Message class.
// Contained in its own file for PHP 5.1 and 5.2, which throw a PHP parsing
// error due to the use of namespace.

try
{
	// Set up email paramas
	$message = new \google\appengine\api\mail\Message();
	$message->setSender($this_from_email);
	$message->setReplyTo($this->getFrom());
	$message->addTo($this->getTo());
	if ($this->getCc() != "") {
		$message->addCc($this->getCc());
	}
	if ($this->getBcc() != "") {
		$message->addBcc($this->getBcc());
	}
	$message->setSubject($this->getSubject());
	$message->setHtmlBody($this->getBody());
	// Attachments, if any
	if (!empty($attachments)) {
		foreach ($attachments as $this_attachment) {
			$message->addAttachment(basename($this_attachment), file_get_contents($this_attachment), "<".md5(rand()).">");
		}
	}
	// Send email
	$message->send();
	return true;
} catch (InvalidArgumentException $e) {
	print "<br><b>ERROR: ".$e->getMessage()."</b>";
	return false;
}
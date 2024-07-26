<?php
if(is_ssl()) {
	define('HTTP', 'https');
} else {
	define('HTTP', 'http');
}
define('WEBSITE', 'Tailwebs');
define('SITENAME', 'Tailwebs'); 
define('SITETITLE', 'Tailwebs');
define('SITEURL', HTTP.'://localhost/teacher-portal/');
define('SITELOGO', 'images/logo.png'); 


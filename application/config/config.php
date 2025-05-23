<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Base URL (Sesuaikan dengan lokasi proyek)
$config['base_url'] = 'http://localhost/admin_nurul_akbar/';

// Index Page
$config['index_page'] = '';

// URI Protocol
$config['uri_protocol']	= 'REQUEST_URI';

// URL Suffix
$config['url_suffix'] = '';

// Default Language
$config['language']	= 'english';

// Default Character Set
$config['charset'] = 'UTF-8';

// Enable/Disable System Hooks
$config['enable_hooks'] = FALSE;

// Default file permission
$config['file_permissions_mode'] = 0644;
$config['directory_permissions_mode'] = 0755;

// System Time Zone
$config['time_zone'] = 'Asia/Jakarta';

// Default controller
$config['default_controller'] = 'auth';

// Default controller method
$config['default_method'] = 'index';

// Default 404 override
$config['404_override'] = '';

// Controller and method URL segment
$config['controller_trigger'] = 'c';
$config['function_trigger'] = 'm';
$config['directory_trigger'] = 'd';

// Allow query strings
$config['allow_get_array'] = TRUE;
$config['enable_query_strings'] = FALSE;
$config['controller_trigger'] = 'c';
$config['function_trigger'] = 'm';
$config['directory_trigger'] = 'd';

// Error Logging Threshold
$config['log_threshold'] = 1;

// Error Logging Directory Path
$config['log_path'] = '';

// Error Log File Extension
$config['log_file_extension'] = '';

// Session Variables
$config['sess_driver'] = 'files';
$config['sess_cookie_name'] = 'ci_session';
$config['sess_expiration'] = 7200;
$config['sess_save_path'] = NULL;
$config['sess_match_ip'] = FALSE;
$config['sess_time_to_update'] = 300;
$config['sess_regenerate_destroy'] = FALSE;

// Cookie Related Variables
$config['cookie_prefix']	= '';
$config['cookie_domain']	= '';
$config['cookie_path']		= '/';
$config['cookie_secure']	= FALSE;
$config['cookie_httponly'] 	= FALSE;

// Cross Site Request Forgery
$config['csrf_protection'] = FALSE;
$config['csrf_token_name'] = 'csrf_test_name';
$config['csrf_cookie_name'] = 'csrf_cookie_name';
$config['csrf_expire'] = 7200;
$config['csrf_regenerate'] = TRUE;
$config['csrf_exclude_uris'] = array();

// Output Compression
$config['compress_output'] = FALSE;

// Master Time Reference
$config['time_reference'] = 'local';

// Rewrite PHP Short Tags
$config['rewrite_short_tags'] = FALSE;

// Reverse Proxy IPs
$config['proxy_ips'] = '';

$config['subclass_prefix'] = 'MY_';
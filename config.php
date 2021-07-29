<?php

	define( "VERSION" , "1.0.0" );
	define( "CSS_VER" , "1.0.0" );
	define( "JS_VER" , "1.0.0" );

    session_start();

//======================================================================
// Global Site Config
//======================================================================

	date_default_timezone_set("Australia/Perth");

    define( "GLOBAL_URL", dirname(__FILE__) );

	define( "SITE_URL" , "http://localhost/voting-system" );

	define( "ROUTER_HTTP" , "http://" );

	define( "SRV_NAME" , "Movie Voting" );

	define( "SRV_ABBR" , "Voting" );

	define( "SRV_DESC" , "Some description" );

//======================================================================
// Ranking Config
//======================================================================
	
	define( "SCORES" , [7, 5, 4, 3, 2, 1, 0] );

//======================================================================
// Database Config
//======================================================================
	
	define( "DB_HOST" , "localhost" );

	define( "DB_USER" , "root" );

	define( "DB_PASS" , "" );

	define( "DB_NAME" , "voting" );

//======================================================================
// OAuth Config
//======================================================================

	define('OAUTH2_CLIENT_ID', fgets(fopen(GLOBAL_URL.'/id.env', 'r')));

	define('OAUTH2_CLIENT_SECRET', fgets(fopen(GLOBAL_URL.'/secret.env', 'r')));

	define('AUTH_URL', 'https://discord.com/api/oauth2/authorize');

	define('CALLBACK_URL', 'http://localhost/voting-system/');

	define('SCOPE', 'identify email');

	define('TOKEN_URL', 'https://discord.com/api/oauth2/token');

	define('URL_BASE', 'https://discord.com/api/users/@me');

?>
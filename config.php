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

	define( "SITE_URL" , "http://localhost/voting" );

	define( "ROUTER_HTTP" , "http://" );

	define( "SRV_NAME" , "Movie Voting" );

	define( "SRV_ABBR" , "Voting" );

	define( "SRV_DESC" , "Some description" );

//======================================================================
// User Config
//======================================================================

	define( "USER_TIMEOUT" , "3000" );
	# Time (seconds) in user inactivity before logging out automatically

	define( "ENCRYPTION_LEVEL" , "24" );
	# The number of random characters which are encoded for user hashes

	define( "ENCRYPTION_CHARS" , "abcdefghijklmnopqrstuvwxyz"
								."ABCDEFGHIJKLMNOPQRSTUVWXYZ"
								."0123456789!@#$%^&*()");
	# The range of characters that are used for hash encryption
	
	define( "ADMIN_USER" , "root" );
	# The user that can access user management
	
	define( "DB_HOST" , "localhost" );

	define( "DB_USER" , "root" );

	define( "DB_PASS" , "" );

	define( "DB_NAME" , "voting" );

?>
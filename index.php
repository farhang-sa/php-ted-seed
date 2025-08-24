<?php

define( 'TExec' , microtime() ); // PHP Script Execution Started
define( 'TPath_DS' , DIRECTORY_SEPARATOR );
define( 'TPath_Root' , realpath( __DIR__ ) );
define( 'TPath_Index' , basename( __FILE__ ) );
define( 'TPath_AppRoot' , TPath_Root ) ;
define( 'TPath_Default_AppData' , TPath_AppRoot . TPath_DS . 'AppData' );

@date_default_timezone_set( 'UTC' );

// Auto load
include_once TPath_Root . TPath_DS . 'vendor' . TPath_DS . 'autoload.php' ;

$App = new AppName( TPath_AppRoot , Ted\Intel::GetRoute() );

$App->Initialise();

$App->Respond();

$App->Finish();

?>
<?php defined( 'TExec' ) or die( TAccess );

//// define some paths
define( 'DS' , TPath_DS );
define( 'Root' , TPath_Root );
define( 'WebUi' , Root . DS . 'WebUi' ) ;

//// load ted-setup.json file
$original = Root . DS . 'ted-setup.json' ;
if( file_exists( $original ) && is_file( $original ) )
	$original = Ted\json_str_to_array( file_get_contents( $original ) );
else $original = array(
	'AppName' 		 => 'AppName' , 
	'AppDescribtion' => 'App describtion' , 
	'AppVersion' 	 => 'v0.1' ,
	'AppRelease' 	 => '20190305' ,
	'AppAuthor' 	 => 'farhang-sa' , 
	'AppAuthorEmail' => 'saeedi.farhang@gmail.com' , 
	'AppTitle' 		 => 'App title' , 
	'AppKeywords' 	 => 'AppName , keywords' ,
	'AppGenerator'	 => 'Ted-MVC-v1' );

$intel = $this->input->AppIntel ;
if( ! $intel )
	return $original ;

$intel[ 'AppVersion' ] = 'v1.0' ;
$intel[ 'AppRelease' ] = date( 'Ymd' , time() ) . '' ;

//// check input
$checks = array(
	'AppName' 		 => 'App name is required' ,
	'AppDescribtion' => 'App describtion is required' ,
	'AppAuthor' 	 => 'App author name is required' ,
	'AppAuthorEmail' => 'App author email is required' ,
	'AppTitle' 		 => 'App title is required' ,
	'AppKeywords' 	 => 'keywords are required' );

foreach( $checks as $s => $e )
	if( ! isset( $intel[$s] ) )
		return $this->Response([ 'message' => $e , 'fail' => 1 ]);

//// change composer file
$Composer = array( 
	'AppName' 		 => 'php-ted-seed' ,
	'AppDescribtion' => 'A seed for building ted applications' , 
	'AppAuthor' 	 => 'farhang-sa' ,
	'AppAuthorEmail' => 'Saeedi.Farhang@gmail.com' );

$data = file_get_contents( TPath_Root . DS . 'composer.json' );

foreach( $Composer as $var => $default )
	$data = str_ireplace( $default , strtolower( $intel[$var] ) , $data );

file_put_contents( TPath_Root . DS . 'composer.json' , $data );

//// rename some files
$uiFiles = array( 
	WebUi . DS . 'Files' . DS . 'js'  . DS . $original['AppName'] . '.js' , 
	WebUi . DS . 'Files' . DS . 'css' . DS . $original['AppName'] . '.css' );

foreach( $uiFiles as $uiFile )
	rename( $uiFile , str_ireplace( $original['AppName'] , $intel['AppName'] , $uiFile ) );

//// change main files
$ChangeFiles = array(
	TPath_Root . DS . 'index.php' ,
	TPath_Root . DS . 'App.php' ,
	WebUi . DS . 'index.html' ,
	WebUi . DS . 'init.html' ,
	WebUi . DS . 'site.php' ,
	WebUi . DS . 'Site' . DS . 'navigation.html' );

foreach( $ChangeFiles as $filePath ):

	$c = file_get_contents( $filePath );

	foreach( $original as $k => $v ){

		$intel[$k] = empty( $intel[$k] ) ? $v : $intel[$k] ;
		$c = str_ireplace( $v , $intel[$k] , $c );

	}

	file_put_contents( $filePath , $c );

endforeach;

$original = Ted\json_array_to_str( $intel , true );

file_put_contents( Root . DS . 'ted-setup.json' , $original );

$this->Response([ 'message' => 'App details saved' , 'success' => 1 ]);

return $intel ;

?>
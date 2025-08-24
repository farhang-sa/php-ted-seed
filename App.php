<?php defined( 'TExec' ) or die( 'Access Denied : ' . basename( __FILE__ ) );
define( 'AppName_Root' , __DIR__ );

class AppName extends Ted\Application {
		
	public $AppComp = 'Setup' ;

	public function Initialise(){
		$this->translator->LoadINIDirectory( AppName_Root . TPath_DS . 'Lang' ); }
	
	public function Finish(){ 
		return true ; }

}

?>
<?php
class Cli_base
{
	//arguments from cli
	private $args;
	function __construct($argv)
	{
		if ( php_sapi_name() !== 'cli' || strpos( php_sapi_name(), 'cgi' !== true)) { 
	
			die('\nMust be on Cli');
				
		}	
		$this->args = [];
		$argv = array_slice($argv, 1);
		for($i=0; $i< sizeof($argv); $i++)
		{
			
			if($i % 2 == 0)
			{
				
				   $value = null;
				   
				   if(isset($argv[$i+1]))
				   {
					   
				     $value = $argv[$i+1];
				 }
				     
			       $this->args[$argv[$i]] = $value;
			       
			       unset($value);
				
			}
		}
		
						
	}
	

	
	public function hasArg($name)
	{
		

		if(isset($this->args[$name]))
		{
			
		return true;
		
	    }
		else
		return false;
	}
	
	public function argValue($name)
	{
		if(isset($this->args[$name]))
		{
			return $this->args[$name];
		}
		
		return null;
	}
	
	public function next()
	{
		$handle = fopen ("php://stdin","r");
        $line = trim(fgets($handle));
        
        
        
      return (explode (" ", $line)[0]);
        
        
        
	}
	
	public function nextLine()
	{
		$handle = fopen ("php://stdin","r");
        $line = trim(fgets($handle));
        return $line;
	}
	
	public function getArgs()
	{
		return $this->args;
	}

	public function displayRed($value, $type = 0)
	{

		return "\e[".$type.";31m".$value."\e[0;39m";
	}

	public function displayGreen($value, $type = 0)
	{

		return "\e[".$type.";32m".$value."\e[0;39m";
	}

	public function displayYellow($value, $type = 0)
	{

		return "\e[".$type.";33m".$value."\e[0;39m";
	}

	public function displayBlue($value, $type = 0)
	{

		return "\e[".$type.";34m".$value."\e[0;39m";
	}

	public function displayCyan($value, $type = 0)
	{

		return "\e[".$type.";36m".$value."\e[0;39m";
	}
	
	
}



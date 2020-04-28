<?php

namespace Aposoftworks\StubHelper\Classes;

//Abstractions
use Aposoftworks\StubHelper\Abstractions\StubHelperBase;

//Contracts
use Aposoftworks\StubHelper\Contracts\CustomizableStubHelperContract;

class CustomizableStubHelper extends StubHelperBase implements CustomizableStubHelperContract {

	//-------------------------------------------------
    // Properties
	//-------------------------------------------------

	protected static $variablepattern 		= ["{{", "}}"];
	protected static $linebreakpattern		= "\n";

	//-------------------------------------------------
    // Pattern methods
	//-------------------------------------------------

	public static function setVariablePattern ($regexpattern = "/({{|}})/m") : void {
		if (is_array($regexpattern)) {
			CustomizableStubHelper::$variablepattern = $regexpattern;
		}
		else {
			$pattern = str_split(")", str_split("(", $regexpattern)[1])[0];
			CustomizableStubHelper::$variablepattern = str_split("|", $pattern);
		}
	}

	public static function setLineBreakPattern (string $regexpattern) : void {
		CustomizableStubHelper::$linebreakpattern = $regexpattern;
	}

	//-------------------------------------------------
    // Helper methods
	//-------------------------------------------------

	protected static function printIntoFile (string $file, array $variables) : string {
        $result 	= $file;
		$pattern 	= CustomizableStubHelper::$variablepattern;

        //Get all variable fields
        preg_match_all("/".$pattern[0].".+".$pattern[1]."/m", $file, $requiredfields);
        $requiredfields = $requiredfields[0];

        //Replace them
        for ($i = 0; $i < count($requiredfields); $i++) {
            //Remove trailings
            $variable = preg_replace("/(".$pattern[0]."|".$pattern[1].")/m", "", $requiredfields[$i]);
            //Trim
            $variable = trim($variable);
            //Remove variable identifier
            $variable = preg_replace("/^./", "", $variable);

            if (isset($variables[$variable])) {
                $result = preg_replace('/'.$pattern[0].'\s*'.$variable.'\s*'.$pattern[1].'/m', $variables[$variable], $result);
            }
        }

        return $result;
	}
}

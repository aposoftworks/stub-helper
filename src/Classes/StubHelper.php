<?php

namespace Aposoftworks\StubHelper\Classes;

//Abstractions
use Aposoftworks\StubHelper\Abstractions\StubHelperBase;

class StubHelper extends StubHelperBase {

	//-------------------------------------------------
    // Helper methods
	//-------------------------------------------------

	protected static function printIntoFile (string $file, array $variables) : string {
        $result = $file;

        //Get all variable fields
        preg_match_all("/{{.+}}/m", $file, $requiredfields);
        $requiredfields = $requiredfields[0];

        //Replace them
        for ($i = 0; $i < count($requiredfields); $i++) {
            //Remove trailings
            $variable = preg_replace("/({{|}})/m", "", $requiredfields[$i]);
            //Trim
            $variable = trim($variable);
            //Remove variable identifier
            $variable = preg_replace("/^./", "", $variable);

            if (isset($variables[$variable])) {
                $result = preg_replace('/{{\s*'.$variable.'\s*}}/m', $variables[$variable], $result);
            }
        }

        return $result;
	}
}

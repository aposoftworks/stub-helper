<?php

namespace Aposoftworks\StubHelper\Abstractions;

//Interfaces
use Aposoftworks\StubHelper\Contracts\StubHelperContract;

/*
 * Stub helper allows you to create a stub by the builder design pattern
 * or with a static method that allows you to do everything at once.
 */
abstract class StubHelperBase implements StubHelperContract {
	//-------------------------------------------------
    // Properties
	//-------------------------------------------------

	protected $filecontent 	= "";
	protected $variables 	= [];

	//-------------------------------------------------
    // File methods
	//-------------------------------------------------

	public function setFile (string $filedata) : void {
		$this->filecontent = $filedata;
	}

	public function getFile (string $filepath) : bool {
		//File found
		if (file_exists($filepath)) {
			$this->filecontent = file_get_contents($filepath);
			return true;
		}

		//No file found
		return false;
	}

	//-------------------------------------------------
    // Variable methods
	//-------------------------------------------------

	public function setVariables (array $variables) : void {
		$this->variables = $variables;
	}

	public function addVariables ($variable) : void {
		//Add as array
		if (is_array($variable)) {
			for ($i = 0; $i < count($variable);$i++) {
				$this->variables[] = $variable[$i];
			}
		}
		//Single value
		else {
			$this->variables[] = $variable;
		}
	}

	public function clearVariables () : void {
		$this->variables = [];
	}

	//-------------------------------------------------
    // Render methods
	//-------------------------------------------------

	public function print (bool $clear = false) : string {
		$file = static::printIntoFile($this->filecontent, $this->variables);

		//Check if clear is necessary
		if ($clear) $this->clear();

		//Response
		return $file;
	}

	public function saveTo (string $path, bool $clear = false) : void {
		//Check if the path exists
        $parts = explode('/', $path);
        $file = array_pop($parts);
        $dir = '';
        foreach($parts as $part) {
            if(!is_dir($dir .= "/$part")) mkdir($dir);
		}

		//Save the file
		$file = static::printIntoFile($this->filecontent, $this->variables);
		file_put_contents($path, $file);

		//Check if clear is necessary
		if ($clear) $this->clear();
	}

	//-------------------------------------------------
    // General methods
	//-------------------------------------------------

	public static function generate (string $file, array $variables) : string {
		return static::printIntoFile($file, $variables);
	}

	public function clear () : void {
		$this->filecontent 	= "";
		$this->variables 	= [];
	}

	//-------------------------------------------------
    // Helper methods
	//-------------------------------------------------

	protected static abstract function printIntoFile (string $file, array $variables) : string;
}

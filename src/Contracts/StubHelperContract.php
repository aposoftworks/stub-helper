<?php

namespace Aposoftworks\StubHelper\Contracts;

/*
 * Stub helper allows you to create a stub by the builder design pattern
 * or with a static method that allows you to do everything at once.
 */

interface StubHelperContract {

	//-------------------------------------------------
    // File methods
	//-------------------------------------------------

	/**
	 * Set the file content of the stub
	 *
	 * @param string $filecontent The content of the file
	 */

	public function setFile (string $filedata) : void;

	/**
	 * Get a path of a file and let the helper get it's contents
	 *
	 * @param string $filepath The path to require the content
	 * @return bool Whether the file was found and saved
	 */

	public function getFile (string $filepath) : bool;

	//-------------------------------------------------
    // Variable methods
	//-------------------------------------------------

	/**
	 * Clear all the variables and set them to be from the argument
	 *
	 * @param array $variables The variables to be saved
	 */

	public function setVariables (array $variables) : void;

	/**
	 * Add variables to the current array
	 *
	 * @param mixed Save a single value or an array into the variables array
	 */

	public function addVariables ($variable) : void;

	/**
	 * Clear all variables
	 */

	public function clearVariables () : void;

	//-------------------------------------------------
    // Render methods
	//-------------------------------------------------

	/**
	 * Save all the variables into the file and return it
	 *
	 * @param bool $clear (optional) Clear all configured data
	 * @return string $file The file with all the variables inserted
	 */

	public function print (bool $clear = false) : string;

	/**
	 * Save all the variables into the file
	 *
	 * @param string $path The path that is going to be used to save the file
	 * @param bool $clear (optional) Clear all configured data
	 */

	public function saveTo (string $path, bool $clear = false) : void;

	//-------------------------------------------------
    // General methods
	//-------------------------------------------------

	/**
	 * A shorthand version that allows you to do everything with a single method call
	 *
	 * @param string $file The file content
	 * @param array $variables The variables to be inserted
	 * @return string The file with all the variables inserted
	 */

	public static function generate (string $file, array $variables) : string;

	/**
	 * Clear all stored information
	 */
	public function clear () : void;
}

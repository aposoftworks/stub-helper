<?php

namespace Aposoftworks\StubHelper\Contracts;

interface CustomizableStubHelperContract {

	/**
	 * Set the regex that searches for the variables inside of the file
	 *
	 * @param string $regexpattern The new pattern to be used
	 */

	public function setVariablePattern (string $regexpattern) : void;

	/**
	 * Set the regex replace that will be used when line breaking
	 *
	 * @param string $regexpattern The new result to be used
	 */

	public function setLineBreakPattern (string $regexpattern) : void;
}

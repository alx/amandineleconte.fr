<?php
/**
 * @package ReusableOptions
 */
 

/**
 * The ReusableOption:: is the parent class of all options. Component class of 
 * the options Composite pattern.
 *
 * @author  M.Flury
 * @package ReusableOptions
 */
class TextFieldOption extends ReusableOption
{

	/**
	 * Size of the textfield.
	 *
	 * @var integer
	 * @access private
	 */
	var $_size;
	
	/**
	 * Maximum length of textfield content
	 *
	 * @var integer
	 * @access private
	 */
	var $_maxlength;
	
	/**
	 * Any tests that the input validation of this TextField should pass.
	 *
	 * @var array object InputTest
	 * @access private
	 */
	var $_tests;
	
	/**
	 * PHP5 type constructor
	 */
	function __construct($name, $defaultValue = '', $label = '', 
				$textBefore = '', $textAfter = '', $size = 50, $maxlength = 100)
	{
		parent::__construct($name, $defaultValue, $label, $textBefore, $textAfter);
		$this->_size = $size;
		$this->_maxlength = $maxlength;
		$this->_tests = array();
	}
	
	
	/**
	 * Getter for size field.
	 * @return integer		The size of the textField.
	 * @access public
	 */
	function getSize()
	{
		return $this->_size;
	}
	
	/**
	 * Setter for size field.
	 * @param integer $size		The new size of the textField.
	 * @access public
	 */
	function setSize($size)
	{
		$this->_size = $size;
	}
	
	/**
	 * Getter for maxlength field.
	 * @return integer		The maximum length of the textField.
	 * @access public
	 */
	function getMaxLength()
	{
		return $this->_maxlength;
	}
	
	/**
	 * Setter for maxlength field.
	 * @param integer $length	The new maximum length of the textField.
	 * @access public
	 */
	function setMaxLength($length)
	{
		$this->_maxlength = $length;
	}
	
	
	/**
	 * Add an input valdiation test to the textfield.	
	 * 
	 * @param object InputValidationTest &$test  The test to be added.
	 * @return boolean	True if test could be added, false otherwise.
	 * @access public
	 */
	function addTest(&$test)
	{	
		$this->_tests[] =& $test;
		return true;
	}
	
	/**
	 * Overrides abstract method. Does input validation of textfield options.
	 * 
	 * @return array string			The status messages created by the validation procedure.
	 * @access public
	 */
	function validate()
	{
		$result = array();
		foreach ( array_keys($this->_tests) as $index ) {
			$test =& $this->_tests[$index];
			if($statusMsg = $test->validate($this)){
				$result[] = $statusMsg;
				break;	
			}
		}	
		return $result;
	}

}


/**
 * The PasswordTextFieldOption:: defines a textfield that accepts a password
 * input is usually hidden through black dots.
 *
 * @author  M.Flury
 * @package ReusableOptions
 */
class PasswordTextFieldOption extends TextFieldOption
{}

/**
 * Represents a text field that has to validate in order to be stored
 *
 */
class StrictValidationTextFieldOption extends TextFieldOption
{}

?>

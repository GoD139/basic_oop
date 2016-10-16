<?php




//Validation class
class Validation //extends items
{
    //Error messages
    public $ErrorURL = '';
    public $ErrorString = '';
    public $ErrorSelect = '';
    public $ErrorInt = '';

    //Regular expressions
  private $URLVal = "/(((ftp|http|https):\/\/)|(\/)|(..\/))(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/";


  // Count
  Var $Count = 0;

  public function __construct( )  {  }


  function AddCount()
  {
    $this->Count += 1;
  }


  //============== Validators ==============//
//url
public function URLValidation($Input)
{
	if(empty($Input)) //Check if empty
	{
		$this->ErrorURL = "Please Enter a url";
		$this->AddCount();
	}
	if(!preg_match($this->URLVal , $Input))
	{
		$this->ErrorURL = "It has to be a url";
		$this->AddCount();
	}

}

//string
public function StringValidation($Input,$MinChars = 0,$MaxChars = 200,$Required = 1)
{
  if($Required == 1)
  {
  	if(empty($Input)) //Check if empty
  	{
  		$this->ErrorString = "Please Enter a description";
  	   $this->AddCount();
  	}
  }

	if(isset($MaxChars))
	{
		if(strlen($Input) > $MaxChars)
		{
			$this->ErrorString = "Your string must be under " . $MaxChars . " Chars";
			$this->AddCount();
		}
	}

	if(isset($MinChars))
	{
		if(strlen($Input) < $MinChars)
		{
			$this->ErrorString = "Your string must be over " . $MinChars . " Chars";
		  $this->AddCount();
		}
	}
}

  public function SelectIntValidation($Input,$Required = 1) //If the select uses ints (wont work with string)(use 0 as first select)
  {
    if($Required == 1)
    {
    	if($Input == 0) //Check if not selected
    	{
    		$this->ErrorSelect = "Please Select a category";
    	   $this->AddCount();
    	}
    }
  }


  function IntValidation($Input)
  {
  	if(empty($Input)) //Check if empty
  	{
      $this->ErrorInt = "Has to be an int";
       $this->AddCount();
  	}

  	if(!is_int($Input))
  	{
      $this->ErrorInt = "Has to be an int";
      $this->AddCount();
  	}
  }





}

































 ?>

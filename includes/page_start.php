<?php
include_once('includes/connection.php');

include_once('class/item.class.php');
include_once('class/validation.class.php');

include_once('func/func_fetch.php');


//Item class
$item = new items($db);
//Validation class
$Vali = new Validation();



//item submission
if(isset($_POST['ItemSubmit']))
{
       $Vali->URLValidation($_POST['ItemLink']); //Validate URL
       $Vali->StringValidation($_POST['ItemName'],4,50); //Validate String
       $Vali->SelectIntValidation($_POST['ItemCat']);//Validate Select (int)

       if($Vali->Count == 0) //check if any errors
       {
              $item->add($_POST['ItemName'],$_POST['ItemLink'],$_POST['ItemCat']);
       }
}


//item update
if(isset($_POST['ItemUpdate']))
{
       $Vali->URLValidation($_POST['ItemLink']); //Validate URL
       $Vali->StringValidation($_POST['ItemName'],4,50); //Validate String
       $Vali->SelectIntValidation($_POST['ItemCat']);//Validate Select (int)

       if($Vali->Count == 0) //check if any errors
       {
              $item->update($_GET['IID'],$_POST['ItemName'],$_POST['ItemLink'],$_POST['ItemCat']);
       }
}


//Item Deletion
if(isset($_POST['ItemDelete']))
{
       $item->delete($_POST['ItemID']);
}

//item Privatize
if(isset($_POST['ItemPrivatize']))
{
       $item->privatizeItem($_POST['ItemID']);
}
























//

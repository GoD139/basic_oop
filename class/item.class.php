<?php
//Item class
class items
{
       protected $DB = null;

       public $SuccessAdd = '';
       public $SuccessDelete = '';
       public $SuccessUpdate = '';

       private $Date;
       private $ItemStatus = 1;

       public function __construct( PDO  $db )
       {
              $this->Date = date('Y-m-d H:i:s');
              $this->DB = $db;
       }

       //Add items
       public function add($Name,$Link,$Category)
       {
              $sql = $this->DB->prepare("INSERT INTO items (Item_Name,Item_Link,Item_Date,Item_Status,FK_Cat_ID) VALUES (:Item_Name,:Item_Link,'$this->Date','$this->ItemStatus',:FK_Cat_ID);");
              $sql->bindParam(':FK_Cat_ID', $Category, PDO::PARAM_INT);
              $sql->bindParam(':Item_Name', $Name, PDO::PARAM_STR);
              $sql->bindParam(':Item_Link', $Link, PDO::PARAM_STR);

              $sql->execute();
              $this->SuccessAdd = '<div class="alert alert-success alert-dismissible fade in" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> <strong>Success!</strong> Item have successfully been added</div>';
       }

       //Delete items
       public function delete($ItemID)
       {
              $sql = $this->DB->prepare("DELETE FROM items WHERE Item_ID = '$ItemID'");
              $sql->execute();
              $this->SuccessDelete = '<div class="alert alert-success alert-dismissible fade in" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> <strong>Success!</strong> Item have successfully been deleted</div>';
       }

       //Update items
       public function update($ItemID,$Name,$Link,$Category)
       {
              $sql = $this->DB->prepare("UPDATE items SET Item_Name = '$Name', Item_Link='$Link', FK_Cat_ID='$Category' WHERE Item_ID ='$ItemID';");
              $sql->execute();
              $this->SuccessUpdate = '<div class="alert alert-success alert-dismissible fade in" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> <strong>Success!</strong> Item have successfully been updated</div>';
       }

       //Privatize item
       function privatizeItem($Item_ID)
       {
              $GetItem = $this->DB->prepare("SELECT * FROM items WHERE Item_ID = '$Item_ID'");
              $GetItem->execute();

              if($GetItem->rowCount() !== 0)
              {
                     foreach($GetItem->fetchAll(PDO::FETCH_OBJ) as $P)
                     {
                            if($P->Item_Status == 0)
                            {
                                   $stmt = $this->DB->prepare('UPDATE items SET Item_Status = 1 WHERE Item_ID = "'.$Item_ID.'"');
                                   $stmt->execute();
                            }
                            else
                            {
                                   $stmt =  $this->DB->prepare('UPDATE items SET Item_Status = 0 WHERE Item_ID = "'.$Item_ID.'"');
                                   $stmt->execute();
                            }
                     }
              }
       }

       //Fetch an array of of one item
       public function FetchItem($ItemID)
       {
              if(isset($ItemID))
              {
                     $GetItem = $this->DB->prepare("SELECT * FROM items WHERE Item_ID = '$ItemID'");
                     $GetItem->execute();

                     if($GetItem->rowCount() === 0){header('location: index.php');} //if doesnt exist in db redirects

                     foreach($GetItem->fetchAll(PDO::FETCH_OBJ) as $I)
                     {
                            return array($I->Item_ID, $I->Item_Name, $I->Item_Link,$I->FK_Cat_ID);
                     }
              }
              else
              {
                     header('location: index.php');
              }
       }
}

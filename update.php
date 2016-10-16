<?php
include_once('includes/page_start.php');

  //put array into variables //   use for just an array: $item->updateData($_GET['IID']);
  list($ItemID, $ItemName, $ItemLink,$Cat_ID) = $item->FetchItem($_GET['IID']);




?>
<html>
<head>
  <title>Wishlist</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body>

  <div class="col-md-12">
    <div class="col-md-6 col-md-offset-3">
      <a href="index.php">Back</a>
      <br /><br /><br /><br />

      <div class="col-md-8">

        <h3>Update item nr. <span class="text-primary"><?php echo $ItemID; ?></span></h3>
          <form method="post">

            <input type="text" name="ItemName" placeholder="Item name here" value="<?php echo $ItemName; ?>" class="form-control" />
            <label class="text-danger"><?php echo $Vali->ErrorString; ?></label>


            <select name="ItemCat" class="form-control">
              <?php

              $sql = $db->prepare("SELECT * FROM category WHERE Cat_ID ='$Cat_ID' ");
              $sql->execute();

              foreach($sql->fetchAll(PDO::FETCH_OBJ) as $fetch)
              {
                echo '<option value="'.$fetch->Cat_ID.'" selected>'.$fetch->Cat_Name.'</option>';
              }


              $sql = $db->prepare("SELECT * FROM category WHERE Cat_ID !='$Cat_ID' ");
              $sql->execute();

              foreach($sql->fetchAll(PDO::FETCH_OBJ) as $fetch)
              {
                echo '<option value="'.$fetch->Cat_ID.'" >'.$fetch->Cat_Name.'</option>';
              }
               ?>
            </select>
            <label class="text-danger"><?php echo $Vali->ErrorSelect; ?></label>



            <input type="text" name="ItemLink" placeholder="Item URL here" value="<?php echo $ItemLink; ?>"  class="form-control" />
            <label class="text-danger"><?php echo $Vali->ErrorURL; ?></label>
            <input type="submit" name="ItemUpdate" value="Update" class="btn btn-success btn-block" />
          </form>


          <!--Delete item form-->
          <form method="post">
            <input type="hidden" name="ItemID" value="<?php echo $ItemID; ?>">
            <input type="submit" name="ItemDelete" value="Delete" class="btn btn-danger" />
          </form>
          <?php echo $item->SuccessUpdate; ?>
          <br /><br /><br /><br />
      </div>

    </div>
  </div>
</body>
</html>

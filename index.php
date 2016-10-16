<?php
include_once('includes/page_start.php');
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

      <br /><br /><br /><br />

      <!--SUBMIT FORM-->
      <div class="col-md-4">
        <h3>Submit item</h3>
          <form method="post">
            <input type="text" name="ItemName" placeholder="Item name here" class="form-control" />
            <label class="text-danger"><?php echo $Vali->ErrorString; ?></label>

            <select name="ItemCat" class="form-control">
              <option value="0"  selected>Choose a category</option>
              <?php

              $sql = $db->prepare('SELECT * FROM category');
              $sql->execute();

              foreach($sql->fetchAll(PDO::FETCH_OBJ) as $fetch)
              {
                echo '<option value="'.$fetch->Cat_ID.'" >'.$fetch->Cat_Name.'</option>'; 
              }

               ?>
            </select>
            <label class="text-danger"><?php echo $Vali->ErrorSelect; ?></label>

            <input type="text" name="ItemLink" placeholder="Item URL here"  class="form-control" />
            <label class="text-danger"><?php echo $Vali->ErrorURL; ?></label>
            <input type="submit" name="ItemSubmit" value="Save" class="btn btn-success btn-block" />
          </form>
          <?php echo $item->SuccessAdd; ?>
          <br /><br /><br /><br />
      </div>

      <!--Private list-->
      <div class="col-md-4">
        <h3>Privatized list</h3>
        <?php FetchPrivatizedList(); ?>
          <br /><br /><br /><br />
      </div>






<?php  FetchItemList(); ?>



      <?php echo $item->SuccessDelete; ?>
    </div>
  </div>
</body>
</html>

<?php





function FetchItemList()
{
  global $db;

  $sql = $db->prepare('SELECT * FROM category');
  $sql->execute();

  foreach($sql->fetchAll(PDO::FETCH_OBJ) as $f)
  {

    $count = $db->prepare('SELECT * FROM items WHERE Item_Status = 1 AND FK_Cat_ID = "'.$f->Cat_ID.'"');
    $count->execute();

    if($count->rowCount() > 0)
    {
  echo '
  <table class="table table-striped">
  <tr>
    <th>'.$f->Cat_Name.'</th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
  </tr>';

  $sql = $db->prepare('SELECT * FROM items WHERE Item_Status = 1 AND FK_Cat_ID = "'.$f->Cat_ID.'"');
  $sql->execute();

  foreach($sql->fetchAll(PDO::FETCH_OBJ) as $fetch)
  {
    echo '
    <tr>
      <td style="width:300px;">'.$fetch->Item_Name.'</td>
      <td><a href="'.$fetch->Item_Link.'" class="btn btn-primary" target="_blank">Visit site</a></td>
      <td><a href="update.php?IID='.$fetch->Item_ID.'" class="btn btn-primary" ><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
      <td>
        <form method="post">
          <Input type="hidden" Name="ItemID" value="'.$fetch->Item_ID.'" />
          <button type="submit" Name="ItemPrivatize" class="btn btn-warning" ><i class="fa fa-eye" aria-hidden="true"></i></button>
        </form>
      </td>
      <td>
        <form method="post">
          <Input type="hidden" Name="ItemID" value="'.$fetch->Item_ID.'" />
          <button type="submit" Name="ItemDelete" class="btn btn-danger" ><i class="fa fa-trash-o" aria-hidden="true"></i></button>
        </form>
      </td>
    </tr>';
  }
  echo '</table>';
  }
}
}




function FetchPrivatizedList()
{
  global $db;

  $sql = $db->prepare('SELECT * FROM category');
  $sql->execute();

  foreach($sql->fetchAll(PDO::FETCH_OBJ) as $f)
  {

    $count = $db->prepare('SELECT * FROM items WHERE Item_Status = 0 AND FK_Cat_ID = "'.$f->Cat_ID.'"');
    $count->execute();

    if($count->rowCount() > 0)
    {
  echo '
  <table class="table table-striped">
  <tr>
    <th>'.$f->Cat_Name.'</th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
  </tr>';

  $sql = $db->prepare('SELECT * FROM items WHERE Item_Status = 0 AND FK_Cat_ID = "'.$f->Cat_ID.'"');
  $sql->execute();

  foreach($sql->fetchAll(PDO::FETCH_OBJ) as $fetch)
  {
    echo '
    <tr>
      <td style="width:300px;">'.$fetch->Item_Name.'</td>
      <td><a href="'.$fetch->Item_Link.'" class="btn btn-primary" target="_blank">Visit site</a></td>
      <td><a href="update.php?IID='.$fetch->Item_ID.'" class="btn btn-primary" ><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
      <td>
        <form method="post">
          <Input type="hidden" Name="ItemID" value="'.$fetch->Item_ID.'" />
          <button type="submit" Name="ItemPrivatize" class="btn btn-warning" ><i class="fa fa-eye" aria-hidden="true"></i></button>
        </form>
      </td>
      <td>
        <form method="post">
          <Input type="hidden" Name="ItemID" value="'.$fetch->Item_ID.'" />
          <button type="submit" Name="ItemDelete" class="btn btn-danger" ><i class="fa fa-trash-o" aria-hidden="true"></i></button>
        </form>
      </td>
    </tr>';
  }
  echo '</table>';
  }
}
}






































 ?>

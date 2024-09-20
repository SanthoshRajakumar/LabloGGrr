

<!-- ELSA --> 
<h1 style="font-size: 50px">Admin page</h1>

<style>
  .button {
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
  }

  .button5 {
    background-color: white;
    color: black;
    border: 2px solid #551555;
  }

  .button5:hover {
    background-color: #551555;
    color: white;
  }
</style>

<form action="create_room.php" method="POST">
    <input type="submit" value="Create room/shelfs/storage" class="button button5"/>
</form>

<form action="create_course.php" method="POST">
  <input type="submit" value="Create course" class="button button5" />
</form>

<form action="inventory.php" method="POST">
  <input type="submit" value="Inventory" class="button button5"/>
</form>



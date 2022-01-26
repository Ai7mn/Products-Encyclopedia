<!DOCTYPE html>
<html>
<head>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>


  <script src="https://kit.fontawesome.com/5866728add.js" crossorigin="anonymous"></script>
<style>

  .Nav {
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #333;
}

.Nav .logo h4{
  display: block;
  color:  #e0ac1c;
  text-align: center;
  padding-top: 5px;
  padding-left: 10px;
  text-decoration: none;
  float:left;

      /* if you want it vertically middle of the navbar. */
}
body {
   min-height: 400px;
   margin-bottom: 205px;
   clear: both;
}

ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #333;
}

li {
  float: right;
}

li a {
  display: block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

li a:hover:not(.active) {
  background-color: #111;
}

li a.active {
  background-color: #e0ac1c;
}


    .search input[type=text]{
        width:300px;
        height:25px;
        padding-left: 10px;
        border-radius:25px;
        border: none;
    }

    .search{
        float:right;
        margin:10px;
        padding-top: 5px;
    }

    .search button{
        background-color: #e0ac1c;
        color: #f2f2f2;
        float: right;
        padding: 5px 10px;
        margin-right: 10px;
        margin-left: 10px;
        font-size: 12px;
        border: none;
        cursor: pointer;
    }

</style>
</head>
<body>



<div class="Nav">

   <div class ="logo">
        <h4>Product Encyclopedia</h4>
   </div>

   <div class="search">
            <form type= "GET" action="search.php">
                <input type="text" placeholder=" Search a Procduct" name="search-bar" />
                <button>
                    <i class="fa fa-search"
                        style="font-size: 18px;">
                    </i>

                </button>
            </form>
   </div>

          <ul>
            <?php
                if(!isset($_SESSION)){
                  session_start();
                }
                if(isset($_SESSION['username'])){

                 echo "<li><a class='active' href='index.php'>".$_SESSION['username']."</a></li>";
                 echo "<li><a href='logout.php'>Sign out</a></li>";
                 echo "<li ><a href='add.php'>Add</a></li>";
                 echo "<li ><a href='staff.php'>Home</a></li>";
               }
               else{
                 echo "<li ><a href='logs.php'>Visits Log</a></li>";
                 echo "<li ><a href='login.php'>Staff Login</a></li>";
                 echo "<li ><a href='index.php'>Home</a></li>";
             }

            ?>
          </ul>
</div>
</body>
</html>

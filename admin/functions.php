<?php include_once "../includes/functions.php"; //sql funkcije koje sam koristio i za sajt ?>
<?php

//redirekcija
function redirect($location){


    header("Location:" . $location);
    exit;

}

//da li je method zahtevan
function ifItIsMethod($method=null){

    if($_SERVER['REQUEST_METHOD'] == strtoupper($method)){

        return true;

    }

    return false;

}
//da li je loginovan korisnik
function isLoggedIn(){

    if(isset($_SESSION['user_role'])){

        return true;


    }


   return false;

}

//provera pri loginu
function checkIfUserIsLoggedInAndRedirect($redirectLocation=null){

    if(isLoggedIn()){

        redirect($redirectLocation);

    } else {
        echo '
        <script>alert("Proverite svoj username i šifru\nProbajte ponovo!");
        location.href = "../login.php";
        </script>';
        
    }

}




//escapestring
function escape($string) {

global $connection;

return mysqli_real_escape_string($connection, trim($string));


}
// proveri da li je izvrsen upit
function confirmQuery($result) {
    
    global $connection;

    if(!$result ) {
          
          die("QUERY FAILED ." . mysqli_error($connection));
   
          
      }
    

}


// dodaj nove zanrove
function insert_categories(){
    
    global $connection;

        if(isset($_POST['submit'])){

            $cat_title = $_POST['cat_title'];

        if($cat_title == "" || empty($cat_title)) {
        
             echo "Polje ne sme biti prazno!";
       return 0;
    
    } else {





    $stmt = mysqli_prepare($connection, "INSERT INTO categories(cat_title) VALUES(?) ");

    mysqli_stmt_bind_param($stmt, 's', $cat_title);

    mysqli_stmt_execute($stmt);


        if(!$stmt) {
        die('QUERY FAILED'. mysqli_error($connection));
        
                  }


        
             }

             
    mysqli_stmt_close($stmt);
   
        
       }

}

// prikazi sve zanrove
function findAllCategories() {
global $connection;

    $query = "SELECT * FROM categories";
    $select_categories = mysqli_query($connection,$query);  

    while($row = mysqli_fetch_assoc($select_categories)) {
    $cat_id = $row['cat_id'];
    $cat_title = $row['cat_title'];

    echo "<tr>";
        
    echo "<td>{$cat_id}</td>";
    echo "<td>{$cat_title}</td>";
    echo "<td style='font-size: 2rem; text-align: center;'><a href='categories.php?edit={$cat_id}'><i class='fa fa-fw fa-edit'></i></a></td>";
    echo "<td style='font-size: 2rem; text-align: center;'><a href='categories.php?delete={$cat_id}' onclick=\"return confirm('Da li ste sigurni da želite da obrišete?');\"><i class='fa fa-fw fa-times-circle'></i></a></td>";
  
    echo "</tr>";

    }


}

// izbrisi zanr
function deleteCategories(){
global $connection;

    if(isset($_GET['delete'])){
    $the_cat_id = $_GET['delete'];
    $query = "DELETE FROM categories WHERE cat_id = {$the_cat_id} ";
    $delete_query = mysqli_query($connection,$query);
    header("Location: categories.php");


    }
            


}
// funkcija za logovanje koja se poziva u login.php
 function login_user($username, $password)
 {

     global $connection;

     $username = trim($username);
     $password = trim($password);

     $username = mysqli_real_escape_string($connection, $username);
     $password = mysqli_real_escape_string($connection, $password);


     $query = "SELECT * FROM korisnici WHERE username = '{$username}' ";
     $select_user_query = mysqli_query($connection, $query);
     if (!$select_user_query) {

         die("QUERY FAILED" . mysqli_error($connection));

     }


     while ($row = mysqli_fetch_array($select_user_query)) {

        $db_user_id = $row['id'];
        $db_username = $row['username'];
        $db_user_password = $row['password'];
        $db_user_firstname = $row['ime'];
        $db_user_lastname = $row['prezime'];
        $db_user_role = $row['uloga'];
        $db_user_email = $row['email'];
        $db_user_image = $row['avatar'];


         if (password_verify($password,$db_user_password)) {

            $_SESSION['user_id'] = $db_user_id ;
            $_SESSION['username'] = $db_username ;
            $_SESSION['password'] = $db_user_password;
            $_SESSION['firstname'] = $db_user_firstname;
            $_SESSION['lastname'] = $db_user_lastname;
            $_SESSION['user_role'] = $db_user_role;
            $_SESSION['email'] = $db_user_email;
            $_SESSION['image'] = $db_user_image;



             redirect("/filmoteka/admin/filmovi.php?str=1");


         } else {
            
            redirect("/filmoteka/login.php");
             return false;
             


         }



     }

     return true;

 }
 //SQL Functions









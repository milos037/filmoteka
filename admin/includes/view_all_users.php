<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Ime</th>
            <th>Prezime</th>
            <th width="100px;">Slika</th>
            <th>Email</th>    
            <th>Uloga</th>
            <th>Datum</th>
            <th>Akcija</th>
            
            
        </tr>
    </thead>
    <tbody>


        <?php

                        $query = "SELECT * FROM users";
                        $select_users = mysqli_query($connection, $query);
                 
                        while($row = mysqli_fetch_assoc($select_users)){
                        $user_id = $row['user_id'];
                        $username = $row['username'];
                        $user_password = $row['user_password'];
                        $user_firstname = $row['user_firstname'];
                        $user_lastname = $row['user_lastname'];
                        $user_email = $row['user_email'];
                        $user_image = $row['user_image'];
                        $user_role = $row['user_role'];
                     
                        if ($user_role == 'subscriber'){
                            $user_role = 'korisnik';
                        }
                        
                        echo "<tr>";
                        echo "<td>$user_id</td>";
                        echo "<td>$username</td>"; 
                        echo "<td>$user_firstname</td>";   
                        echo "<td>$user_lastname</td>";
                        echo "<td><img src='../images/$user_image' width='30px'</td>";
                        echo "<td>$user_email</td>";
                        echo "<td>$user_role</td>";
                        echo "<td>" . date('d-m-Y') . "</td>";                           

                        echo "<td><a href='users.php?source=edit_user&u_id={$user_id}'><i class='fa fa-fw fa-edit'></i>Izmeni</a>";
                        echo "<a style='margin-left: 20px;'href='users.php?delete={$user_id}' onclick=\"return confirm('Da li ste sigurni da želite da izbrišete korisnika?');\"><i class='fa fa-fw fa-times-circle'></i>Izbriši</a></td>";
                        
                        
                        echo "</tr>";                  
                            
                            
    
    if(isset($_GET['delete'])){
    
    $the_user_id = $_GET['delete'];
    $query = "DELETE FROM users WHERE user_id = {$the_user_id}";
    $delete_user_query = mysqli_query($connection, $query);
    header("Location: users.php");
}}
?>

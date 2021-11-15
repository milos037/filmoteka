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
        $query = "SELECT * FROM korisnici";
        $select_users = mysqli_query($connection, $query);
                 
        while($row = mysqli_fetch_assoc($select_users)):
            $korisnik_id = $row['id'];
            $username = $row['username'];
            $korisnik_sifra = $row['password'];
            $korisnik_ime = $row['ime'];
            $korisnik_prezime = $row['prezime'];
            $korisnik_email = $row['email'];
            $korisnik_avatar = $row['avatar'];
            $korisnik_uloga = $row['uloga'];
            
            if ($korisnik_uloga == 'subscriber')
                $korisnik_uloga = 'korisnik';
            
            echo "<tr>";
            echo "<td>$korisnik_id</td>";
            echo "<td>$username</td>"; 
            echo "<td>$korisnik_ime</td>";   
            echo "<td>$korisnik_prezime</td>";
            echo "<td><img src='../images/$korisnik_avatar' width='30px'</td>";
            echo "<td>$korisnik_email</td>";
            echo "<td>$korisnik_uloga</td>";
            echo "<td>" . date('d-m-Y') . "</td>";                           

            echo "<td><a href='korisnici.php?source=izmeni_korisnika&k_id={$korisnik_id}'><i class='fa fa-fw fa-edit'></i>Izmeni</a>";
            echo "<a style='margin-left: 20px;'href='korisnici.php?izbrisi={$korisnik_id}' onclick=\"return confirm('Da li ste sigurni da želite da izbrišete korisnika?');\"><i class='fa fa-fw fa-times-circle'></i>Izbriši</a></td>";
            
            
            echo "</tr>";                               
    endwhile;
    if(isset($_GET['izbrisi'])):
        $korisnik_id = $_GET['izbrisi'];
        $query = "DELETE FROM korisnici WHERE id = {$korisnik_id}";
        $delete_user_query = mysqli_query($connection, $query);
        header("Location: korisnici.php");
    endif;
?>

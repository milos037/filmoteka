<?php include "db.php"; 

// Now we check if the data was submitted, isset() function will check if the data exists.
if (!isset($_POST['username'], $_POST['password'])) {
	// Could not get the data that should have been sent.
	die ('Molim Vas da popunite registracionu formu.');
}
// Make sure the submitted registration values are not empty.
if (empty($_POST['username']) || empty($_POST['password'])) {
	// One or more values are empty.
	die ('Molim Vas da popunite registracionu formu.');
}

/*
if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
	die ('Email is not valid!');
}
if (preg_match('/[A-Za-z0-9]+/', $_POST['username']) == 0) {
    die ('Username is not valid!');
}
if (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 5) {
	die ('Password must be between 5 and 20 characters long!');
}
*/


// We need to check if the account with that username exists.
if ($stmt = $connection->prepare('SELECT id, password FROM korisnici WHERE username = ?')) {
	// Bind parameters (s = string, i = int, b = blob, etc), hash the password using the PHP password_hash function.
	$stmt->bind_param('s', $_POST['username']);
	$stmt->execute();
	$stmt->store_result();
	// Store the result so we can check if the account exists in the database.
	if ($stmt->num_rows > 0) {
		// Username already exists
		echo 'Korisnicko ime vec postoji, probajte neko drugo!';
	} else {
		      // Username doesnt exists, insert new account
if ($stmt = $connection->prepare('INSERT INTO korisnici (username, password , email, uloga, ime , prezime, avatar) VALUES (?, ?, ?, "subscriber", ?, ?, "new-user.png")')) {
	// We do not want to expose passwords in our database, so hash the password and use password_verify when a user logs in.
	$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
	$stmt->bind_param('sssss', $_POST['username'], $password, $_POST["email"], $_POST['firstname'] , $_POST['lastname']);
	$stmt->execute();
    echo '
    <script>alert("Uspešno ste se registrovali\nSada se možete ulogovati!")
        window.location.href = "../login.php";
    </script>';
} else {
	// Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
	echo 'Fatalna greška';
}
	}
	$stmt->close();
} else {
	// Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
	echo 'Fatalna greška';
}
$connection->close();
?>
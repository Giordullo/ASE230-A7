<?php
require_once('CSVHelper.php');

class AuthHelper
{
	// add parameters
	static function signup($email, $password)
	{
		// add the body of the function based on the guidelines of signup.php
		
		// check if the fields are empty
		if(!isset($email))
			die('please enter your email');
		if(!isset($password)) 
			die('please enter your password');

		// check if the email is valid
		if(!filter_var($email, FILTER_VALIDATE_EMAIL)) 
			die('Your email is invalid');

		// check if password length is between 8 and 16 characters
		if(strlen($password) < 8) 
			die('Please enter a password >=8 characters');

		// check if the password contains at least 2 special characters
		if (!preg_match('/[\'^£$%&*!()}{@#~?><>,|=_+¬-]/', $password))
			die('Please enter atleast 2 special characters in your password');

		// check if the email has not been banned
		$bannedArray = CSVHelper::read("banned.csv.php");

		foreach ($bannedArray as $banned)
		{
			if ($email == $banned[0])
				die('This email has been banned');
		}

		// check if the email is in the database already
		$usersArray = CSVHelper::read("users.csv.php");

		foreach ($usersArray as $user)
		{
			if ($email == $user[0])
				die('This email is already in use');
		}

		// encrypt password
		$passwordHash = hash("sha256", $password);

		// save the user in the database 
		$userObj = [$email, $passwordHash];

		CSVHelper::write("users.csv.php", $userObj);

		// show them a success message and redirect them to the sign in page
		//header('Location: ../auth/signin.php');
		print("Signed Up!");
	}

	// add parameters
	static function signin($email, $password)
	{		
		// add the body of the function based on the guidelines of signin.php

		// 1. check if email and password have been submitted
		if(!isset($email))
			die('please enter your email');
		if(!isset($password)) 
			die('please enter your password');

		// 2. check if the email is well formatted
		if(!filter_var($email, FILTER_VALIDATE_EMAIL)) 
			die('Your email is invalid');

		// 3. check if the password is well formatted
		// check if password length is between 8 and 16 characters
		if(strlen($password) < 8) 
			die('Please enter a password >=8 characters');

		// check if the password contains at least 2 special characters
		if (!preg_match('/[\'^£$%&*!()}{@#~?><>,|=_+¬-]/', $password))
			die('Please enter atleast 2 special characters in your password');

		// 4. check if the file containing banned users exists
		if (!file_exists("banned.csv.php"))
		{
			$myfile = fopen("banned.csv.php", "w");
			fwrite($myfile, "<?php die() ?>");
			fclose($myfile);	
		}

		// 5. check if the email has not been banned
		$bannedArray = CSVHelper::read("banned.csv.php");

		foreach ($bannedArray as $banned)
		{
			if ($email == $banned[0])
				die('This email has been banned');
		}

		// 7. check if the email is registered
		$usersArray = CSVHelper::read("users.csv.php");
		$registered = false;
		$registeredIndex = -1;

		$i = 0;
		foreach ($usersArray as $user)
		{
			if ($email == $user[0])
			{
				$registered = true;
				$registeredIndex = $i;
			}
			$i++;
		}

		if (!$registered)
			die('This email is not registered to an account');

		// 8. check if the password is correct
		if ($usersArray[$registeredIndex][1] != hash("sha256", $password))
			die('Password is incorrect');

		// 9. store session information
		$_SESSION['logged'] = true;

		// 10. redirect the user to the members_page.php page
		//header('Location: ../index.php');	
		print("Logged In!");
	}

	static function signout()
	{
		// add the body of the function based on the guidelines of signout.php
		$_SESSION['logged'] = false;
		//header('Location: ../index.php');	
		print("Logged out!");
	}

	static function is_logged()
	{			
		if (!isset($_SESSION['logged']) || is_null($_SESSION['logged']) || empty($_SESSION['logged']))
			$_SESSION['logged'] = false;
		
		return $_SESSION['logged'];
	}
}
?>
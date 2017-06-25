<?php

require_once('../mysqlconfig.php');


function sec_session_start(){
	$session_name = 'sec_session_id';
	$secure = true;
	$httponly = true;
		// Forces sessions to only use cookies.
	if(ini_set('session.use_only_cookies', 1) === false){
			// header("Location: /error.php?err=Could not initiate a safe session (ini_set)");
		exit();
	}
		// Gets current cookies params.
	$currentCookieParams = session_get_cookie_params(); 

	session_set_cookie_params( 
		$currentCookieParams["lifetime"], 
		$currentCookieParams["path"], 
		$currentCookieParams["domain"], 
		$currentCookieParams["secure"], 
		$currentCookieParams["httponly"] 
		); 

	session_name('blogSession'); 
	session_start();
	
}

function login ($user, $password, $dbc){
	
	$query = "SELECT password, salt
	FROM users
	WHERE nome_user = ?
	LIMIT 1";

	if($stmt = mysqli_prepare($dbc, $query)) {

		mysqli_stmt_bind_param($stmt, 's', $user);
        $stmt->execute();    // Execute the prepared query.
        $stmt->store_result();

        $stmt->bind_result($db_password, $salt);
        $stmt->fetch();
        if($stmt->num_rows == 1){

            $password = hash('sha512', $password);
            $password = hash('sha512', $password . $salt);

            if($db_password == $password){
                $user_browser = $_SERVER['HTTP_USER_AGENT'];
                $_SESSION['user'] = $user;
                $_SESSION['login_string'] = hash('sha512', $password.$user_browser);
                return 'true';
            }
            else {
                /* return 'false'; */
            }
        }
    }
    else {
        return 'false';
    } 
}

?>



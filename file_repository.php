<?php
function findUserByEmail($email){
    $fileContent = fopen("users.txt", "r");
    $user = null;

    while (!feof($fileContent)) {
        $line = fgets($fileContent);
        $userData = explode("|", $line, 3);

        if ($userData[0] == $email) {
            $user = array(
                'email' => trim($userData[0]),
                'username' => trim($userData[1]),
                'password' => trim($userData[2])
            );
            break;
        }
    }
        fclose($fileContent);
        return $user;
}


function saveUser($email, $username, $password){
    $fileContent = fopen("users.txt", "a");
    fwrite($fileContent, "\n$email|$username|$password");
    fclose($fileContent);
}
?>
<?php
function testInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function logError($message) {
    echo "LOGGING TO THE SERVER: ". $message;
}
?>
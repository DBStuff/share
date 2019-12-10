<?php
header('Access-Control-Allow-Origin: *');  
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: GET,HEAD,OPTIONS,POST,PUT");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Origin,Accept, X-Requested-With, Content-Type, Access-Control-Request-Method, Access-Control-Request-Headers");
$db = new SQLite3('/Applications/MAMP/db/sqlite/flowers2019.db');
if($_GET["action"] == "listFlowers"){
    $results = $db->query('SELECT * FROM FLOWERS;');
    while ($row = $results->fetchArray()) {
        print json_encode($row)."|";
    }
}
else if($_GET["action"] == "getSightings"){
    $results = $db->query('SELECT * FROM SIGHTINGS WHERE name = '.$_GET["name"].' ORDER BY sighted DESC LIMIT 10;');
    while ($row = $results->fetchArray()) {
        print json_encode($row)."|";
    }
}
else if($_GET["action"] == "updateFlower"){
    $results = $db->exec('UPDATE FLOWERS SET genus = "'.$_GET["genus"].'", species = "'.$_GET["species"].'", comname = "'.$_GET["comname"].'" WHERE comname = "'.$_GET["oldName"].'";');
    $results = $db->exec('UPDATE SIGHTINGS SET name = "'.$_GET["comname"].'" WHERE name = "'.$_GET["oldName"].'";');
    rename("flower_pics/".$_GET["oldName"].".jpg", "flower_pics/".$_GET["comname"].".jpg");
}
else if($_GET["action"] == "createSighting"){
    $results = $db->exec('
        BEGIN TRANSACTION;
            INSERT INTO SIGHTINGS VALUES("'.$_GET["name"].'", "'.$_GET["person"].'", "'.$_GET["location"].'", "'.$_GET["sighted"].'");
        COMMIT;
        ');
        print '
        BEGIN TRANSACTION;
            INSERT INTO SIGHTINGS VALUES("'.$_GET["name"].'", "'.$_GET["person"].'", "'.$_GET["location"].'", "'.$_GET["sighted"].'");
        COMMIT;
        ';
}
else if($_GET["action"] == "signup"){
    $password = password_hash($_GET["password"], PASSWORD_DEFAULT);
    $results = $db->exec('INSERT INTO USERS VALUES("'.$_GET["username"].'", "'.$password.'")');
}
else if($_GET["action"] == "login"){
    $results = $db->query('SELECT password FROM USERS WHERE username = "'.$_GET["username"].'"');
    if(json_encode(password_verify($_GET["password"], $results->fetchArray()['password'])) == "true"){
        print 'success';
    }
    else{
        print 'fail';
    }
}
?>
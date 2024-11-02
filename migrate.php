<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cake_project";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected successfully";
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

$excutedMigrations = $conn->query("SELECT migration FROM migrations")->fetchAll(PDO::FETCH_COLUMN);
// var_dump(value: $excutedMigrations);
$migrationFiles = scandir(__DIR__.'/migrations');
//var_dump($migrationFiles);
$batch = (int) $conn->query("SELECT MAX(batch) FROM migrations")->fetchColumn() + 1;

foreach ($migrationFiles as $file){
    echo "". $file ."";
    if($file === "." || $file === ".."){
        continue;
    }
$className = convertToClassName( pathinfo($file,PATHINFO_FILENAME));

var_dump( $className ); 

if(!in_array($className, $excutedMigrations)){
    // var_dump($excutedMigrations);
    require __DIR__.'/migrations/'.$file;
    $migration = new $className();
    // var_dump( $migration );
    
    $conn->exec($migration->up());
    $stmt = $conn->prepare("INSERT INTO migrations (migration,batch) VALUES (?, ?);");
    $stmt->execute([$className, $batch]);

    echo "migration $className executed successfully";
}
}

function convertToClassName($file){
    $fileNameWithoutDate = preg_replace('/^(\d{4}_\d{2}_\d{2})_/', '', $file);
    ///var_dump($fileNameWithoutDate);
    $className = '';
    $parts = explode('_', $fileNameWithoutDate);
    foreach ($parts as $part){
        
        $className .= ucfirst($part);

    }
    return $className;

    }

?>

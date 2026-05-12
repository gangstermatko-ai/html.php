<?php

$dsn = "mysql:host=localhost;dbname=myfirstdatabase";
$dbusername = "root";
$dbpassword = "";

try {
    $pdo = new PDO($dsn, $dbusername, $dbpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "zle pripojenie: ". $e->getMessage();   
}

//vraj lepsi tento dole ale je to to iste
<?php

// 1. ADRESA A MENO: Nastavíme si základné údaje (ako adresa bydliska).
$host = 'localhost';       // Kde beží databáza? (localhost = tento istý počítač)
$dbname = 'myfirstdatabase'; // Názov konkrétnej krabice (databázy), do ktorej sa chceme pozrieť.
$dbusername = 'root';      // Prihlasovacie meno (root je u začiatočníkov štandard).
$dbpassword = '';          // Heslo (v XAMPP/MAMP býva často prázdne).

// 2. SKÚŠKA SPOJENIA: Použijeme blok "try - catch". 
// Je to ako povedať: "Skús urobiť toto, a ak to nevyjde, urob niečo iné, aby sa nám nezrútil celý web."
try {
    
    /* 
       PDO (PHP Data Objects) je moderný spôsob komunikácie s databázou. 
       Vytvárame tu nový "objekt" pripojenia.
    */
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $dbusername, $dbpassword);
    
    /* 
       NASTAVENIE CHÝB: Hovoríme databáze: "Ak urobím v SQL dopyte chybu, 
       okamžite mi vyhoď jasnú hlášku (EXCEPTION), aby som vedel, kde je problém."
    */
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    
    /* 
       ZÁCHRANNÁ BRZDA: Ak sa pripojenie nepodarí (napr. zlé heslo), 
       vykoná sa tento kód. 
       die() - okamžite vypne stránku a vypíše, čo presne sa pokazilo.
    */
    die("Connection failed: " . $e->getMessage());
}

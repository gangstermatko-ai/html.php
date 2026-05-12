<?php

// 1. KONTROLA: Opäť kontrolujeme, či niekto odoslal formulár (POST).
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // 2. ZBER ÚDAJOV: Získame meno a heslo používateľa, ktorého ideme vymazať.
    $username = $_POST["username"];
    $pwd = $_POST["pwd"];
   
    try {
        // 3. PRIPOJENIE: Načítame náš súbor s pripojením na databázu.
        require_once "dbhinc.php";

        /* 
           4. SQL PRÍKAZ (DELETE): Toto je tá hlavná zmena. 
           Hovoríme: "VYMAŽ z tabuľky 'users' ten riadok, kde sa meno rovná :username 
           A ZÁROVEŇ sa heslo rovná :pwd."
        */
        $query = "DELETE FROM users WHERE username = :username AND pwd = :pwd;";

        // 5. PRÍPRAVA: Databáza si "prechrumpe" príkaz a čaká na bezpečné dodanie údajov.
        $stmt = $pdo->prepare($query);

        // 6. PREPOJENIE: Dosadíme reálne meno a heslo namiesto zástupných značiek.
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":pwd", $pwd);

        // 7. VYKONANIE: Príkaz sa spustí a používateľ je z databázy preč.
        $stmt->execute();

        // 8. UPRATANIE: Vynulujeme premenné, aby sme uvoľnili pamäť servera.
        $pdo = null;
        $stmt = null;

        // 9. ODCHOD: Pošleme človeka späť na domovskú stránku.
        header("Location: ../index.php");
        die();

    } catch (PDOException $e) {
        // Ak napríklad napíšeš zlý názov tabuľky, tu sa dozvieš chybu.
        die("query failed: " . $e->getMessage());
    }
}
else {
    // Ak sa niekto pokúsi súbor otvoriť len tak, hodí ho to na hlavnú stránku.
    header("Location: ../index.php");
}

<?php

// 1. ŠTART: Opäť kontrolujeme, či dáta prišli cez formulár (metóda POST).
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // 2. NOVÉ ÚDAJE: Do premenných si uložíme to, čo používateľ prepísal vo formulári.
    $username = $_POST["username"];
    $pwd = $_POST["pwd"];
    $email = $_POST["email"];

    try {
        // 3. SPOJENIE: Pripojíme sa na databázu cez tvoj overený súbor.
        require_once "dbhinc.php";

        /* 
           4. SQL PRÍKAZ (UPDATE): 
           Hovoríme: "AKTUALIZUJ tabuľku 'users'. 
           NASTAV (SET) meno na :username, heslo na :pwd a email na :email,
           ale urob to len TAM (WHERE), kde je ID používateľa rovné 2."
        */
        $query = "UPDATE users SET username = :username, pwd = :pwd, email = :email WHERE id = 2;";
 
        // 5. PRÍPRAVA: Bezpečne pripravíme tento príkaz (ochrana pred hackermi).
        $stmt = $pdo->prepare($query);

        // 6. DOSADENIE: Prepojíme tie "zástupné značky" s reálnymi hodnotami z formulára.
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":pwd", $pwd);
        $stmt->bindParam(":email", $email);

        // 7. ŠTART: Príkaz sa vykoná a databáza prepíše staré údaje novými.
        $stmt->execute();

        // 8. UPRATANIE: Odpojíme sa od databázy.
        $pdo = null;
        $stmt = null;

        // 9. KONIEC: Pošleme používateľa späť na index.php.
        header("Location: ../index.php");
        die();

    } catch (PDOException $e) {
        // Ak sa niečo nepodarí, vypíšeme chybu.
        die("query failed: " . $e->getMessage());
    }
}
else {
    // Ak niekto prišiel na tento súbor priamo, vyhodíme ho na hlavnú stránku.
    header("Location: ../index.php");
}

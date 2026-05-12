<?php

// 1. KONTROLA VSTUPU: Zisťujeme, či používateľ naozaj klikol na tlačidlo (odoslal formulár cez POST).
// Ak by len skúsil zadať adresu súboru do prehliadača, kód ho vyhodí (pozri úplne dole "else").
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // 2. ZBER DÁT: Zoberieme to, čo používateľ napísal do políčok v HTML formulári.
    $username = $_POST["username"];
    $pwd = $_POST["pwd"];
    $email = $_POST["email"];

    try {
        // 3. NAPOJENIE: "require_once" vloží kód z tvojho súboru dbhinc.php (to je ten kľúč k databáze, čo sme riešili minule).
        require_once "dbhinc.php";

        // 4. PRÍPRAVA ŠABLÓNY (SQL): Napíšeme príkaz pre databázu. 
        // Dôležité: Nepíšeme tam priamo premenné (to by bolo nebezpečné), ale používame "zástupné mená" ako :username.
        $query = "INSERT INTO users (username, pwd, email) VALUES(:username, :pwd, :email);";

        // 5. OCHRANA (Prepare): Povieme databáze, aby si túto šablónu pripravila. 
        // Toto chráni web pred útokmi (SQL Injection).
        $stmt = $pdo->prepare($query);

        // 6. PREPOJENIE (Bind): Povieme: "Do šablóny na miesto :username doplň to, čo napísal používateľ."
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":pwd", $pwd);
        $stmt->bindParam(":email", $email);

        // 7. VYKONANIE: Teraz to celé odpálime a dáta sa zapíšu do tabuľky.
        $stmt->execute();

        // 8. UPRATANIE: Zatvoríme spojenie s databázou a zrušíme pomocný objekt, aby sme nezaťažovali server.
        $pdo = null;
        $stmt = null;

        // 9. PRESMEROVANIE: Po úspechu pošleme používateľa späť na hlavnú stránku (index.php).
        header("Location: ../index.php");

        // Ukončíme skript.
        die();

    } catch (PDOException $e) {
        // Ak sa niečo po ceste pokazí (napr. databáza vypadne), vypíše to chybu.
        die("query failed: " . $e->getMessage());
    }
} 
else {
    // Ak niekto prišiel na tento súbor "náhodou" a nie cez formulár, pošleme ho preč.
    header("Location: ../index.php");
}

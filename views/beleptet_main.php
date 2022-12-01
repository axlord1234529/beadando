<?php 
if(isset($viewData['uzenet']))
{
    echo "<pre>";
    print_r($viewData['uzenet']);
    echo "</pre>";
}
?>

<h2>Belépés</h2>
<form action="<?= SITE_ROOT ?>beleptet" method="post">
    <fieldset>
        <legend>Belépés</legend>
            <br>
            <label for="login">Felhasználó:</label><input type="text" name="login" id="login" required pattern="[a-zA-Z][\-\.a-zA-Z0-9_]{3}[\-\.a-zA-Z0-9_]+"><br><br>
            <label for="password">Jelszó:</label><input type="password" name="password" id="password" required pattern="[\-\.a-zA-Z0-9_]{4}[\-\.a-zA-Z0-9_]+"><br><br>
            <input type="submit" value="Küldés">
    </fieldset>
</form>
<br>

<h3>Regisztrálja magát, ha még nem felhasználó!</h3>
<form action="<?= SITE_ROOT ?>beleptet" method="post">
    <fieldset>    
        <legend>Regisztráció</legend>
        <br>
        <label for="elonevReg">Elsö név:</label><input type="text" name="elonevReg" required><br><br>
        <label for="utonevReg">Utó név:</label><input type="text" name="utonevReg" required><br><br>
        <label for="felhasznalonevReg">Felhasznalo név:</label><input type="text" name="felhasznalonevReg" required pattern="[a-zA-Z][\-\.a-zA-Z0-9_]{3}[\-\.a-zA-Z0-9_]+"><br><br>
        <label for="jelszoReg"></label>Jelszó:<input type="password" name="jelszoReg" required pattern="[\-\.a-zA-Z0-9_]{4}[\-\.a-zA-Z0-9_]+"><br><br>
        <input type="submit" name="regisztracio" palceholder="Küldés"><br><br>
        <br>&nbsp;
    </fieldset>
</fomr>

<?= (isset($viewData['uzenet']) ? "Sikeres regisztráció" : "siekrtelen regisztracio") ?>
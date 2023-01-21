<?php 
if(isset($viewData['uzenet']))
{
    echo "".$viewData['uzenet']."";

}
?>
<div class="login-body">
<section class="wrapper">
    <div class="form signup">
        <header class="login header">Regisztráció</header>
        <form action="<?= SITE_ROOT ?>beleptet" method="post">
            <input type="text" name="elonevReg" required placeholder="Első név">
            <input type="text" name="utonevReg" required placeholder="Utó név">
            <input type="text" name="felhasznalonevReg" required  placeholder="Felhasználónév">
            <input type="password" name="jelszoReg" required  placeholder="Jelszó">
            <input type="submit" name="regisztracio" palceholder="Küldés">
        </form>
    </div>
    <div class="form login">
        <header class="login-header">Belépés</header>
        <form action="<?= SITE_ROOT ?>beleptet" method="post">
                <input type="text" name="login" id="login" placeholder="Felhasználó" required >
                <input type="password" name="password" id="password" placeholder="Jelszó" required >
                <input type="submit" value="Belépés">
        </form>
    </div>
</section>
</div>
<script src="<?php echo SITE_ROOT?>scripts/main.js"></script>


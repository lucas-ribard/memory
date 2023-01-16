<?php
if (isset($_POST['BT'])){
    echo "bruh";
    $CHOIX = (explode(" ", $_POST['BT']));
    $_SESSION['nbPaires'] = $CHOIX[0];
    header('Location:/memory/index.php');
}

?>

<form action="" method="post">
    <button class="cybr-btn">
        <input class="cybr-btn" type="submit" name="BT" value="3 Paires">
        <span aria-hidden class="cybr-btn__glitch">Buttons</span>
    </button>
    <br><br><br>
    <button class="cybr-btn">
        <input class="cybr-btn" type="submit" name="BT" value="6 Paires">
        <span aria-hidden class="cybr-btn__glitch">Buttons</span>
    </button>
    <br><br><br>

    <button class="cybr-btn">
        <input class="cybr-btn" type="submit" name="BT" value="9 Paires">
        <span aria-hidden class="cybr-btn__glitch">Buttons</span>
    </button>
    <br><br><br>

    <button class="cybr-btn">
        <input class="cybr-btn" type="submit" name="BT" value="12 Paires">
        <span aria-hidden class="cybr-btn__glitch">Buttons</span>
    </button>
    <br><br><br>
    <button class="cybr-btn">
        <input class="cybr-btn" type="submit" name="BT" value="15 Paires">
        <span aria-hidden class="cybr-btn__glitch">Buttons</span>
    </button>
    <br><br><br>
    <button class="cybr-btn">
        <input class="cybr-btn" type="submit" name="BT" value="18 Paires">
        <span aria-hidden class="cybr-btn__glitch">Buttons</span>
    </button>
    <br><br><br>
    <button class="cybr-btn">
        <input class="cybr-btn" type="submit" name="BT" value="21 Paires">
        <span aria-hidden class="cybr-btn__glitch">Buttons</span>
    </button>
    <br><br><br>
    <!--
    <button class="cybr-btn">
        <input class="cybr-btn" type="submit" name="BT" value="24 Paires">
        <span aria-hidden class="cybr-btn__glitch">Buttons</span>
    </button>
    <br><br>
-->
</form>


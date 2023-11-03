<?php
if (isset($_POST["mail"]))
{
    $ema = $_POST["mail"];
    $pas = $_POST["pass"];

    $con = new mysqli("10.10.10.199", "busters", "1234", "biblioteca");
    $sql = "SELECT * FROM administradores WHERE email_adm = '$ema'";

    $tup = $con->query($sql)->fetch_array();

    if ($tup) {
        $pas_hash = $tup["pass_adm"];
        if (password_verify($pas, $pas_hash)) {
            $cod = $tup["cod_adm"];
            session_start();
            $_SESSION["admin"] = $cod;
            header("location: ../index_administrador.php");
        }
        else {
            ?>
                    <script>
                        alert("Las credenciales introducidas son incorrectas");
                        window.location.href="../login_administrador.html";
                    </script>
                <?php
        }
    }
    else {
        ?>
                <script>
                    alert("Las credenciales introducidas son incorrectas");
                    window.location.href="../login_administrador.html";
                </script>
            <?php
    }
}
else
{
    header("location: ./login_administrador.html");
}


?>
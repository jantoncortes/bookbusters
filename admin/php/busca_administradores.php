<?php

$con=new mysqli("10.10.10.199","busters","1234","biblioteca");

$sql="SELECT * FROM administradores ORDER BY nom_adm";

if ($ej=$con->query($sql))
{
        foreach ($ej as $reg) {
                
                $cod=$reg["cod_adm"];
                $nom=$reg["nom_adm"];
                $email=$reg["email_adm"];
                ?>
                <tr id="campo_<?php echo $cod ?>">
                        <td><?php echo $nom?></td>
                        <td><?php echo $email?></td>
                        <td>
                                <i id = "dele_<?php echo $cod ?>" class="fa-solid fa-trash-can bs-danger" style="cursor:pointer;" onclick = "borrar_administrador(this.id)" onmouseover="pintar(this.id)" onmouseleave="despintar(this.id)"></i>
                        </td>
                </tr>

        <?php
        }
}
else{
        echo "No hay reservas pendientes...";
}
?>



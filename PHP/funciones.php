<?php
function escapar($html)  // convierte caracteres especiales
{
    return htmlspecialchars($html, ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8");
}
?>
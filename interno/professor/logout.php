<?php
session_start();
session_destroy();
session_unset();

echo '<script>alert(\'Saindo do Sistema\');parent.location =\'../../index.php\';</script>';

?>
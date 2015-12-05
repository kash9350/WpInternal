<?php
    session_start();
    session_destroy();
    header("Location: writerLogin.php");
?>
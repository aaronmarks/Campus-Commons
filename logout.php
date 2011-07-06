<?php
session_start();
session_destroy();

Header("Location: /commons/campuscreatives.php");
?>
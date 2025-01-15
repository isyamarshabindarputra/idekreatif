<?php
sesseion_start();
session_unset();
session_destroy();
header('LOcation: login.php');
exit();

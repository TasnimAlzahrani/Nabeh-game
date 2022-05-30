<?php
session_start();
unset($_SESSION["users_id"]);
header("Location:start-page.html");

<?php
    session_start();

    if(isset($_SESSION["currentUsername"])) {
        session_unset();
        session_destroy();
        header("Location: ../");
    } else {
        header("Location: ../");
    }
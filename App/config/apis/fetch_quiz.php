<?php

session_start();

include '../globals.php';

$url = "http://localhost/Accreditation/app/config/questions.json";

formResponse(true, $url);

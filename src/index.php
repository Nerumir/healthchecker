<?php

require __DIR__ . '/vendor/autoload.php';

////////////////////// HTTP AUTH

include('./auth.php');

////////////////////// CREATE OR READ JSON DATA WITH SERVICES/PORTALS ENDPOINTS

include('./data_init.php');

////////////////////// HEALTHCHECK FUNCTION

include('./checker.php');

////////////////////// HANDLING FORMS

include('./form_handler.php');

////////////////////// BEGIN FRONT-END

include('./view.php');

<?php
return [
    '~^register$~' => [\MyProject\Controllers\RegisterController::class, 'regTemplate'],
    '~^$~' => [\MyProject\Controllers\MainController::class, 'main'],
    '~^newReg$~' => [\MyProject\Controllers\RegisterController::class, 'signUp'],
    '~^login$~' => [\MyProject\Controllers\RegisterController::class, 'login'],
    '~^plus$~' => [\MyProject\Controllers\FunctionalController::class, 'plusOne'],
    '~^logout$~' => [\MyProject\Controllers\RegisterController::class, 'logOut'],
];

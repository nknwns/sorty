<?php

    $HOST = 'http://sorty.std-1715.ist.mospolytech.ru';
    
    $DATABASE = mysqli_connect('std-mysql.ist.mospolytech.ru', 'std_1715_sorty', 'std_1715_sorty', 'std_1715_sorty');
    
    if (mysqli_connect_errno()) {
        header('Location: ' . $HOST . '/pages/error.php');
    }

?>
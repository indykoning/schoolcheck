<?php
$target = (isset($_GET['page']) && file_exists('views/' . $_GET['page'] . '.php')) ? $_GET['page'] : 'home';
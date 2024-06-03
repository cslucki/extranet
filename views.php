<?php
function render($view, $data = [], $page_title = '') {
    extract($data);
    include 'views/partials/header.php';
    include "views/{$view}.php";
    include 'views/partials/footer.php';
}

?>

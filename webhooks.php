
<?php
if (!($file = fopen('webhooks.txt', 'a')))
    return;
    $json = file_get_contents('php://input');
fprintf($file, "%s", $json);
// escribe la fecha en formato ISO a fecha.txt

fclose($file);

?>

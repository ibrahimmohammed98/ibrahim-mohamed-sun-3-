<?php
session_start();
if (isset($_SESSION['errors'])) {
    foreach ($_SESSION['errors'] as $value) {
        echo "$value <br>";
    }
}
unset($_SESSION['errors']);

?>
<form method="POST" action="handle-upload-json.php" enctype="multipart/form-data">
    <input type="file" name="json">
    <br>
    <input type="submit" value="upload" name="submit">
</form>
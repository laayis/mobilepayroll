<?php
if($handle = opendir('.')) {
    while (false !== ($entry = readdir($handle))) {
        if ($entry != "." && $entry != ".." && $entry != "index.php") {
            echo "$entry\n";
        }
    }
    closedir($handle);
}
?>

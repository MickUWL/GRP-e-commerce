<?php
session_start();
session_unset();
session_destroy();

echo "Logged out successfully";

header( "refresh:5; url=index.html" );

?>

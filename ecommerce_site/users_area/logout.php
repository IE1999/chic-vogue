<?php
//Starts the session
session_start();
session_unset(); //Unsets any set variables in the current session.
session_destroy(); //Destroys all of the data associated with the current session.

echo "<script>windo.open('../index.php', '_self')</script>"; 
?>
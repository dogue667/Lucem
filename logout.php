<?php
session_start();
 // remove todas as variáveis da sessão
session_unset();
 // encerra a sessão
session_destroy();
// redireciona para a página publica
header("Location: index.php");
exit();
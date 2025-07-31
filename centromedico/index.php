<?php
include 'db.php';
if (!isset($_SESSION['user'])) { header("Location: login.php"); exit; }
?>
<!doctype html>
<html>
<head>
    <style>
        body {
            text-align: center; /* Centra todo el texto dentro del <body> */
            font-family: Arial, sans-serif;
        }

        nav {
            margin-top: 20px;
        }

        nav a {
            margin: 0 10px;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <h1>Bienvenido al Centro Medico La Paz</h1>
    <h1>Hola, <?= htmlspecialchars($_SESSION['user']) ?></h1>

    <nav>
        <a href="pacientes.php">Pacientes</a> |
        <a href="citas.php">Citas</a> |
        <a href="campanas.php">Campañas</a> |
        <a href="logout.php">Cerrar sesión</a>
    </nav>
</body>
<br>
</html>

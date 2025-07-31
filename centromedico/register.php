<?php
include 'db.php';
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $u = trim($_POST['username']); $p = $_POST['password'];
    if ($u && $p) {
        $h = password_hash($p, PASSWORD_DEFAULT);
        $stmt = $db->prepare("INSERT INTO users(username, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $u, $h);
        if ($stmt->execute()) { $_SESSION['user'] = $u; header("Location: index.php"); exit; }
        else $error = "El usuario ya existe.";
    } else $error = "Completa todos los campos.";
}
?>
<!doctype html><html><body>
<h1>Registro</h1>
<?= $error ? "<p style='color:red;'>$error</p>" : "" ?>
<form method="post">
 Usuario:<input name="username" required><br>
 Contraseña:<input type="password" name="password" required><br><button>Registrar</button>
</form>
<a href="login.php">¿Ya tienes cuenta? Inicia sesión</a>
</body></html>


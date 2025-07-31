<?php
include 'db.php';
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $u = trim($_POST['username']); $p = $_POST['password'];
    if ($u && $p) {
        $stmt = $db->prepare("SELECT password FROM users WHERE username = ?");
        $stmt->bind_param("s", $u); $stmt->execute(); $stmt->bind_result($h);
        if ($stmt->fetch() && password_verify($p, $h)) {
            $_SESSION['user'] = $u; header("Location: index.php"); exit;
        } else $error = "Usuario o contraseña inválida.";
    } else $error = "Completa todos los campos.";
}
?>
<!doctype html><html><body>
<h1>Iniciar sesión</h1>
<?php if (isset($_GET['timeout'])) echo "<p style='color:red;'>Sesión expirada por inactividad.</p>"; ?>
<?= $error ? "<p style='color:red;'>$error</p>" : "" ?>
<form method="post">
 Usuario:<input name="username" required><br><br>
 Contraseña:<input type="password" name="password" required><br><br><button>Entrar</button>
</form>
<a href="register.php">Regístrate</a><br>
<div align="center">
  <img src="C:\xamp\htdocs\centromedico\imagen1.jpg"  width="200">
</div>
</body></html>

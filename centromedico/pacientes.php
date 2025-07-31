<?php
include 'db.php'; if (!isset($_SESSION['user'])) header("Location: login.php");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $n = $_POST['nombre']; $t = $_POST['telefono'];
    if ($n && $t) {
        $s = $db->prepare("INSERT INTO pacientes(nombre,telefono) VALUES (?,?)");
        $s->bind_param("ss",$n,$t); $s->execute();
    }
}
$res = $db->query("SELECT * FROM pacientes");
?>
<!doctype html><html><body>
<h1>Pacientes</h1><a href="index.php">Inicio</a><br><br>
<form method="post">
 Nombre:<input name="nombre" required><br><br>
 Teléfono:<input name="telefono" required><br><br>
 <button>Registrar Paciente</button>
</form><br>
<table border="1"><tr><th>ID</th><th>Nombre</th><th>Teléfono</th></tr>
<?php while($r = $res->fetch_assoc()): ?>
<tr>
 <td><?=$r['pacienteId']?></td>
 <td><?=htmlspecialchars($r['nombre'])?></td>
 <td><?=htmlspecialchars($r['telefono'])?></td>
</tr>
<?php endwhile;?>
</table>
</body></html>


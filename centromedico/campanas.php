
<?php
include 'db.php'; if (!isset($_SESSION['user'])) header("Location: login.php");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $n = $_POST['nombre']; $t = $_POST['tipo']; $l = $_POST['lugar'];
    if ($n && $t && $l) {
        $s = $db->prepare("INSERT INTO campañas(nombre,lugarTipo,lugarNombre) VALUES(?,?,?)");
        $s->bind_param("sss",$n,$t,$l); $s->execute();
    }
}
$res = $db->query("SELECT * FROM campañas");
?>
<!doctype html><html><body>
<h1>Campañas</h1><a href="index.php">Inicio</a><br><br>
<form method="post">
 Nombre:<input name="nombre" required><br><br>
 Tipo: 
 <select name="tipo">
   <option value="institucion">Institución educativa</option>
   <option value="urbanizacion">Urbanización</option>
   <option value="urbanizacion">Conjuntos</option>
   <option value="urbanizacion">Parques</option>
</select><br><br>
 Lugar:<input name="lugar" required><br><br>
 <button>Crear Campaña</button>
</form><br><br>
<table border="1"><tr><th>ID</th><th>Nombre</th><th>Tipo</th><th>Lugar</th></tr>
<?php while($r=$res->fetch_assoc()): ?>
<tr>
 <td><?=$r['campanaId']?></td>
 <td><?=htmlspecialchars($r['nombre'])?></td>
 <td><?=$r['lugarTipo']?></td>
 <td><?=htmlspecialchars($r['lugarNombre'])?></td>
</tr>
<?php endwhile;?>
</table>
</body></html>

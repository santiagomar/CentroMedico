<?php
include 'db.php';
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pid = $_POST['pacienteId'];
    $f   = $_POST['fecha'];
    $h   = $_POST['hora'];
    $esp = $_POST['especialidad'];

    if ($pid && $f && $h && $esp) {
        $stmt = $db->prepare("INSERT INTO citas(pacienteId,fecha,hora,especialidad) VALUES(?,?,?,?)");
        $stmt->bind_param("isss", $pid, $f, $h, $esp);
        $stmt->execute();
    }
} // CIERRE CORRECTO DEL IF POST

$pc  = $db->query("SELECT pacienteId, nombre FROM pacientes");
$res = $db->query("
  SELECT c.citaId, p.nombre, c.fecha, c.hora, c.especialidad
  FROM citas c JOIN pacientes p ON c.pacienteId = p.pacienteId
  ORDER BY c.fecha, c.hora
");
?>
<!doctype html>
<html>
<body>
<h1>Citas</h1><a href="index.php">Inicio</a><br><br>

<form method="post">
  Paciente:
  <select name="pacienteId">
    <?php while ($p = $pc->fetch_assoc()): ?>
      <option value="<?= $p['pacienteId'] ?>"><?= htmlspecialchars($p['nombre']) ?></option>
    <?php endwhile; ?>
  </select><br><br>

  Fecha:<input type="date" name="fecha" required><br><br>
  Hora:<input type="time" name="hora" required><br><br>

  Especialidad:<br>
  <select name="especialidad" required>
    <option value="" disabled selected>Selecciona especialidad</option>
    <option value="medicina general">Medicina General</option>
    <option value="pediatria">Pediatría</option>
    <option value="ginecologia">Ginecología</option>
    <option value="odontologia">Odontología</option>
    <option value="otra">Otra</option>
  </select><br><br>

  <button>Solicitar cita</button>
</form><br>

<table border="1">
  <tr><th>ID</th><th>Paciente</th><th>Fecha</th><th>Hora</th><th>Especialidad</th></tr>
  <?php while ($r = $res->fetch_assoc()): ?>
    <tr>
      <td><?= $r['citaId'] ?></td>
      <td><?= htmlspecialchars($r['nombre']) ?></td>
      <td><?= $r['fecha'] ?></td>
      <td><?= $r['hora'] ?></td>
      <td><?= htmlspecialchars($r['especialidad']) ?></td>
    </tr>
  <?php endwhile; ?>
</table>

</body>
</html>




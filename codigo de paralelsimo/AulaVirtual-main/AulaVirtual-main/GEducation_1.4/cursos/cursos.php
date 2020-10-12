<?php 
  include("../conexion.php");
	session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="../css/estilos.css" rel="stylesheet" type="text/css">
	<title>Document</title>
</head>
<div class="header">
  <h1 >GIGABITS EDUCATION</h1>
</div>
<body><!--MENU SUPERIOR-->
<div class="topnav">
  <a href="../main.php">Main</a>
  <a href="../notas/notas.php">Notas</a>
  <a class="active" href="cursos.php">Cursos</a>
  <a href="../horarios/horario.php">Horarios</a>
  <!--botones de seccion(cerrarsecion, iniciar seccion...)  si hay un nombre en la session muestra cerrar seccion si no es asi muestra iniciar seccion-->
  <?php
  if(isset($_SESSION['username'])){
    ?><a class="sec" href=../cerrarsession.php>Cerrar Session</a>
  <?php  
  }else{
    ?><a class="sec" href=../iniciarsession.php>Iniciar Session</a> 
  <?php } ?>
 
</div>

<?php 


$con = mysql_connect($host,$user,$pw)or die("problemas con la conexion a la BD");//conectar con el servidor
mysql_select_db($db,$con)or die("problemas cn la conexion a la BD");//seleccionar BD
$reg2=mysql_query("SELECT * FROM alumno WHERE NOMBREA = '$_SESSION[username]'")or die("F".mysql_error());
$reg22=mysql_fetch_array($reg2);
$registro = mysql_query("SElECT  * FROM  alumno_curso WHERE alumno_curso.idalumno = '$reg22[idalumno]'") or die ("problemas de consulta: ".mysql_error());
?>

<form method="post" action="" class="form-horizontal col-md-6 col-md-offset-3">
 <div class="form-group">

      <label  for="input1" class="col-sm-3 control-label">Seleccionar Curso</label>
      <div class="col-sm-4">
      <select name="whichcourse" id="input1">
        <?php 
        while($reg=mysql_fetch_array($registro)){ ?>
          <?php $reg3=mysql_query("SELECT * FROM curso WHERE idcurso= '$reg[idcurso]'")or die("F".mysql_error());
          $reg33=mysql_fetch_array($reg3); ?>
            <option value="<?php echo $reg33['NOMBREC']?>"><?php echo $reg33['NOMBREC']?></option>
        <?php ; 
        } 
        ?>
      </select>

      </div>
  </div>
        <input type="submit" class="btn btn-primary col-md-3 col-md-offset-7" value="Go!" name="sr_btn" />
</form>

<div style="margin-left:25%;padding:1px 16px;height:100px;">

  <!--
  <h3><?php echo $regi= $reg33['NOMBREC']?></h3>-->
<?php 

$course = $_POST['whichcourse'];


 ?>
 <h2><?php echo "Hola ".$_SESSION['username']; ?></h2>
 <h3>Este es el curso de <?php echo $course?></h3>
<img src="../imagenes/<?php echo $course?>.jpg" width="400" height="200">

</div>

</body>
<script src="..script/scrips.js"></script>
</html>

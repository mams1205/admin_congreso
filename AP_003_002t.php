<?php
   $PageSecurity = 2;
   include('includes/session.inc');
?>

<div class="pt-2 table-responsive table-hover">
   <table id="tablaTemas" class="table table-bordered">
   	  <thead style="background-color: #1c86ee;color: white; font-weight: bold;">
   	     <tr>
            <th>ID</th>
            <th>Tema</th>
            <th>Acciones</th>
   	     </tr>   	            
   	  </thead>
      <tfoot style="background-color: #bebebe;color: white;">              
      </tfoot>
      <tbody>
         <?php
            $sql = "SELECT  ID_tema, tema
                     FROM Cat_temas
                     WHERE status = 'A'
                     ";
	          $res = DB_query($sql,$db);
	          while($row = DB_fetch_row($res)) {
               echo '<tr>';
	            echo '<td>'.$row[0].'</td>';
	            echo '<td>'.$row[1].'</td>';
               echo '<td>
                        <a href="AP_003_002n.php?A=vMod&ID='.$row[0].'" 
                           data-toggle="tooltip" 
                           title="Modificar">
                           <i class="pr-2 fas fa-edit"></i>
                        </a>
                        <a href="AP_003_002n.php?A=vDel&ID='.$row[0].'"
                           data-toggle="tooltip" title="Eliminar" class="text-danger">
                           <i class="pr-2 fas fa-trash-alt"></i>
                        </a>
                     </td>';
               
	          }
	       ?>
   	  </tbody>
   </table>
</div>

<script type="text/javascript">
   $(document).ready(function() {
      $('#tablaTemas').DataTable({
         "language": {
         "url": "plugins/bootstrap/js/Spanish.json"},
         "order": [[2, "asc"]]
      });
   });      
</script>

<script type="text/javascript">
   $(document).ready(function() {
      $('#tablaTemas').DataTable();
   });
</script>

  </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Custom JS -->


    
    <script src="https://cdn.tiny.cloud/1/ifxicuaxkxoao8rd5vxzna1789kv35b4a0zq4s6yf2kmm8k8/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
      tinymce.init({
        selector: 'textarea',
        plugins: 'a11ychecker advcode casechange formatpainter linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tinycomments tinymcespellchecker',
        toolbar: 'a11ycheck addcomment showcomments casechange checklist code formatpainter pageembed permanentpen table',
        toolbar_mode: 'floating',
        tinycomments_mode: 'embedded',
        tinycomments_author: 'Author name',
      });
      </script>

<!-- google chart -->
<!-- website activity -->
<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      
      function drawChart() {
        
        var data = google.visualization.arrayToDataTable([
          ['Website', 'activity'],
          ['Views',      <?php echo $session->count; ?>],
          ['Photos',     <?php echo Photo::count_all(); ?>],
          ['Users',      <?php echo User::count_all(); ?>],
          ['Comments',    <?php echo Comment::count_all(); ?>]
          
        ]);
        
        var options = {
          title: 'Website activity',
          is3D: true,
          backgroundColor: 'transparent'
        };
        
        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        
        chart.draw(data, options);
      }
      </script>
<script src="js/dropzone.js"></script> <!-- modal JS -->
<script src="js/scripts.js"></script> <!-- modal JS -->

</body>

</html>

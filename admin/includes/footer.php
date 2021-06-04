  </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Custom JS -->


    


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

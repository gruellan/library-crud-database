<?php require "components/header.php";?>  
<?php
    // Query the database to return all years that books were published in and how many were published each year
    $distinctYears = "SELECT count(year) AS count, year FROM Books GROUP BY year ORDER BY year";
    $statement = $connection->query($distinctYears);
    $statement->execute();
    $results = $statement->fetchAll(PDO::FETCH_ASSOC);
    $year= "";
     
    // Loops through each year, linking the year to the year's book count, so it can be added to Google Charts data variable 
    foreach ($results as $row) {
        // Format data so it can be used by Google Charts
        // .= operator appends count variable to year variable
        $year .= "['".$row{'year'}."',".$row{'count'}."],";
    }
?>

<!-- Div to display the line chart -->
<div id="chart_div"></div>
<!-- Import and configure Google Charts -->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.setOnLoadCallback(drawChart);

     // Function to enter data into our chart
    function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Year',	'Number of books published in each year'],
          <?php echo $year ?>
    ]);
     var options = {
          curveType: 'function',
          legend: { 
               position: 'bottom' 
          },
          vAxis: {
               format: '#',
               min: 0,
          }

     };
     
     // Draw chart with the data above, place it in the chart div created above 
     var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
     chart.draw(data, options);
    }
</script>
<?php require "components/footer.php";?>  
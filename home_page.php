<!DOCTYPE html>
<?php
    // create db connection
    $dbhost = "localhost";
    $dbuser = "csufadmin";
    $dbpass = "password";
    $dbname = "db_csuf_bball_team";
    $dbconn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

?>
<html>
<head>
  <title>CPSC 431 HW-3</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
  <link href="stylesheets/styles.css" rel="stylesheet">
</head>
<body>
  <div class="container">
    <div class="form">
    <h1 class="text-center">Cal State Fullerton Basketball Statistics</h1>

    <table style="width: 100%; border:0px solid black; border-collapse:collapse;">
      <tr>
        <th style="width: 40%;">Name and Address</th>
        <th style="width: 60%;">Statistics</th>
      </tr>
      <tr>
        <td style="vertical-align:top; border:1px solid black;">
          <!-- FORM to enter Name and Address -->
          <form action="processAddressUpdate.php" method="post">
            <table style="margin: 0px auto; border: 0px; border-collapse:separate;">
              <tr>
                <td style="text-align: right; background: lightblue;">First Name</td>
                <td><input type="text" name="firstName" value="" size="35" maxlength="250"/></td>
              </tr>

              <tr>
                <td style="text-align: right; background: lightblue;">Last Name</td>
                <td><input type="text" name="lastName" value="" size="35" maxlength="250"/></td>
              </tr>

              <tr>
                <td style="text-align: right; background: lightblue;">Street</td>
                <td><input type="text" name="street" value="" size="35" maxlength="250"/></td>
              </tr>

              <tr>
                <td style="text-align: right; background: lightblue;">City</td>
                <td><input type="text" name="city" value="" size="35" maxlength="250"/></td>
              </tr>

              <tr>
                <td style="text-align: right; background: lightblue;">State</td>
                <td><input type="text" name="state" value="" size="35" maxlength="100"/></td>
              </tr>

              <tr>
                <td style="text-align: right; background: lightblue;">Country</td>
                <td><input type="text" name="country" value="" size="20" maxlength="250"/></td>
              </tr>

              <tr>
                <td style="text-align: right; background: lightblue;">Zip</td>
                <td><input type="text" name="zipCode" value="" size="10" maxlength="10"/></td>
              </tr>

              <tr>
               <td colspan="2" style="text-align: center;"><input type="submit" value="Add/Update Name and Address" /></td>
             </tr>
           </table>
         </form>
       </td>

       <td style="vertical-align:top; border:1px solid black;">
        <!-- FORM to enter game statistics for a particular player -->
        <form action="processStatisticUpdate.php" method="post">
          <table style="margin: 0px auto; border: 0px; border-collapse:separate;">
            <tr>
              <td style="text-align: right; background: lightblue;">Name (Last, First)</td>
              <td>
                <select>
                  <option value="">Choose player's name here</option>
                  <?php

                    $query_names_all = "SELECT Name_First, Name_Last FROM TeamRoster";
                    $result_names_all = mysqli_query($dbconn, $query_names_all);

                    while($row = mysqli_fetch_array($result_names_all, MYSQLI_ASSOC)) {
                      printf ("<option value=\"%s, %s\">%s, %s</option>\n",
                        $row["Name_Last"], $row["Name_First"], $row["Name_Last"], $row["Name_First"]);
                    }
                    
                   ?>
                </select>
                <!-- <input type="text" name="name" value="" size="50" maxlength="500"/> -->
              </td>
            </tr>

            <tr>
              <td style="text-align: right; background: lightblue;">Playing Time (min:sec)</td>
              <td><input type="text" name="time" value="" size="5" maxlength="5"/></td>
            </tr>

            <tr>
              <td style="text-align: right; background: lightblue;">Points Scored</td>
              <td><input type="text" name="points" value="" size="3" maxlength="3"/></td>
            </tr>

            <tr>
              <td style="text-align: right; background: lightblue;">Assists</td>
              <td><input type="text" name="assists" value="" size="2" maxlength="2"/></td>
            </tr>

            <tr>
              <td style="text-align: right; background: lightblue;">Rebounds</td>
              <td><input type="text" name="rebounds" value="" size="2" maxlength="2"/></td>
            </tr>

            <tr>
             <td colspan="2" style="text-align: center;"><input type="submit" value="Add/Update Statistic" /></td>
           </tr>
         </table>
       </form>
     </td>
   </tr>
 </table>
</div>

<div class="display">
 <h2 class="text-center">Player Statistics</h2>
 <?php
 // require('Address.php');
 // require('PlayerStatistic.php');

 $query_stats_all = "SELECT  T.Name_First, T.Name_Last, T.Street, T.City, T.State, T.Country, T.ZipCode,
                             AVG(S.PlayingTimeMin), AVG(S.PlayingTimeSec), AVG(S.Points), AVG(S.Assists), AVG(S.Rebounds), COUNT(S.ID)
                     FROM    TeamRoster as T
                     LEFT JOIN Statistics as S ON T.ID = S.Player
                     GROUP BY T.ID
                     ORDER BY T.Name_Last, T.Name_First";


 $result_stats_all = mysqli_query($dbconn, $query_stats_all);

 printf("<span>Number of records: %s</span>", mysqli_num_rows($result_stats_all));
 ?>

 <table class="align-top table-bordered" style="border:1px solid black; border-collapse:collapse;">
  <tr>
    <th colspan="1" style="vertical-align:top; border:1px solid black; background: lightgreen;"></th>
    <th colspan="2" style="vertical-align:top; border:1px solid black; background: lightgreen;">Player</th>
    <th colspan="1" style="vertical-align:top; border:1px solid black; background: lightgreen;"></th>
    <th colspan="4" style="vertical-align:top; border:1px solid black; background: lightgreen;">Statistic Averages</th>
  </tr>
  <tr>
    <th style="vertical-align:top; border:1px solid black; background: lightgreen;"></th>
    <th style="vertical-align:top; border:1px solid black; background: lightgreen;">Name</th>
    <th style="vertical-align:top; border:1px solid black; background: lightgreen;">Address</th>

    <th style="vertical-align:top; border:1px solid black; background: lightgreen;">Games Played</th>
    <th style="vertical-align:top; border:1px solid black; background: lightgreen;">Time on Court</th>
    <th style="vertical-align:top; border:1px solid black; background: lightgreen;">Points Scored</th>
    <th style="vertical-align:top; border:1px solid black; background: lightgreen;">Number of Assists</th>
    <th style="vertical-align:top; border:1px solid black; background: lightgreen;">Number of Rebounds</th>
  </tr>
  <?php

    $row_num = 1;
    $row_templ = "
    <tr>
      <td>%d</td>
      <td>%s, %s</td>
      <td>%s<br>%s, %s %s<br>%s</td>
      <td>%d</td>
      <td class=\"%s\">%s</td>
      <td class=\"%s\">%s</td>
      <td class=\"%s\">%s</td>
      <td class=\"%s\">%s</td>
    </tr>";

    while($row = mysqli_fetch_array($result_stats_all, MYSQLI_ASSOC)) {
      
      // Conver data to strings or empty string if 0
      $PlayingTime  = $row["AVG(S.PlayingTimeMin)"] > 0 || $row["AVG(S.PlayingTimeSec)"] > 0 ?
                      intval($row["AVG(S.PlayingTimeMin)"]).":".intval($row["AVG(S.PlayingTimeSec)"])
                      : "";
      $Points       = $row["AVG(S.Points)"] > 0 ? intval($row["AVG(S.Points)"]) : "";
      $Assists      = $row["AVG(S.Assists)"] > 0 ? intval($row["AVG(S.Assists)"]) : "";
      $Rebounds     = $row["AVG(S.Rebounds)"] > 0 ? intval($row["AVG(S.Rebounds)"]) : "";

      // Flags for graying out area of '0' fields
      $isVisivlePTM = strlen($PlayingTime) > 0 ? "" : "table-secondary";
      $isVisivleP   = strlen($PlayingTime) > 0 ? "" : "table-secondary";
      $isVisivleA   = strlen($PlayingTime) > 0 ? "" : "table-secondary";
      $isVisivleR   = strlen($PlayingTime) > 0 ? "" : "table-secondary";

      // Print a formatted string
      printf ($row_templ,
              $row_num++,
              $row["Name_Last"], $row["Name_First"],
              $row["Street"], $row["City"], $row["State"], $row["ZipCode"], $row["Country"],
              $row["COUNT(S.ID)"],
              $isVisivlePTM, $PlayingTime,
              $isVisivleP, $Points,
              $isVisivleA, $Assists,
              $isVisivleR, $Rebounds);
    }

  ?>
</table>
</div>
</div>

</body>
</html>

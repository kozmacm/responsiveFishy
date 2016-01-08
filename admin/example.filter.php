<?php
require 'includes/gapi.class.php';
define('ga_profile_id','your profile id');

$ga = new gapi("fishy-business-service@fishy-business-1182.iam.gserviceaccount.com", "keys/Fishy Business-a9f7453a79f4.p12");

/**
 * Note: OR || operators are calculated first, before AND &&.
 * There are no brackets () for precedence and no quotes are
 * required around parameters.
 * 
 * Do not use brackets () for precedence, these are only valid for 
 * use in regular expressions operators!
 * 
 * The below filter represented in normal PHP logic would be:
 * country == 'United States' && ( browser == 'Firefox || browser == 'Chrome')
 */

//$filter = 'country == United States && browser == Firefox || browser == Chrome';


$ga->requestReportData(91085606,array('browser','browserVersion'),array('pageviews','visits'),'-visits',$filter);
?>

<table>
<tr>
  <th>Browser &amp; Browser Version</th>
  <th>Pageviews</th>
  <th>Visits</th>
</tr>
<?php
foreach($ga->getResults() as $result):
?>
<tr>
  <td><?php echo $result ?></td>
  <td><?php echo $result->getPageviews() ?></td>
  <td><?php echo $result->getVisits() ?></td>
</tr>
<?php
endforeach
?>
</table>

<table>
<tr>
  <th>Total Results</th>
  <td><?php echo $ga->getTotalResults() ?></td>
</tr>
<tr>
  <th>Total Pageviews</th>
  <td><?php echo $ga->getPageviews() ?>
</tr>
<tr>
  <th>Total Visits</th>
  <td><?php echo $ga->getVisits() ?></td>
</tr>
<tr>
  <th>Result Date Range</th>
  <td><?php echo $ga->getStartDate() ?> to <?php echo $ga->getEndDate() ?></td>
</tr>
</table>

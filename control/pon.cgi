#!/usr/bin/perl --

for ( $count = 0; $count < 30; $count++) {
  $ret=system ("sh /home/pi/work/scripts/wol.sh > /home/httpd/msg");
  if ($ret == 0) {
   break;
  }
  else {
   sleep 3;
  }
}
if ($ret == 0) {
print "Content-type: text/html\n\n";
print "<html>\n";
print "<body>\n";
print "<span style=\"font-size:32pt\">Started successfully</span><br>\n";

print "<input type='button' value='back' style='width:100%;height:100px;font-size:60px' onClick='location.href=\"../control/power.php\"'>\n";
print "</body>\n";
print "</html>\n";
} else {
print "Content-type: text/html\n\n";
print "<html>\n";
print "<body>\n";
print "<span style=\"font-size:32pt\"> $ret Not available</span>\n";

print "<input type='button' value='back' style='width:100%;height:100px;font-size:60px' onClick='location.href=\"../control/power.php\"'>\n";
print "</body>\n";
print "</html>\n";
}

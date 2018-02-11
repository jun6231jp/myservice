#!/usr/bin/perl --

$ret=system ("/home/user/wol.sh > /home/httpd/msg");
if ($ret == 0) {
print "Content-type: text/html\n\n";
print "<html>\n";
print "<body>\n";
print "<span style=\"font-size:32pt\">Started successfully</span>\n";
print "</body>\n";
print "</html>\n";
} else {
print "Content-type: text/html\n\n";
print "<html>\n";
print "<body>\n";
print "<span style=\"font-size:32pt\"> $ret Not available</span>\n";
print "</body>\n";
print "</html>\n";
}

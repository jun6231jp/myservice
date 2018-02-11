#!/usr/bin/perl --

$ret=system ("sh /home/user/shutdown.sh");

print "Content-type: text/html\n\n";
print "<html>\n";
print "<body>\n";
print "<span style=\"font-size:32pt\">Now Shutting Down...</span>\n";
print "</body>\n";
print "</html>\n";

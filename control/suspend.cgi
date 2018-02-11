#!/usr/bin/perl --

system "/home/user/suspend.exp > /home/httpd/msg";
print "Content-type: text/html\n\n";
print "<html>\n";
print "<body>\n";
print "<span style=\"font-size:32pt\">Now Suspending...</span>\n";
print "</body>\n";
print "</html>\n";

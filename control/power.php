<html>
    <style>
     input.remote {
	 width:100%;
	 height:300px;
	 font-size: 40px;
	 text-align:center;
     }
    </style>
    <body>
	<p>
	    <FORM action="/cgi-bin/pon.cgi" method="get">
		<input class="remote" type="submit" value="Remote PON">
	    </FORM>
	</p>
	<p>
	    <FORM action="/cgi-bin/poff.cgi" method="get">
		<input class="remote" type="submit" value="Remote POFF">
	    </FORM>
	</p>
	<p>
	    <FORM action="/cgi-bin/suspend.cgi" method="get">
		<input class="remote" type="submit" value="Remote SUSPEND">
	    </FORM>
	</p>
    </body>
</html>

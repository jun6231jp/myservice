<html>

<style>
 input {
    font-size:60px;
    width:60%;
 }
 .btn {
    width:90%;
 }
 span {
    font-size:60px;
    width:30%;
 }

</style>

<body>
<p>
<span>XNUMS</span>
<input id="X">
</p>
<p>
<span>YNUMS</span>
<input id="Y">
</p>
<p>
<span>BOMBS</span>
<input id="mine">
</p>

<p>
<input id="set" class="btn" type="submit" value="set" onClick="mineset()">
</p>

<p>
<input id="back" class="btn" type="submit" value="back" onClick='location.href="mine.php"'>
</p>

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script>
            function mineset(){
                  var X=document.getElementById("X").value;
                  var Y=document.getElementById("Y").value;
                  var mine=document.getElementById("mine").value;
              if (X < 200 && Y < 200) {
                 if(window.confirm("Are you sure?")){
                   $.ajax({
                      url: 'set.php',
                      type: 'post',
                      dataType: 'json',
                      data: {
                          X:X,
                          Y:Y,
                          mine:mine
                      }
                  })
                  .done(function (response){
                       location.href='mine.php';
                  });
                }
             }
            else {
               alert('too big');
             }
          }
</script>
</body>
</html>

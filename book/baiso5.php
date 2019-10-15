<?php include_once("header.php") ?>
<?php include_once("nav.php") ?>
<?php

include_once("model/user.php");

echo "<h1>Bài số 5</h1>";
?>
<button onclick="testAjax();" type = 'button'>Test javascript</button>
<div id="contentAjax">

</div>



<?php include_once("footer.php") ?>
<script>
    function testAjax(){
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                var user = JSON.parse(this.responseText);


                var str = "<ul>";

                str += "<li>";
                str += "Username: "+ user.username;
                str += "</li>";
                
                str += "<li>";
                str += "Password: "+ user.password;
                str += "</li>";

                str += "<li>";
                str += "Full name: "+ user.fullName;
                str += "</li>";

                str += "</ul>";


                document.getElementById("contentAjax").innerHTML = str;
            }
        };
        xhttp.open("GET", "testajax.php?username=huy", true);
        xhttp.send();
    }
</script>
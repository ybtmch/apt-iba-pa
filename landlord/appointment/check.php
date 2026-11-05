<?php

if(isset($_POST['submit_radio'])){
    $a = $_POST['radios'];
    var_dump($a);
}


?>

<form action="check.php" method="POST">
<input type="radio" name="radios" value="1">1   
<input type="radio" name="radios" value="2">2   
<input type="radio" name="radios" value="3">3   
<input type="radio" name="radios" value="4">4   
<input type="radio" name="radios" value="5">5   
<button type="submit" name="submit_radio">Submit</button>
</form>
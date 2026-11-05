<?php
if(isset($_POST['thumb'])){
    $thumb = $_POST['thumb'];
    $i = 0;
    if(($thumb-1) == $i){
        $thumbnail = 1;
    } else {
        $thumbnail = 0;
    }
    var_dump($thumbnail);
    
}
?>
<form action="cccc" method="POST">
<input type="radio" name="thumb" value="1">
<input type="radio" name="thumb" value="2">
<input type="radio" name="thumb" value="3">
<input type="radio" name="thumb" value="4">
<input type="radio" name="thumb" value="5">
<button type="submit">s</button></form>
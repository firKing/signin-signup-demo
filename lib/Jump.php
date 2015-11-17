<?php
Class Jump{

    function __construct($url, $msg, $second){

        echo '<h1>'.$msg.'</h1>'."<p>将在".$second."秒后跳转</p>";

        header("refresh:$second;url=$url");
    }
}
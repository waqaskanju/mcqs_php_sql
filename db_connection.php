<?php

function connect(){
	$link=mysqli_connect('localhost','root','','blanks');
	if($link){
	}
	else{

		echo 'error in connection';
	}

	return $link;
}

?>
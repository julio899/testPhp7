
<div class="alert alert-dark" role="alert">
  In <a href="#" class="alert-link">Development</a>. 
</div>


<h1>
	Start
</h1>
<?php 
	
	if( isset($name) )
	{

        echo 'Display : '.$name.'<br>';
	}

	if( isset($parameters) )
	{
	   foreach ($parameters as $key => $value) {
        	# if get parameters
        	echo "$key : $value <br>";
        }
	}
 ?>
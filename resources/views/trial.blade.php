<?php
	if(!empty($data))
	{
		foreach($data as $d)
		{
			echo $d->modname."<br>";
		}
	}
?>	
<br>
@if(!empty($counter))
jumlah data: {{$counter}}
@endif
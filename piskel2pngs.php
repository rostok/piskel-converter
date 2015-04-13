<?
	if ($argc<2)
	{
		echo "piskel-converter: produce PNG image for each layer (https://github.com/rostok/piskel-converter)\n\n";
		echo "not enough arguments! correct syntax: \n\n\tpiskel2pngs.php file.piskel\n\n";
		die();
	}

	$js = json_decode (file_get_contents($argv[1]));

	while(list($k,$v)=each($js->piskel->layers))
	{
	 	$js2 = json_decode($v);
	 	$png = $js2->base64PNG;
	 	$png = str_replace("data:image/png;base64,", "", $png);
	 	$name = $js2->name.".png";
	 	file_put_contents($name, base64_decode($png));
	}
?>
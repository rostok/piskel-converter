<?
	// check options
	if ($argc<2)
	{
		echo "piskel-converter: produce PNG image for each layer (https://github.com/rostok/piskel-converter)\n\n";
		echo "usage: piskel2pngs.php [-f] file.piskel\n\n-f flattens all layers\n\n";
		die();
	}

	if ($argv[1]=="-f") 
	{
		$flatten = true;
		array_splice($argv, 1, 1);
	}

	$names = array();

	// parse json and save pngs
	$js = json_decode (file_get_contents($argv[1]));

	while(list($k,$v)=each($js->piskel->layers))
	{
	 	$js2 = json_decode($v);
	 	$frameCnt = $js2->frameCount;
	 	$png = $js2->base64PNG;
	 	$png = str_replace("data:image/png;base64,", "", $png);
	 	$name = $js2->name.".png";
		$names[] = $name;
 		file_put_contents($name, base64_decode($png));
	}

	// flatten all pngs and remove them
	if ($flatten)
	{
                for ($i=0; $i<sizeof($names); $i++)
                {
                        $t=imagecreatefrompng($names[$i]);
                        if ($i==0) {
                        	imagealphablending( $t, true );
                        	imagesavealpha( $t, true );
                        	$base = $t;
                        }
                        else {
                        	imagecopy($base,$t,0,0,0,0,imagesx($t),imagesy($t));	
                        }
                        unlink($names[$i]);
                }
                imagepng ( $base, $argv[1]."[$frameCnt].png");
	}
?>
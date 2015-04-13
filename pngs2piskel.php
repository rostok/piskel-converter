<?
	if ($argc<2)
	{
		echo "piskel-converter: combine number of pngs files into one piskel file (https://github.com/rostok/piskel-converter)\n\n";
		echo "not enough arguments! correct syntax: \n\n\tpngs2piskel.php frame_number layer_1.png layer_2.png ...\n\n";
		die();
	}

	$cnt = intval($argv[1]);
	if ($cnt==0)
	{
		echo "wrong args!\n";
		die();
	}

	$size = getimagesize($argv[2], $info);


	$layers = array();
	for ($i=2; $i<$argc; $i++)
	{
	 	$layer = array();
	 	$layer["name"] = $argv[$i];
	 	$layer["frameCount"] = $cnt;
	 	$layer["base64PNG"] = "data:image/png;base64,".base64_encode(file_get_contents($argv[$i]));
	 	$layers[] = json_encode($layer);
	}

	$piskel = array();
	$piskel["name"]="foobar";
	$piskel["description"]="converted by pngs2piskel";
	$piskel["fps"]=12;
	$piskel["height"]=$size[0]/$cnt;
	$piskel["width"]=$size[1];
	$piskel["width"]=$size[1];
	$piskel["layers"]=$layers;

	$top = array();
	$top["modelVersion"]=2;
	$top["piskel"]=$piskel;

	echo json_encode($top);
?>
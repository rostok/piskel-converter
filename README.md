two simple PHP scripts that convert to and from piskel format (https://github.com/juliandescottes/piskel) avaiable under MIT License

both scripts should be run from command line

to produce PNG image for each of the layers run 

	piskel2pngs.php file.piskel

to combine number of pngs files into one piskel file run

	pngs2piskel.php frames_number layer_1.png layer_2.png ...

in this case PNGs should have the same dimensions

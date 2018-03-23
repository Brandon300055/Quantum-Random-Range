<?php     
	 function RandomRange($min, $max) {
            /**
             * Generates a truly random number using and API from https://qrng.anu.edu.au/
             * offers a true random number by measuring the quantum fluctuations of the vacuum.
             * By Brandon Stewart
             */
            //construct the array
            $arrContextOptions=array(
                "ssl"=>array(
                    "verify_peer"=>false,
                    "verify_peer_name"=>false,
                ),
            );

            //call the API
            $maps_json = file_get_contents("https://qrng.anu.edu.au/API/jsonI.php?length=1&type=uint16&size=1", false, stream_context_create($arrContextOptions));
            $map_array = json_decode($maps_json, true);

            //get status
            $status = $map_array['success'];

            //check if status is valid using $status
            if($status == true){
                //get an array of the one random number
                $data = $map_array['data'];

                //returns the value of the array
                foreach ($data as $value) {
                    echo srand($value);
                    echo(rand($min,$max));
                    //return $value;
                }
            }
            else {
                //returns 0 if the array is invalid
                return 0;
            }
        }
		
	?>
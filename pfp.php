<?php
    function getPFPs($folderPath){

        $fileType="png";

        $folderHandle = opendir($folderPath);
    
        $matchingFiles = [];
    
        while ($file = readdir($folderHandle)) {
            if ($file != '.' && $file != '..' && pathinfo($file, PATHINFO_EXTENSION) == $fileType) {
                $matchingFiles[] = $file;
            }
        }
    
        closedir($folderHandle);
        return $matchingFiles;
    }

    function pickRandomPFP($array){
            if (empty($array)) {
                return null; 
            }
        
            $randomKey = array_rand($array); 
            return $array[$randomKey]; 
    }

    if ($_SERVER['REQUEST_METHOD'] === 'GET'){
        if(isset($_GET["type"])){
            if(strtolower($_GET["type"]) == "r"){

                $folder = "./rndm/";

            }elseif (strtolower($_GET["type"]) == "m"){

                $folder = "./mono/";
                
            }
            
            $url = $folder . pickRandomPFP(getPFPs($folder));
            $data = json_encode(["pfp" => $url]);

            //for ajax
            header('Content-Type: application/json');
            echo $data;

            //for direct call
            // header('Content-Type: image/png');
            // header("Location: " . $url);
            
        }elseif (isset($_GET["qte"])){




        }
        else{

            echo json_encode(["message" => "Invalid request"]);
        }
    }
?>
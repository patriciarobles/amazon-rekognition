<?php

function checkImage(){
   $files_in_directory = scandir('img/uploads/');
   $items_count = count($files_in_directory);
   if ($items_count > 2)
   {
      $files = scandir('img/uploads/', SCANDIR_SORT_DESCENDING);
      $newest_file = $files[0];
      $source_file = 'img/uploads/'.$newest_file;
      //return $source_file;
      $destination_path = 'img/sources/';
      rename($source_file, $destination_path . pathinfo($source_file, PATHINFO_BASENAME));
      return faceRecognition($newest_file);
   }
   return null;
}

function faceRecognition($sourceImage){
      $client = new Aws\Rekognition\RekognitionClient([
         'version' => 'latest',
         'region' => 'your region',
         'credentials' =>[
            'key' => 'your key',
            'secret' => 'your key'
         ]
      ]);
      $result = $client->compareFaces([
         'SimilarityThreshold' => 70,
         'SourceImage' => [
            'Bytes' => file_get_contents("img/sources/$sourceImage"),
         ],
         'TargetImage' => [
            'Bytes' => file_get_contents("img/target.png"),
         ],
      ]);
   
      $pos_left = $result['FaceMatches'][0]['Face']['BoundingBox']['Left'];
      $pos_top = $result['FaceMatches'][0]['Face']['BoundingBox']['Top'];
      $left = 800*$pos_left;
      $top = 444*$pos_top;
      
      $pos = array($left,$top,$sourceImage);
      return $pos;
      
   }

   function correctImageOrientation($filename) {
      if (function_exists('exif_read_data')) {
        $exif = exif_read_data($filename);
        if($exif && isset($exif['Orientation'])) {
          $orientation = $exif['Orientation'];
          if($orientation != 1){
            $img = imagecreatefromjpeg($filename);
            $deg = 0;
            switch ($orientation) {
              case 3:
                $deg = 180;
                break;
              case 6:
                $deg = 270;
                break;
              case 8:
                $deg = 90;
                break;
            }
            if ($deg) {
              $img = imagerotate($img, $deg, 0);        
            }
            // then rewrite the rotated image back to the disk as $filename 
            imagejpeg($img, $filename, 95);
          } // if there is some rotation necessary
        } // if have the exif orientation info
      } // if function exists      
    }

   
?>
<?php
    function imagecreatefromfile( $filename ) {
        if (!file_exists($filename)) {
            throw new InvalidArgumentException('File "'.$filename.'" not found.');
        }
        switch ( strtolower( pathinfo( $filename, PATHINFO_EXTENSION ))) {
            case 'jpeg':
            case 'jpg':
                return imagecreatefromjpeg($filename);
            break;

            case 'png':
                return imagecreatefrompng($filename);
            break;

            case 'gif':
                return imagecreatefromgif($filename);
            break;

            default:
                throw new InvalidArgumentException('File "'.$filename.'" is not valid jpg, png or gif image.');
            break;
        }
    }

    function randomPastelColor(){
        $red = ((float)rand()/(float)getrandmax())*150+105;
        $green = ((float)rand()/(float)getrandmax())*150+105;
        $blue = ((float)rand()/(float)getrandmax())*150+105;
        return "#" . dechex($red) . dechex($green) . dechex($blue);
    }
?>
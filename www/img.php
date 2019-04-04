<?
function img_resize( $srcimg, $dstimg, $imgpath, $rewidth, $reheight )
{
	$exif = exif_read_data("$imgpath/$srcimg");
	$src_info = getimagesize("$imgpath/$srcimg");
	
	if($rewidth < $src_info[0] || $reheight < $src_info[1]) {
	if(($src_info[0] - $rewidth) > ($src_info[1] - $reheight)) {
	$reheight = round(($src_info[1]*$rewidth)/$src_info[0]);
	} else {
	$rewidth = round(($src_info[0]*$reheight)/$src_info[1]);
	}
	} else {
	exec("cp $imgpath/$srcimg $imgpath/$dstimg");
	return;
	}    
	
	$dst = imageCreatetrueColor($rewidth, $reheight);
	
	if($src_info[2] == 1) $src = ImageCreateFromGIF("$imgpath/$srcimg");
	elseif($src_info[2] == 2) $src = ImageCreateFromJPEG("$imgpath/$srcimg");	
	elseif($src_info[2] == 3) $src = ImageCreateFromPNG("$imgpath/$srcimg");
		
	imagecopyResampled($dst, $src,0,0,0,0,$rewidth,$reheight,ImageSX($src),ImageSY($src));
	
	switch($exif['Orientation']) {
        case 8:
            $dst = imagerotate($dst,90,0);
            break;
        case 3:
            $dst = imagerotate($dst,180,0);
            break;
        case 6:
            $dst = imagerotate($dst,-90,0);
            break;
    }
	
	Imagejpeg($dst,"$imgpath/$dstimg",100);
			
	imageDestroy($src);
	imageDestroy($dst);
}
?>

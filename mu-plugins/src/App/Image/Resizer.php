<?php
namespace App\Image;
class Resizer
{
    public function resize($sourcePath, $savePath, $width = 400, $height = 260, $doCrop =false)
    {
        //echo "resize image ". $sourcePath;
        $imageEditor = wp_get_image_editor($sourcePath);

        if($imageEditor instanceof \WP_Error){
            throw new \Exception($imageEditor->get_error_message());
        }

        $canResize = $imageEditor->resize($width, $height, $doCrop);
        if(!$canResize || $canResize instanceof \WP_Error){

            //wordpress cannot upscale the image while resize, in this case it can throw WP_Error with code error_getting_dimensions
            //in this case, return the original image
            if($canResize instanceof \WP_Error && $canResize->get_error_code()=='error_getting_dimensions'){

            }else{
                throw new \Exception($canResize->get_error_message());
            }
        }
        $result = $imageEditor->save($savePath);

        if($result instanceof \WP_Error){
            throw new \Exception($result->get_error_message());
        }

       return $result['path'];
    }
}
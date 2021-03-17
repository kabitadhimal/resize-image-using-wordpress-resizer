<?php
namespace App\Image;
class ImageManager
{
    public static function getImagePath($imageId, $sizeLabel ='large')
    {
        if($sizeLabel == 'actual'){
            return site_url()."/files/media/{$imageId}";
        }
        return site_url()."/files/resized-media/{$sizeLabel}/{$imageId}";
    }

    public static function getSmallImagePath($imageId)
    {
        return self::getImagePath($imageId, 'small');
    }

    public static function getThumbnailImagePath($imageId)
    {
        return self::getImagePath($imageId, 'thumbnail');
    }

    public static function getOriginalImagePath($imageId)
    {
        $actualFilePath = ABSPATH."files/media/{$imageId}";
        return (file_exists($actualFilePath)) ? $actualFilePath : false;
    }
}
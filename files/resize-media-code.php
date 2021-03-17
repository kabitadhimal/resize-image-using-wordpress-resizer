<?php
/*
 * Use the following code to resize the image inside the theme folder
 */
use App\Image\ImageManager;
$imgSrc = 'image_2.jpg';
$originalImage = ImageManager::getOriginalImagePath($imgSrc);
$smallImage = ImageManager::getSmallImagePath($imgSrc);
$thumbnailImage = ImageManager::getThumbnailImagePath($imgSrc);
$largeImage = ImageManager::getImagePath($imgSrc);
$mediumImage = ImageManager::getImagePath($imgSrc,'medium');
$pThumbnailImage = ImageManager::getImagePath($imgSrc,'p-thumbnail');
$tinyImage = ImageManager::getImagePath($imgSrc,'tiny');

?>
<img src="<?=$originalImage?>" />
<img src="<?=$smallImage?>" />
<img src="<?=$thumbnailImage?>" />
<img src="<?=$largeImage?>" />
<img src="<?=$mediumImage?>" />
<img src="<?=$pThumbnailImage?>" />
<img src="<?=$mediumImage?>" />
<img src="<?=$tinyImage?>" />
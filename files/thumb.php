<?php
use App\Image\ImageManager;
use App\Image\Resizer;
use Symfony\Component\HttpFoundation\Request;
require __DIR__ . '/../wp-load.php';

/*
 * This file is used to resize the image using the WP resizer
 * Don't delete the media folder and htaccess file
 * The Actual image path  is inside the Media folder i.e media
 * All the resized image are stored inside the resized-media folder .i.e. resized-media/
 * The structure of the image to be resized : http://YOUR-DOMAIN/files/resized-media/IMAGE-SIZE/image_1.jpg
 */
$mediaBaseDir = ABSPATH . 'files/resized-media/';

$allowedSize = [
    'large' => [
        1000,
        800,
        false
    ],
    'medium' => [
        675,
        475,
        false
    ],
    'small' => [
        400,
        300,
        true
    ],
    'thumbnail' => [
        437,
        300,
        true
    ],

    'p-thumbnail' => [
        300,
        400,
        true
    ],

    'tiny' =>[
        68,
        68,
        true
    ]
];

$defaultImageUrl = site_url() . '/files/no-image.png';

$request = new Request($_GET);
$imageId = $request->query->get('id');
$imageSize = $request->query->get('size');


$error = '';

$actualImagePath = ImageManager::getOriginalImagePath($imageId);

/*
 *
 * check if original file exists
 * check if original file exists else download it from placeholder
 *
 * if the original file doesn't exist download
 *
 *
 */
if ($imageSize == 'actual') {
    $imageUrl = ImageManager::getImagePath($imageId, $imageSize);
    header("Location: {$imageUrl}");
    die();
}

if (! array_key_exists($imageSize, $allowedSize)) {
    $imageUrl = ImageManager::getImagePath($imageId, 'actual');
    header("Location: {$imageUrl}");
    die();
}

$resizeAttr = $allowedSize[$imageSize];
$resizeImagePath = $mediaBaseDir . "{$imageSize}/{$imageId}";
// $resizeImageUri = $mediaBaseUrl."{$imageSize}/{$imageId}.jpg";
$resizeImageUri = ImageManager::getImagePath($imageId, $imageSize);

$resizer = new Resizer();
$result = $resizer->resize($actualImagePath, $resizeImagePath, $resizeAttr[0], $resizeAttr[1], $resizeAttr[2]);

if ($result) {
    header("Location: {$resizeImageUri}");
    die();
}

header("Location: {$defaultImageUrl}");

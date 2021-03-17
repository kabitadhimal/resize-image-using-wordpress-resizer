# Information
1. The original images are stored are inside the Media folder i.e. files/media 
2. All the resized image are stored inside the media folder .i.e. resized-media/new-image-size
3. In files/thumb.php define the different image sizes to be resized inside the allowed size array
    Example :
  ```` $allowedSize = [
        'new-image-size' => [
            500,
            400,
            false
        ]
    ];
   ````

4. In .htaccess file add the name of the image size to be resized .i.e. resized-media/
    i.e.RewriteRule ^resized-media/(actual|large|medium|small|thumbnail|p-thumbnail|tiny|new-image-size)/(.*.jpg|JPG|png|gif)$ thumb.php?size=$1&id=$2
    The logic here, is when the image with the defined image size is browsed, it goes to the thumb.php and does the resizing job.
    Thus, resized image is saved in the resized-media folder.
   








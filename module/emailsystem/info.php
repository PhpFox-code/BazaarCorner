<?php
$file_path = dirname(__FILE__);
$pos = strpos($file_path,DIRECTORY_SEPARATOR.'module'.DIRECTORY_SEPARATOR);
if( $pos!== false)
{
    $path = (dirname(__FILE__)).DIRECTORY_SEPARATOR.'queuemail.php';    
}
else
{
    $path = ((dirname(__FILE__))).DIRECTORY_SEPARATOR.'queuemail.php';
}
echo "php ".$path;
?>

<?php

declare(strict_types=1);

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class DomCreate
{
    public static function createDom($content){
        
                $content = '<html>'. $content .'</html>';
                    $dom = new \DOMDocument('1.0', 'UTF-8');
                    $dom->loadHtml("\xEF\xBB\xBF" .$content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
                    $imageFile = $dom->getElementsByTagName('img');
        
                    foreach($imageFile as $item => $image){
                        $imageSrc = $image->getAttribute('src');
                        $imageName = $image->getAttribute('data-filename');
                        
                        if(substr($imageSrc, 0, 4) == 'data'){
        
                            list($type, $imageSrc) = explode(';', $imageSrc);
        
                            list(, $imageSrc)   = explode(',', $imageSrc);
            
                            $imgeData = base64_decode( $imageSrc);
        
                           Storage::disk('public')->put('images/'.$imageName, $imgeData);
        
                           $filePath = '/storage/images/'.$imageName;
                         
                            $image->removeAttribute('src');
                            $image->setAttribute('src', $filePath);
                        }
                         
                    }
                    $content = html_entity_decode(str_replace(array('<html>','</html>') , '' , $dom->saveHTML()));

                    return $content;
    }

}
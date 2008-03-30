<?php

$feed = "http://api.flickr.com/services/feeds/photos_public.gne?tags=simpletest&amp;format=atom&amp;en-us";
$source = simplexml_load_file($feed, "SimpleFlickrStreamXMLElement");
echo $source->showLastPhotos();

class SimpleFlickrStreamXMLElement extends SimpleXMLElement {
    function showLastPhotos() {
	    $html = "";
	    foreach ($this->entry as $entry) {
	        $html .= "<div class=\"photo\">";
	        $html .= "<span class=\"title\">".$entry->title."</span>";
	        $html .= "<span class=\"image\">".$this->extractFirstImage($entry)."</span>";
	        $html .= "<span class=\"author\">".$this->extractAuthor($entry)."</span>";
	        $html .= "</div>";
	    }
	    return $html;
	}
	
	function extractAuthor($entry) {
        return 	"<a href=\"".$entry->author->uri."\">".$entry->author->name."</a>";
	}
	
	function extractFirstImage($entry) {
        $content = $entry->content;
	    $content = substr($content, strpos($content, "<img src"));
        $image = substr($content, 0, strpos($content, " />") + 3);
        
        return 	"<a href=\"".$entry->link[0]['href']."\">".$image."</a>";
    }
}
?>

<?php
//if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class movie {
    var $id; // Movie ID
    var $title;  // Movie title
    var $keywords;    // Movie keywords
    var $loc;  // Movie Watch URL
    var $download;  // Movie Download URL
    var $imgthumb;  // Preview image thumbnail
    var $imgfull;  // Preview image full
    var $added;  // Movie add date (UNIX timestamp)
    var $added2;  // Movie add date (YYYY-mm-dd HH:MM format)
    var $lenghtsec;  // Movie lenght in seconds
    var $lenghtmin;  // Movie lenght (MM:SS format)
    var $embedscript;  // URL to javascript file inserting embeded movie to your site

    function movie ($aa)
    {
        foreach ($aa as $k=>$v)
            $this->$k = $aa[$k];
    }

}

class movieLoader{

    function parseMov($mvalues)
    {
        for ($i=0; $i < count($mvalues); $i++) {
            $mov[$mvalues[$i]["tag"]] = $mvalues[$i]["value"];
        }
        return new movie($mov);
    }

    function readDatabase($filename)
    {
        // read the XML database of aminoacids
        $data = implode("", file($filename));
        $parser = xml_parser_create();
        xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, 0);
        xml_parser_set_option($parser, XML_OPTION_SKIP_WHITE, 1);
        xml_parse_into_struct($parser, $data, $values, $tags);
        xml_parser_free($parser);

        // loop through the structures
        foreach ($tags as $key=>$val) {
            if ($key == "movie") {
                $movranges = $val;
                // each contiguous pair of array entries are the
                // lower and upper range for each movie definition
                for ($i=0; $i < count($movranges); $i+=2) {
                    $offset = $movranges[$i] + 1;
                    $len = $movranges[$i + 1] - $offset;
                    $tdb[] = $this->parseMov(array_slice($values, $offset, $len));
                }
            } else {
                continue;
            }
        }
        return $tdb;
    }
}
/*
$url="http://www.eporner.com/api_xml/all/5";
$mL=new movieLoader();
$db=$mL->readDatabase($url);
echo "end";
*/



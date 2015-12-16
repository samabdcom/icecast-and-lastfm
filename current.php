<?php

$playlistUrl = 'http://yourstreamip:port/your_stream.xspf';
$xmldata = file_get_contents($playlistUrl);

$xml = new SimpleXMLElement($xmldata);

foreach( $xml->trackList->track as $track ) {
	echo $track->title .' - '. $track->creator .'<br>';
}

define(LAST_FM_API, 'yourlastfmapi');

function getArtistInfo($stream){
	$url = 'http://ws.audioscrobbler.com/2.0/?method=artist.getInfo&artist='.urlencode($stream['info']['artist']).'&api_key='.LAST_FM_API.'&autocorrect=1';
	$xmldata = file_get_contents($url);
	$xml = new SimpleXMLElement($xmldata);
	if($stream['info']['artist'] == 'Unknown') {
	    echo '<img width="174" height="174" src=\'unknown-person.gif\' />';
	} else if(!empty($xml->artist->image[2])) { 
        echo '<img src='.$xml->artist->image[2].'/>'; //large
    } else {
        echo '<img width="174" height="174" src=\'unknown-person.gif\' />';
    }
    echo '<br>';
    
}

$qwe['info']['artist'] = $xml->trackList->track->creator;
getArtistInfo($qwe);

?>
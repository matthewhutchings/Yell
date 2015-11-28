<?php
require 'scraperwiki.php'; 
require 'simple_html_dom.php';


$url_base = "https://www.yell.com/ucs/UcsSearchAction.do?keywords=pizza&location=southampton&scrambleSeed=833794509";


$mainUrl = scraperWiki::scrape($url_base);
$dom = new simple_html_dom();
$dom->load($mainUrl);

# Just focus on the a section of the web site
$dataset = $dom->find("div.businessCapsule-fle");



# The usual, look for the data set and if needed, save it
foreach($dataset as $record) {
    # Slow way to transform the date but it works
     
    # Put all information in an array
    $application = array (
        'name' => trim($record->find("div.businessCapsule--title")->plaintext),
        'date_received' => date('Y-m-d', strtotime($date_received))
    );

        scraperwiki::save(array('council_reference'), $application);



}
?>

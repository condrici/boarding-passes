<?php

/**
 * Example of using the Itinerator Application
 */

// Debugging
ini_set('display_errors', 'on');
ini_set('display_startup_errors', 'on');
error_reporting(E_ALL);

// Dependencies
require __DIR__ . '/vendor/autoload.php';
use Itinerator\ItineratorSorter;

// Sample Boarding Tickets
$boardingCards = json_decode(file_get_contents('sample.json'), true);

// Get Itinerary
$itinerator = new ItineratorSorter($boardingCards);
$itineratorObjects = $itinerator->sort()->getItineraryObjects();

foreach ($itineratorObjects as $itineratorObject) {
    echo $itineratorObject->getItinerary() . "<br />";
}
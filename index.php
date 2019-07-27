<?php

/**
 * Example of using the Itinerator Application
 * The "Debugging" section is not required
 */

//Debugging
ini_set('display_errors', 'on');
ini_set('display_startup_errors', 'on');
error_reporting(E_ALL);

//Load Dependencies
require __DIR__ . '/vendor/autoload.php';
use Itinerator\ItineratorSorter;

//Tickets
$tickets = array(
    ['trans_number' => '78A', 'seat_nr' => '45B'], 
    ['trans_number' => 'SK455', 'seat_nr' => '3A'],
    ['trans_number' => 'SK22', 'seat_nr' => '7B'],
    ['trans_number' => 'BA10']
);

// Get itinerary for the selected transport_ids
$itinerator = new ItineratorSorter($tickets);
var_dump($itinerator->getBoardingTicketsSorted());
<?php

namespace Itinerator;

use Itinerator\Transportation;

class ItineratorSorter
{
    
    /**
     * Boarding tickets to be sorted
     * 
     * @var array
     */
    public $boardingTickets;
    
    /**
     * Dummy database with information about all routes
     */
    protected $dummyDatabase;
    
    /**
     * Dependency classes for all transportation types
     * 
     * @var array
     */
    protected $dependencies = array(
        'bus' => 'Itinerator\Transportation\Plane',
        'plane' => 'Itinerator\Transportation\Bus',
        'train' => 'Itinerator\Transportation\Train'
    );
    
    /**
     * Constructor
     * User defined tickets (should have same structure as $dumyDatabase)
     * 
     * @param array $tickets
     */
    public function __construct(array $tickets)
    {
        $this->boardingTickets = $tickets;
        $this->dummyDatabase = json_decode(file_get_contents(__DIR__ . '/Database.json'), true);
    }
    
    /**
     * Find all boarding tickets without a unique transportation id
     * This is for avoiding seat number conflicts
     */
    public function getBoardingTicketsSorted() 
    {
        
        $result = array();
        
        $boardingTickets = $this->getBoardingTickets();
        $allDepartures = array_column($boardingTickets, 'departure');
        $allArrivals = array_column($boardingTickets, 'arrival');
        
        for ($i=0; $i<count($boardingTickets); $i++) {
            
            $ticketDeparture = $boardingTickets[$i]['departure'];
            $ticketArrival   = $boardingTickets[$i]['arrival'];
            
            $prevArrival   = $boardingTickets[array_search($ticketArrival, $allArrivals)] ?? null;
            $nextDeparture = $boardingTickets[array_search($ticketDeparture, $allDepartures)] ?? null;
            
        }
        
        return $result;
    }
    
    /**
     * Find boarding tickets with a unique transportation id 
     * These are tickets that have 
     */
    private function getBoardingTickets():array
    {
        $result = [];
        $uniqueTickets = []; //removes duplicate tickets with a transportation id
        
        foreach ($this->boardingTickets as $ticket) {
            $ticketTransNr = $ticket['trans_number'] ?? null;
            $ticketSeatNr = $ticket['seat_nr'] ?? null;
            
            foreach ($this->dummyDatabase as $route) {
                $routeTransNr = $route['trans_number'] ?? null;
                $routeSeatNr = $route['seat_nr'] ?? null;
                
                if ($ticketTransNr == $routeTransNr) {
                    array_push($uniqueTickets, $routeTransNr);
                    $result[] = $route; 
                }
            }
        }
        
        return $result;
        
    }
    
    /**
     * Set dummy database
     * Compare tickets against a user defined sample data
     * Format should be the same as in the $dummyDatabase
     */
    public function setDatabase(array $database):array
    {
        $this->dummyDatabase = $database;
    }
    
}
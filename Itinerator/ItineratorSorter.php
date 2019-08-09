<?php

namespace Itinerator;

use Itinerator\Transportation;

class ItineratorSorter
{

    /**
     * Dependency classes for all transportation types
     *
     * @var array
     */
    protected $dependencies = array(
        'bus' => 'Itinerator\Transportation\Bus',
        'train' => 'Itinerator\Transportation\Train',
        'plane' => 'Itinerator\Transportation\Plane'
    );

    /**
     * Boarding tickets to be sorted
     * 
     * @var array
     */
    public $boardingTickets;
    
    /**
     * Constructor
     * 
     * @param array $boardingTickets
     */
    public function __construct(array $boardingTickets)
    {
        $this->boardingTickets = $boardingTickets;
    }

    /**
     * Sort
     * The order of the inner methods is important
     */
    public function sort(): object
    {
        $this->sortFirstLast();
        $this->sortByConnection();
        return $this;
    }

    /**
     * Get itinerary objects for all boarding tickets
     */
    public function getItineraryObjects(): array
    {

        $itinerary = array();

        try {
            foreach ($this->boardingTickets as $ticket) {
                $type = strtolower($ticket['Transportation']);
                if (!isset($this->dependencies[$type])) {
                    throw new \Exception('Unknown transportation type for: ' . $type);
                }
                $itinerary[] = new $this->dependencies[$type]($ticket);
            }
            return $itinerary;
        } catch(\Exception $e) {
            exit($e->getMessage());
        }

    }

    /**
     * Update order of the first/last transports
     */
    private function sortFirstLast(): void
    {

        $departures = array_column($this->boardingTickets, 'Departure');
        $arrivals = array_column($this->boardingTickets, 'Arrival');

        for ($i=0; $limit=count($arrivals), $i<$limit; $i++) {
            if (!in_array($arrivals[$i], $departures)) {
                array_push($this->boardingTickets, $this->boardingTickets[$i]);
                unset($this->boardingTickets[$i]);
            } else if (!in_array($departures[$i], $arrivals)) {
                array_unshift($this->boardingTickets, $this->boardingTickets[$i]);
                unset($this->boardingTickets[$i]);
            }
        }

        // Reset keys
        $this->boardingTickets = array_values($this->boardingTickets);

    }

    /**
     * Sort transportations by subsequent arrival/departure
     */
    private function sortByConnection(): void
    {
        for ($i=0, $limit=count($this->boardingTickets); $i<$limit; $i++ ) {
            foreach ($this->boardingTickets as $index => $ticket) {
                if (strcasecmp($this->boardingTickets[$i]['Arrival'], $ticket['Departure']) == 0) {
                    $nextIndex = $i+1;
                    $nextTicket = $this->boardingTickets[$nextIndex];
                    $this->boardingTickets[$nextIndex] = $ticket;
                    $this->boardingTickets[$index] = $nextTicket;
                    break;
                }
            }
        }

    }
    
}
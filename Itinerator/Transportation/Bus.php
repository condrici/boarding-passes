<?php

namespace Itinerator\Transportation;

class Bus extends TransportationAbstract 
{
    
    protected $transportNr;
    protected $cabinBaggage;
    protected $seatNr;
    protected $gateNr;
    
    /**
     * Construct
     * 
     * @param string $transportNr
     */
    public function __construct($transportNr) 
    {
        $this->transportNr = $transportNr;
    }
    
    /**
     * Itinerary
     * 
     * {@inheritDoc}
     * @see \Itinerator\Contracts\Transportation::getItinerary()
     */
    public function getItinerary():string 
    {
        
    }
    
}
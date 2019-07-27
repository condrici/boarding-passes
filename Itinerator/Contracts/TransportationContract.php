<?php

namespace Itinerator\Contracts;

interface TransportationContract
{
    
    /**
     * Get the itinerary for a transportation
     */
    public function getItinerary():string;
    
}
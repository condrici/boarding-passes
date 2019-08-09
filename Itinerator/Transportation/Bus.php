<?php

namespace Itinerator\Transportation;

class Bus extends TransportationAbstract 
{

    const MESSAGE_INTRO = 'Take the airport bus from %s to %s. ';
    const MESSAGE_SEAT = 'No seat assignment.';

    /**
     * Show full itinerary
     *
     * @return string
     */
    public function getItinerary(): string
    {
        $message = static::MESSAGE_INTRO . static::MESSAGE_SEAT;

        return sprintf(
            $message,
            $this->departure,
            $this->arrival
        );
    }
    
}
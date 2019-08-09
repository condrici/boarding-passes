<?php

namespace Itinerator\Transportation;

class Train extends TransportationAbstract {

    protected $transportationNumber;
    protected $seat;

    const MESSAGE_INTRO = 'Take train %s from %s to %s. ';
    const MESSAGE_SEAT  = 'Seat number %s.';

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
            $this->transportationNumber,
            $this->departure,
            $this->arrival,
            $this->seat
        );
    }
    
}
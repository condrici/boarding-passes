<?php

namespace Itinerator\Transportation;

class Plane extends TransportationAbstract {

    protected $transportationNumber;
    protected $gate;
    protected $seat;
    protected $baggage;

    const MESSAGE_INTRO = 'From %s, take flight %s to %s. ';
    const MESSAGE_GATE_SEAT = 'Gate %s, seat %s. ';
    const MESSAGE_NO_BAGGAGE =  'Baggage will be automatically transferred from your last leg.';
    const MESSAGE_BAGGAGE =  'Baggage drop at ticket counter %s.';

    /**
     * Show full itinerary
     *
     * @return string
     */
    public function getItinerary(): string
    {

        $message =  sprintf(
            static::MESSAGE_INTRO . static::MESSAGE_GATE_SEAT,
            $this->departure,
            $this->transportationNumber,
            $this->arrival,
            $this->gate,
            $this->seat,
            $this->baggage
        );

        // Baggage handling
        if (!empty($this->baggage)) {
            $message = sprintf($message . static::MESSAGE_BAGGAGE, $this->baggage);
        } else {
            $message = sprintf($message . static::MESSAGE_NO_BAGGAGE, $this->baggage);
        }

        return $message;

    }
    
}
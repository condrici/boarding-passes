<?php 

namespace Itinerator\Transportation;

use Itinerator\Contracts\TransportationContract;

abstract class TransportationAbstract implements TransportationContract {
    
    /**
     * 
     * @var string
     */
    public $departure;
    
    /**
     * 
     * @var string
     */
    public $arrival;
    
    
}
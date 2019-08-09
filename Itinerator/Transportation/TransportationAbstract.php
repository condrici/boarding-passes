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

    /**
     * Constructor
     */
    public function __construct(array $ticket)
    {
        foreach ($ticket as $key => $value) {
            $property = lcfirst(
                str_replace(' ', '', ucwords(str_replace('_', ' ', $key)))
            );
            if (property_exists($this, $property)) {
                $this->{$property} = $value;
            }
        }
    }
    
    
}
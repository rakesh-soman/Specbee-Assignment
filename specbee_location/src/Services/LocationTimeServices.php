<?php

namespace Drupal\specbee_location\Services;

use Drupal\Core\Config\ConfigFactoryInterface;


/**
 * Class LocationTimeServices.
 */
class LocationTimeServices
{

    protected $configFactory;

    /**
     * Constructor 
     */
    public function __construct(ConfigFactoryInterface $config_factory)
    {
        $this->configFactory = $config_factory;
    }

    public function getLocationAndTime()
    {
        $config = $this->configFactory->getEditable('specbee_location.settings');
        return [
            'country' => $config->get('country'),
            'city' => $config->get('city'),
            'time' => $this->getCurrentTime()
        ];
    }

    public function getCurrentTime()
    {
        $timezone = $this->configFactory->getEditable('specbee_location.settings')->get('timezone');
        $tz = new \DateTimeZone($timezone);
        $date = new \DateTime();
        return $date->setTimezone($tz)->format('j F Y g:i A');
        
    }
    
}

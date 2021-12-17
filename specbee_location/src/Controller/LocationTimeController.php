<?php

namespace Drupal\specbee_location\Controller;

use Drupal\Core\Controller\ControllerBase;






/**
 * Class AjaxGalleryController.
 */
class LocationTimeController extends ControllerBase {

  


  /**
   * Get Location.
   *
   * @return array
   *   Return render array.
   */
  public function getBlockPlugin() {
    return [
        '#theme' => 'location',
    ];
  }

  
}

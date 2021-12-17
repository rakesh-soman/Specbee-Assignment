<?php

namespace Drupal\specbee_location\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Cache\CacheableMetadata;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides an  location time block.
 *
 * @Block(
 *   id = "specbee_location_location_time",
 *   admin_label = @Translation("Location Time"),
 *   category = @Translation("Specbee Location")
 * )
 */
class LocationTimeBlock extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * Drupal\specbee_location\Services\LocationTimeServices definition.
   *
   * @var \Drupal\specbee_location\Services\LocationTimeServices
   */
  protected $locationTimeService;

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    $instance = new static($configuration, $plugin_id, $plugin_definition);
    $instance->locationTimeService = $container->get('specbee_location.time_loc');
    return $instance;
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $build = [];
    $build['#theme'] = 'location_block';
    $build['#content'] = [
      'location_time' => $this->locationTimeService->getLocationAndTime(),
    ];
    $cacheMetaData = new CacheableMetadata();
    $cacheMetaData->addCacheContexts(array('user'));
    $cacheTagConfig = 'config:specbee_location.settings';
    $cacheMetaData->addCacheTags(array($cacheTagConfig));
    $cacheMetaData->applyTo($build);
    return $build;
    
  }

}

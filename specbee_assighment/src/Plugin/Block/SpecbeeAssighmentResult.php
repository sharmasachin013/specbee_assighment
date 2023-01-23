<?php

namespace Drupal\specbee_assighment\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

// Use Drupal\specbee_assighment\SpecebeeInterface.
// Use Drupal\specbee_assighment\SpecbeeAssignment.

/**
 * Provides a 'SpecbeeAssighmentResult' block.
 *
 * @Block(
 *  id = "specbee_assighment_result",
 *  admin_label = @Translation("Specbee Assighment Result"),
 * )
 */
class SpecbeeAssighmentResult extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * {@inheritdoc}
   */
  protected $apecbeeAssighment;

  /**
   * Load custom services  specbee.assignment.
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    $instance = new static($configuration, $plugin_id, $plugin_definition);
    $instance->apecbeeAssighment = $container->get('specbee.assignment');
    return $instance;
  }

  /**
   * Function for block content.
   */
  public function build() {
    $build = [];
    $data = $this->apecbeeAssighment->getTimeZone();
    $build['#theme'] = 'specbee_assighment_result';
    $build['#cache'] = [
      'tags' => ['config:specbee_assighment.specbeeadmin'],
    ];
    $build['#time'] = $data['time'];
    $build['#city'] = $this->apecbeeAssighment->getCity();
    $build['#country'] = $this->apecbeeAssighment->getCountry();
    $build['#day'] = $data['day'];
    $build['#timezone'] = $data['tz'];
    $build['specbee_assighment_result']['#markup'] = 'Implement SpecbeeAssighmentResult.';
    return $build;
  }

}

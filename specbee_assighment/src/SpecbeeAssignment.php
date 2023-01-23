<?php

namespace Drupal\specbee_assighment;

use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Datetime\DrupalDateTime;

/**
 * Class SpecbeeAssignment for custom Service.
 */
class SpecbeeAssignment implements SpecebeeInterface {

  /**
   * Drupal\Core\Config\ConfigFactoryInterface definition.
   *
   * @var \Drupal\Core\Config\ConfigFactoryInterface
   */
  protected $configFactory;

  /**
   * Constructs a new SpecbeeAssignment object.
   */
  public function __construct(ConfigFactoryInterface $config_factory) {
    $this->configFactory = $config_factory;
  }

  /**
   * Function for get city value.
   */
  public function getCity() {
    $worldapi = $this->configFactory->get('specbee_assighment.specbeeadmin');
    return $worldapi->get('city');
  }

  /**
   * Function for get Country Value.
   */
  public function getCountry() {
    $worldapi = $this->configFactory->get('specbee_assighment.specbeeadmin');
    return $worldapi->get('country');
  }

  /**
   * Function for time calculation.
   */
  public function getTimeZone() {
    $worldapi = $this->configFactory->get('specbee_assighment.specbeeadmin');
    $tz = $worldapi->get('timezone');
    $result = [];
    $current_time = new DrupalDateTime('now', 'UTC');
    $date_time = new DrupalDateTime();
    $userTimezone = new \DateTimeZone($tz);
    $timezone_offset = $userTimezone->getOffset($date_time->getPhpDateTime());
    $time_interval = \DateInterval::createFromDateString($timezone_offset . 'seconds');
    $current_time->add($time_interval);
    $completeTime = $current_time->format('h:i a');
    $completeDay = $current_time->format('l,d F Y');
    $arr['time'] = $completeTime;
    $arr['day'] = $completeDay;
    $arr['tz'] = $tz;
    return $arr;
  }

}

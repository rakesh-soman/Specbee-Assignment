<?php

namespace Drupal\specbee_location\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configure Specbee Location settings for this site.
 */
class SettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'specbee_location_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['specbee_location.settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['country'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Country Name'),
      '#default_value' => $this->config('specbee_location.settings')->get('country'),
    ];
    $form['city'] = [
      '#type' => 'textfield',
      '#title' => $this->t('City Name'),
      '#default_value' => $this->config('specbee_location.settings')->get('city'),
    ];
    $options = [
      'America/Chicago' => 'America/Chicago',
      'America/New_York' => 'America/New_York',
      'Asia/Tokyo' => 'Asia/Tokyo',
      'Asia/Dubai' => 'Asia/Dubai',
      'Asia/Kolkata' => 'Asia/Kolkata',
      'Europe/Amsterdam' => 'Europe/Amsterdam',
      'Europe/Oslo' => 'Europe/Oslo',
       'Europe/London' => 'Europe/London'
    ];
    $form['timezone'] = [
      '#type' => 'select',
      '#title' => 'Location',
      '#options' => $options,
      '#default_value' => $this->config('specbee_location.settings')->get('timezone'),
    ];
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    if ($form_state->getValue('country') == '') {
      $form_state->setErrorByName('country', $this->t('Please enter country Name.'));
    }
    if ($form_state->getValue('city') == '') {
      $form_state->setErrorByName('city', $this->t('Please enter city Name.'));
    }
    if ($form_state->getValue('timezone') == '') {
      $form_state->setErrorByName('timezone', $this->t('Please select time zone.'));
    }
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->config('specbee_location.settings')
      ->set('country', $form_state->getValue('country'))
      ->set('city', $form_state->getValue('city'))
      ->set('timezone', $form_state->getValue('timezone'))
      ->save();
    parent::submitForm($form, $form_state);
  }

}

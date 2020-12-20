<?php

namespace Drupal\ebms_print_status\Form;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Print status value form.
 */
class PrintStatusForm extends EntityForm {

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {

    $form = parent::form($form, $form_state);

    $form['id'] = [
      '#type' => 'machine_name',
      '#default_value' => $this->entity->id(),
      '#description' => $this->t('Machine id for this print status.'),
      '#machine_name' => [
        'exists' => '\Drupal\ebms_print_status\Entity\PrintStatus::load',
      ],
      '#disabled' => !$this->entity->isNew(),
      '#required' => TRUE,
    ];

    $form['label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Label'),
      '#maxlength' => 32,
      '#default_value' => $this->entity->label(),
      '#description' => $this->t('Display name for this print status.'),
      '#required' => TRUE,
    ];

    $form['description'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Description'),
      '#maxlength' => 2048,
      '#default_value' => $this->entity->description,
      '#description' => $this->t('Longer, more descriptive explanation of the print status.'),
    ];

    return $form;
  }

}

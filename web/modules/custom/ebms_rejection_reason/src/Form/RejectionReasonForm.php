<?php

namespace Drupal\ebms_rejection_reason\Form;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form for article rejection reasons.
 */
class RejectionReasonForm extends EntityForm {

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {

    $form = parent::form($form, $form_state);

    $active = $this->entity->isNew() ? TRUE : $this->entity->get('active');
    $form['id'] = [
      '#type' => 'machine_name',
      '#default_value' => $this->entity->id(),
      '#description' => $this->t('Machine id for this reason.'),
      '#machine_name' => [
        'exists' => '\Drupal\ebms_rejection_reason\Entity\RejectionReason::load',
      ],
      '#disabled' => !$this->entity->isNew(),
    ];

    $form['label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Label'),
      '#maxlength' => 80,
      '#default_value' => $this->entity->label(),
      '#description' => $this->t('Display string for the rejection reason.'),
      '#required' => TRUE,
    ];

    $form['sequence'] = [
      '#type' => 'number',
      '#min' => 1,
      '#required' => TRUE,
      '#title' => $this->t('Sequence'),
      '#description' => $this->t('Order in the user interface.'),
      '#default_value' => $this->entity->get('sequence'),
    ];

    $form['extra_info'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Extra information'),
      '#maxlength' => 255,
      '#default_value' => $this->entity->extra_info,
      '#description' => $this->t('Optional additional explanation for the user interface.'),
    ];

    $form['active'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('This value is currently available for future reviews.'),
      '#default_value' => $active,
    ];

    return $form;
  }

}

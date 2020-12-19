<?php

namespace Drupal\ebms_disposition\Form;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Article disposition value form.
 */
class DispositionForm extends EntityForm {

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {

    $form = parent::form($form, $form_state);

    $form['id'] = [
      '#type' => 'machine_name',
      '#default_value' => $this->entity->id(),
      '#description' => $this->t('Machine id for this disposition'),
      '#machine_name' => [
        'exists' => '\Drupal\ebms_disposition\Entity\Disposition::load',
      ],
      '#disabled' => !$this->entity->isNew(),
      '#required' => TRUE,
    ];

    $form['label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Label'),
      '#maxlength' => 80,
      '#default_value' => $this->entity->label(),
      '#description' => $this->t('Display name for this disposition.'),
      '#required' => TRUE,
    ];

    $form['instructions'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Instructions'),
      '#maxlength' => 255,
      '#default_value' => $this->entity->instructions,
      '#description' => $this->t('Longer, more descriptive explanation of the disposition.'),
    ];

    $form['sequence'] = [
      '#type' => 'number',
      '#min' => 1,
      '#required' => TRUE,
      '#title' => $this->t('Sequence'),
      '#description' => $this->t('Order in the user interface'),
      '#default_value' => $this->entity->get('sequence'),
    ];

    return $form;
  }

}

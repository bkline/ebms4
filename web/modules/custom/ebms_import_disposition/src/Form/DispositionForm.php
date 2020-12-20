<?php

namespace Drupal\ebms_import_disposition\Form;

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
        'exists' => '\Drupal\ebms_import_disposition\Entity\ImportDisposition::load',
      ],
      '#disabled' => !$this->entity->isNew(),
      '#required' => TRUE,
    ];

    $form['label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Label'),
      '#maxlength' => 32,
      '#default_value' => $this->entity->label(),
      '#description' => $this->t('Display name for this disposition.'),
      '#required' => TRUE,
    ];

    $form['description'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Description'),
      '#maxlength' => 2048,
      '#default_value' => $this->entity->description,
      '#description' => $this->t('Longer, more descriptive explanation of the disposition.'),
    ];

    $form['active'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('This value is available for future imports'),
      '#default_value' => $this->entity->get('active'),
    ];

    return $form;
  }

}

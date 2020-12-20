<?php

namespace Drupal\ebms_internal_tag\Form;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Article internal tag value form.
 */
class TagForm extends EntityForm {

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {

    $form = parent::form($form, $form_state);

    $form['id'] = [
      '#type' => 'machine_name',
      '#default_value' => $this->entity->id(),
      '#description' => $this->t('Machine id for this tag'),
      '#machine_name' => [
        'exists' => '\Drupal\ebms_internal_tag\Entity\InternalTag::load',
      ],
      '#disabled' => !$this->entity->isNew(),
      '#required' => TRUE,
    ];

    $form['label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Label'),
      '#maxlength' => 255,
      '#default_value' => $this->entity->label(),
      '#description' => $this->t('Display name for this tag.'),
      '#required' => TRUE,
    ];

    $form['active'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('This value is available for future internal tagging of articles'),
      '#default_value' => $this->entity->get('active'),
    ];

    return $form;
  }

}

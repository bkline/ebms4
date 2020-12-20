<?php

namespace Drupal\ebms_document_tag\Form;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Document tag value form.
 */
class DocumentTagForm extends EntityForm {

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {

    $form = parent::form($form, $form_state);

    $form['id'] = [
      '#type' => 'machine_name',
      '#default_value' => $this->entity->id(),
      '#description' => $this->t('Machine id for this document tag.'),
      '#machine_name' => [
        'exists' => '\Drupal\ebms_document_tag\Entity\DocumentTag::load',
      ],
      '#disabled' => !$this->entity->isNew(),
      '#required' => TRUE,
    ];

    $form['label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Label'),
      '#maxlength' => 32,
      '#default_value' => $this->entity->label(),
      '#description' => $this->t('Display name for this document tag.'),
      '#required' => TRUE,
    ];

    $form['description'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Description'),
      '#maxlength' => 255,
      '#default_value' => $this->entity->description,
      '#description' => $this->t('Longer, more descriptive explanation of the document tag.'),
    ];

    return $form;
  }

}

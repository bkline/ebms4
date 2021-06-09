<?php

namespace Drupal\ebms_topic_group\Form;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Article topic group value form.
 */
class TopicGroupForm extends EntityForm {

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {

    $form = parent::form($form, $form_state);

    $form['id'] = [
      '#type' => 'machine_name',
      '#default_value' => $this->entity->id(),
      '#description' => $this->t('Machine id for this topic group'),
      '#machine_name' => [
        'exists' => '\Drupal\ebms_topic_group\Entity\TopicGroup::load',
      ],
      '#disabled' => !$this->entity->isNew(),
      '#required' => TRUE,
    ];

    $form['label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Label'),
      '#maxlength' => 32,
      '#default_value' => $this->entity->label(),
      '#description' => $this->t('Display name for this topic group.'),
      '#required' => TRUE,
    ];

    $form['active'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('This value is available for future imports'),
      '#default_value' => $this->entity->get('active'),
    ];

    return $form;
  }

}

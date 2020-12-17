<?php

namespace Drupal\ebms_article_state_type\Form;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Topic Group form.
 *
 * @property \Drupal\ebms_topic_group\EbmsTopicGroupInterface $entity
 */
class ArticleStateTypeForm extends EntityForm {

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {

    $form = parent::form($form, $form_state);

    $form['id'] = [
      '#type' => 'machine_name',
      '#default_value' => $this->entity->id(),
      '#description' => $this->t('Machine id for this state'),
      '#machine_name' => [
        'exists' => '\Drupal\ebms_article_state_type\Entity\ArticleStateType::load',
      ],
      '#disabled' => !$this->entity->isNew(),
    ];

    $form['label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Label'),
      '#maxlength' => 64,
      '#default_value' => $this->entity->label(),
      '#description' => $this->t('Display name for this state.'),
      '#required' => TRUE,
    ];

    $form['description'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Description'),
      '#maxlength' => 2048,
      '#default_value' => $this->entity->description,
      '#description' => $this->t('Longer, more descriptive explanation of the state.'),
    ];

    $form['sequence'] = [
      '#type' => 'integer',
      '#title' => $this->t('Sequence'),
      '#description' => $this->t('Order in the state workflow'),
      '#default_value' => $this->entity->get('sequence'),
    ];

    $form['completed'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('This state is terminal'),
      '#default_value' => $this->entity->get('completed'),
    ];

    $form['active'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('This value is available for future states'),
      '#default_value' => $this->entity->get('active'),
    ];

    return $form;
  }

}

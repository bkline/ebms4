<?php

namespace Drupal\ebms_article_tag_type\Form;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Topic Group form.
 *
 * @property \Drupal\ebms_topic_group\EbmsTopicGroupInterface $entity
 */
class ArticleTagTypeForm extends EntityForm {

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
        'exists' => '\Drupal\ebms_article_tag_type\Entity\ArticleTagType::load',
      ],
      '#disabled' => !$this->entity->isNew(),
    ];

    $form['label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Label'),
      '#maxlength' => 64,
      '#default_value' => $this->entity->label(),
      '#description' => $this->t('Display name for the tag.'),
      '#required' => TRUE,
    ];

    $form['description'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Description'),
      '#maxlength' => 2048,
      '#default_value' => $this->entity->description,
      '#description' => $this->t('Longer, descriptive help text explaining what the tag is used for.'),
    ];

    $form['topic_required'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('A topic must be specified for this tag'),
      '#default_value' => $this->entity->get('topic_required'),
    ];

    $form['active'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('This value is currently available for article tagging'),
      '#default_value' => $this->entity->get('active'),
    ];

    return $form;
  }

}

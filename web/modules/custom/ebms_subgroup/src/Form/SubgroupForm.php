<?php

namespace Drupal\ebms_subgroup\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for subgroups.
 *
 * @ingroup ebms
 */
class SubgroupForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form = parent::buildForm($form, $form_state);
    if ($this->entity->isNew()) {
      $form['#title'] = $this->t('Add Subgroup');
    }
    else {
      $form['#title'] = $this->t('Edit Subgroup');
    }
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $entity = $this->entity;

    $status = parent::save($form, $form_state);

    switch ($status) {
      case SAVED_NEW:
        $this->messenger()->addMessage($this->t('Created the %label group.', [
          '%label' => $entity->label(),
        ]));
        break;

      default:
        $this->messenger()->addMessage($this->t('Saved the %label group.', [
          '%label' => $entity->label(),
        ]));
    }
    $form_state->setRedirect('entity.ebms_subgroup.canonical', ['ebms_subgroup' => $entity->id()]);
  }

}

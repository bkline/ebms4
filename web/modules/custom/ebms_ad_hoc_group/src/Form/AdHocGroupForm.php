<?php

namespace Drupal\ebms_ad_hoc_group\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Form controller for ad-hoc groups.
 *
 * @ingroup ebms
 */
class AdHocGroupForm extends ContentEntityForm {

  /**
   * The current user account.
   *
   * @var \Drupal\Core\Session\AccountProxyInterface
   */
  protected $account;

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    // Instantiates this form class.
    $instance = parent::create($container);
    $instance->account = $container->get('current_user');
    return $instance;
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form = parent::buildForm($form, $form_state);
    if ($this->entity->isNew()) {
      $form['#title'] = $this->t('Add Ad-Hoc Group');
    }
    else {
      $form['#title'] = $this->t('Edit Ad-Hoc Group');
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
    $form_state->setRedirect('entity.ebms_ad_hoc_group.canonical', ['ebms_ad_hoc_group' => $entity->id()]);
  }

}

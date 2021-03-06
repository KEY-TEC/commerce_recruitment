<?php

namespace Drupal\commerce_recruiting\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for recruitment edit forms.
 *
 * @ingroup commerce_recruiting
 */
class RecruitmentForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    /* @var \Drupal\commerce_recruiting\Entity\Recruitment $entity */
    $form = parent::buildForm($form, $form_state);

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
        $this->messenger()->addMessage($this->t('Created %label.', [
          '%label' => $entity->label(),
        ]));
        break;

      default:
        $this->messenger()->addMessage($this->t('Saved %label.', [
          '%label' => $entity->label(),
        ]));
    }
    $form_state->setRedirect('entity.' . $entity->getEntityTypeId() . '.canonical', [$entity->getEntityTypeId() => $entity->id()]);
  }

}

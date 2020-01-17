<?php

namespace Drupal\line\Form;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class LineMessageApiForm.
 */
class LineMessageApiForm extends EntityForm {

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form = parent::form($form, $form_state);

    $message_api = $this->entity;
    $form['label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Label'),
      '#maxlength' => 255,
      '#default_value' => $message_api->label(),
      '#description' => $this->t("Label for the Line Message API."),
      '#required' => TRUE,
    ];

    $form['id'] = [
      '#type' => 'machine_name',
      '#default_value' => $message_api->id(),
      '#machine_name' => [
        'exists' => '\Drupal\line\Entity\LineMessageApi::load',
      ],
      '#disabled' => !$message_api->isNew(),
    ];

    /* You will need additional form elements for your custom properties. */

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $message_api = $this->entity;
    $status = $message_api->save();

    switch ($status) {
      case SAVED_NEW:
        $this->messenger()->addMessage($this->t('Created the %label Line Message API.', [
          '%label' => $message_api->label(),
        ]));
        break;

      default:
        $this->messenger()->addMessage($this->t('Saved the %label Line Message API.', [
          '%label' => $message_api->label(),
        ]));
    }
    $form_state->setRedirectUrl($message_api->toUrl('collection'));
  }

}

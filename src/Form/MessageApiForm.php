<?php

namespace Drupal\line\Form;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class MessageApiForm.
 */
class MessageApiForm extends EntityForm {

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form = parent::form($form, $form_state);
    /** @var \Drupal\line\Entity\MessageApi $message_api */
    $message_api = $this->entity;
    $form['label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Label'),
      '#maxlength' => 255,
      '#default_value' => $message_api->label(),
      '#description' => $this->t("Label for the LINE Message API."),
      '#required' => TRUE,
    ];

    $form['id'] = [
      '#type' => 'machine_name',
      '#default_value' => $message_api->id(),
      '#machine_name' => [
        'exists' => '\Drupal\line\Entity\MessageApi::load',
      ],
      '#disabled' => !$message_api->isNew(),
    ];

    $form['client_id'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Client ID'),
      '#maxlength' => 255,
      '#default_value' => ($message_api->getClientId()) ? $message_api->getClientId() : '',
      '#description' => $this->t("Client ID for the LINE Message API."),
      '#required' => TRUE,
    ];

    $form['client_secret'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Client Secret'),
      '#maxlength' => 255,
      '#default_value' => ($message_api->getSecret()) ? $message_api->getSecret() : '',
      '#description' => $this->t("Client Secret for the LINE Message API."),
      '#required' => TRUE,
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    /** @var \Drupal\line\Entity\MessageApi $message_api */
    $message_api = $this->entity;
    $message_api->setClientId($form_state->getValue('client_id'));
    $message_api->setSecret($form_state->getValue('client_secret'));
    $status = $message_api->save();

    switch ($status) {
      case SAVED_NEW:
        $this->messenger()->addMessage($this->t('Created the %label LINE Message API.', [
          '%label' => $message_api->label(),
        ]));
        break;

      default:
        $this->messenger()->addMessage($this->t('Saved the %label LINE Message API.', [
          '%label' => $message_api->label(),
        ]));
    }
    $form_state->setRedirectUrl($message_api->toUrl('collection'));
  }

}

<?php

namespace Drupal\line\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Language\LanguageManagerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Logger\LoggerChannelFactoryInterface;

/**
 * Defines a form that configures line settings.
 */
class SettingsForm extends ConfigFormBase {

  /**
   * The language manager.
   *
   * @var \Drupal\Core\Language\LanguageManagerInterface
   */
  protected $languageManager;

  /**
   * The logger channel factory.
   *
   * @var \Drupal\Core\Logger\LoggerChannelFactoryInterface
   */
  protected $loggerFactory;

  /**
   * Constructor.
   *
   * @param \Drupal\Core\Language\LanguageManagerInterface $language_manager
   *   The language manager.
   * @param \Drupal\Core\Logger\LoggerChannelFactoryInterface $logger_factory
   *   The logger factory.
   */
  public function __construct(LanguageManagerInterface $language_manager, LoggerChannelFactoryInterface $logger_factory) {
    $this->languageManager = $language_manager;
    $this->loggerFactory = $logger_factory;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('language_manager'),
      $container->get('logger.factory')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'line_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['line.settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('line.settings');

    $form['bot_on'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Activate LINE Messaging API.'),
      '#default_value' => $config->get('bot_on'),
      '#description' => $this->t('When enabled, LINE Messaging API will be available to use in your modules.'),
    ];

    if (!$config->get('bot_on') && empty($form_state->input)) {
      drupal_set_message($this->t('LINE is currently disabled.'), 'warning');
    }

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $values = $form_state->getValues();

    // Check to see if the module has been activated or inactivated.
    if ($values['bot_on']) {
      if (!line_active()) {
        drupal_set_message($this->t('LINE Messaging API is ready to use in your modules.'));
        $this->loggerFactory->get('line')->notice('LINE has been enabled.');
      }
    }
    elseif (line_active()) {
      // This module is active and is being inactivated.
      drupal_set_message($this->t('LINE has been disabled.'));
      $this->loggerFactory->get('line')->notice('LINE has been disabled.');
    }

    // Save the configuration changes.
    $line_config = $this->config('line.settings');
    $line_config->set('bot_on', $values['bot_on']);

    $line_config->save();

    parent::submitForm($form, $form_state);
  }

}

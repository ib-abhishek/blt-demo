<?php

namespace Drupal\hello_world\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Block\BlockPluginInterface;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a 'Hello' Block.
 *
 * @Block(
 *   id = "hello_block",
 *   admin_label = @Translation("Hello block"),
 *   category = @Translation("Hello World"),
 * )
 */
class HelloBlock extends BlockBase implements BlockPluginInterface {

    /**
     * {@inheritdoc}
     */
    public function build() {
        $config = $this->getConfiguration();
        if (!empty($config['hello_block_name'])) {
            $name = $config['hello_block_name'];
        } else {
            $name = $this->t('to no one');
        }


        return array(
            '#markup' => $this->t('Hello @name!', array(
                '@name' => $name,
            )),
        );
    }

    /**
     * {@inheritdoc}
     */
    public function defaultConfiguration() {
//        ini_set('display_errors', 1);
//        ini_set('display_startup_errors', 1);
//        error_reporting(E_ALL);

        $default_config = \Drupal::config('hello_world.settings');
//        print_r($default_config);
        return [
            'hello_block_name' => $default_config->get('hello.name'),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function blockForm($form, FormStateInterface $form_state) {

        $form = parent::blockForm($form, $form_state);

        $config = $this->getConfiguration();

        $form['hello_block_name'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Who'),
            '#description' => $this->t('Who do you want to say hello to?'),
            '#default_value' => isset($config['hello_block_name']) ? $config['hello_block_name'] : '',
        ];

        return $form;
    }

    /**
     * {@inheritdoc}
     */
    public function blockSubmit($form, FormStateInterface $form_state) {
        parent::blockSubmit($form, $form_state);
        $this->configuration['hello_block_name'] = $form_state->getValue('hello_block_name');
    }

}

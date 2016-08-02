<?php
/**
 * @file
 * Contains Drupal\hits_counter_example\Form\HitsCounterExampleForm.
 */

namespace Drupal\hits_counter_example\Form;


use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\HtmlCommand;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class HitsCounterExampleForm extends FormBase {

    /**
     * {@inheritdoc}.
     */
    public function getFormId() {
        return 'hits_counter_example_form';
    }

    /**
     * {@inheritdoc}.
     */
    public function buildForm(array $form, FormStateInterface $form_state) {

        $config = \Drupal::service('config.factory')->getEditable('default.count');
        $count_num = $config->get('hit_counter');

        if (!$count_num) $count_num=0;

        $form['#cache'] =  array ('max-age' => 0);
        $form['ajax_hit_me'] = array(
            '#type' => 'submit',
            '#value' => $this->t('Hit me'),
            '#ajax' => [
                'callback' => array($this, 'button_hits_ajax_counter'),
                'event' => 'click',
                'progress' => array(
                    'type' => 'throbber',
                ),
            ],
            '#suffix' => '<div class="counter_number">' . $count_num . '</div>'
        );
        return $form;
    }

    /**
     * @param array $form
     * @param FormStateInterface $form_state
     * @return AjaxResponse
     */
    public function button_hits_ajax_counter(array &$form, FormStateInterface $form_state) {
        $config = \Drupal::service('config.factory')->getEditable('default.count');
        $count_num = $config->get('hit_counter');
        $count_num ++;
        $config->set('hit_counter', $count_num)->save();
        $response = new AjaxResponse();
        $response->addCommand(new HtmlCommand('.counter_number', $count_num));
        return $response;
    }

    /**
     * Form submission handler.
     *
     * @param array $form
     *   An associative array containing the structure of the form.
     * @param \Drupal\Core\Form\FormStateInterface $form_state
     *   The current state of the form.
     */
    public function submitForm(array &$form, FormStateInterface $form_state)
    {
        // TODO: Implement submitForm() method.
    }
}
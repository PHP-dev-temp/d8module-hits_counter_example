<?php
/**
 * Provides a 'Prev-Next' Block
 *
 * @Block(
 *   id = "hits_counter_example_block",
 *   admin_label = @Translation("Hits counter example"),
 * )
 */

namespace Drupal\hits_counter_example\Plugin\Block;

use Drupal\Core\Block\BlockBase;

class HitsCounterExampleBlock extends BlockBase {
    /**
     * {@inheritdoc}
     */
    public function build() {
        $builtForm = \Drupal::formBuilder()->getForm('Drupal\hits_counter_example\Form\HitsCounterExampleForm');

        return $builtForm;
    }
}
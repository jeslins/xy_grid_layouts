<?php

namespace Drupal\xy_grid_layouts\Plugin\views\style;

use Drupal\Core\Form\FormStateInterface;
use Drupal\views\Plugin\views\style\StylePluginBase;

/**
 * Style plugin to render each item in a xy grid cell.
 *
 * @see: https://foundation.zurb.com/sites/docs/xy-grid.html#block-grids
 *
 * @ingroup views_style_plugins
 *
 * @ViewsStyle(
 *   id = "block-grid",
 *   title = @Translation("Block Grid"),
 *   help = @Translation("Displays number of cells to per direction."),
 *   theme = "views_view_block_grid",
 *   display_types = {"normal"}
 * )
 */
class BlockGrid extends StylePluginBase {

  /**
   * Does the style plugin for itself support to add fields to its output.
   *
   * @var bool
   */
  protected $usesFields = TRUE;

  /**
   * {@inheritdoc}
   */
  protected $usesRowPlugin = TRUE;

  /**
   * {@inheritdoc}
   */
  protected function defineOptions() {
    $options = parent::defineOptions();
    $options['columns'] = ['default' => []];
    $options['columns']['small_up'] = ['default' => '1'];
    $options['columns']['medium_up'] = ['default' => '1'];
    $options['columns']['large_up'] = ['default' => '1'];
    $options['columns']['xlarge_up'] = ['default' => ''];
    $options['columns']['xxlarge_up'] = ['default' => ''];

    $options['grid_class_default'] = ['default' => ''];
    $options['cell_class_default'] = ['default' => ''];

    return $options;
  }

  /**
   * {@inheritdoc}
   */
  public function buildOptionsForm(&$form, FormStateInterface $form_state) {
    parent::buildOptionsForm($form, $form_state);

    $form['grid_class_default'] = [
      '#title' => $this->t('Append class to grid.'),
      '#type' => 'textfield',
      '#default_value' => $this->options['grid_class_default'],
    ];

    $form['cell_class_default'] = [
      '#title' => $this->t('Append class to cells.'),
      '#type' => 'textfield',
      '#default_value' => $this->options['cell_class_default'],
    ];

    $options = array_reduce(range(1, 12), function($carry , $item) {
      $carry[$item] = $item;

      return $carry;
    }, ['' => $this->t('None')]);

    $form['columns']['small_up'] = [
      '#type' => 'select',
      '#default_value' => $this->options['columns']['small_up'],
      '#options' => $options,
    ];

    $form['columns']['medium_up'] = [
      '#type' => 'select',
      '#default_value' => $this->options['columns']['medium_up'],
      '#options' => $options,
      '#required' => TRUE,
    ];

    $form['columns']['large_up'] = [
      '#type' => 'select',
      '#default_value' => $this->options['columns']['large_up'],
      '#options' => $options,
      '#required' => TRUE,
    ];

    $form['columns']['xlarge_up'] = [
      '#type' => 'select',
      '#default_value' => $this->options['columns']['xlarge_up'],
      '#options' => $options,
    ];

    $form['columns']['xxlarge_up'] = [
      '#type' => 'select',
      '#default_value' => $this->options['columns']['xxlarge_up'],
      '#options' => $options,
    ];

    $form['#theme'] = 'views_ui_style_plugin_column_table';
  }
}

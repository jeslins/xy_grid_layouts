<?php

use Drupal\Core\Render\Element;

/**
 * Prepares variables for style plugin table templates.
 *
 * Default template: views-ui-style-plugin-column-table.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - form: A render element representing the form.
 */
function template_preprocess_views_ui_style_plugin_column_table(&$variables) {
  $form = $variables['form'];

  $header = [
    t('Breakpoints'),
    t('small up'),
    t('medium up*'),
    t('large up*'),
    t('xlarge up'),
    t('xxlarge up'),
  ];

  $row = [];
  $row[]['data'] = t('Number of columns');
  foreach (Element::children($form['columns']) as $id) {
    $row[]['data'] = $form['columns'][$id];
  }

  $rows = [];
  $rows[] = $row;

  // Unset elements from the form array that are used to build the table so that
  // they are not rendered twice.
  unset($form['columns']);

  $variables['table'] = [
    '#type' => 'table',
    '#theme' => 'table__views_ui_style_plugin_column_table',
    '#header' => $header,
    '#rows' => $rows,
  ];
  $variables['form'] = $form;
}

<?php

namespace Drupal\html5_audio\Plugin\Field\FieldFormatter;

use Drupal\Component\Utility\Html;
use Drupal\Core\Field\FieldItemInterface;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Plugin implementation of the 'html5audio_field_formatter' formatter.
 *
 * @FieldFormatter(
 *   id = "html5audio_field_formatter",
 *   label = @Translation("HTML5 Audio"),
 *   field_types = {
 *     "link"
 *   }
 * )
 */
class Html5AudioFieldFormatter extends FormatterBase {

  /**
   * {@inheritdoc}
   */
  public static function defaultSettings() {
    return [
      // Implement default settings.
    ] + parent::defaultSettings();
  }

  /**
   * {@inheritdoc}
   */
  public function settingsForm(array $form, FormStateInterface $form_state) {
    return [
      // Implement settings form.
    ] + parent::settingsForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function settingsSummary() {
    $summary = [];
    // Implement settings summary.

    return $summary;
  }

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $elements = [];

    // Render all fields values as part of a single <audio> tag.

    $sources = array(); 

    //think of delta as the counter

    foreach ($items as $delta => $item) {
     
      //Get the mimetype of the URL.
      //$item->url
      $mimetype = \Drupal::service('file.mime_type.guesser')->guess($item->uri);
      $sources[] = array(
        'src' => $item->uri,
        'mimetype' => $mimetype, 

        );

    }


    //Render Array

    //Put everything into the elements array for themeing. 

    $elements[] = array(
      //which template file to use
      '#theme' => 'audio_tag',
      '#sources' => $sources,

      );

    return $elements;
  }

 

}
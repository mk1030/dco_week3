<?php

namespace Drupal\user_blocker\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class BlockerForm.
 */
class BlockerForm extends FormBase {


  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'user_blocker_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['username'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Username'),
      '#description' => $this->t('Enter the username of the user you would like to block.'),
      '#maxlength' => 64,
      '#size' => 64,
      '#required' => TRUE,
    ];
    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);

  $username = $form_state->getValue('username');
  
  $user = user_load_by_name($username);
  


  // Ensure the user exists

  if (empty($user)) {
    $form_state->setError(
      $form['username'],
      $this->t('User %username was not found', ['%username' => $username])

      );

  }

else {
 // Don't block yourself

  $current_user = \Drupal::currentUser();
  if ($user ->id() == $current_user->id())
    $form_state->setError(
      $form['username'],
      $this->t('You may not block yourself')

      );

}

 


  // Don't block anyone with the Admin Role

  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Display result.
    foreach ($form_state->getValues() as $key => $value) {
      drupal_set_message($key . ': ' . $value);
    }

//get the user object for the given username
$username = $form_state->getValue('username');





$user = user_load_by_name($username);

$user->block();


//save the user;
$user->save(); 


//report back to the user
drupal_set_message($this->t('user %username has been blocked.', ['%username' => $username]));

}





















//formstate in submit functions, provides all values
//run something that takes $username and blocks it. 



}

<?php

/**
 * sfSimpleForumForum form base class.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 */
class BasesfSimpleForumForumForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'name'           => new sfWidgetFormInput(),
      'description'    => new sfWidgetFormTextarea(),
      'rank'           => new sfWidgetFormInput(),
      'category_id'    => new sfWidgetFormPropelChoice(array('model' => 'sfSimpleForumCategory', 'add_empty' => true)),
      'created_at'     => new sfWidgetFormDateTime(),
      'updated_at'     => new sfWidgetFormDateTime(),
      'stripped_name'  => new sfWidgetFormInput(),
      'latest_post_id' => new sfWidgetFormPropelChoice(array('model' => 'sfSimpleForumPost', 'add_empty' => true)),
      'nb_posts'       => new sfWidgetFormInput(),
      'nb_topics'      => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorPropelChoice(array('model' => 'sfSimpleForumForum', 'column' => 'id', 'required' => false)),
      'name'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'description'    => new sfValidatorString(array('required' => false)),
      'rank'           => new sfValidatorInteger(array('required' => false)),
      'category_id'    => new sfValidatorPropelChoice(array('model' => 'sfSimpleForumCategory', 'column' => 'id', 'required' => false)),
      'created_at'     => new sfValidatorDateTime(array('required' => false)),
      'updated_at'     => new sfValidatorDateTime(array('required' => false)),
      'stripped_name'  => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'latest_post_id' => new sfValidatorPropelChoice(array('model' => 'sfSimpleForumPost', 'column' => 'id', 'required' => false)),
      'nb_posts'       => new sfValidatorInteger(array('required' => false)),
      'nb_topics'      => new sfValidatorInteger(array('required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'sfSimpleForumForum', 'column' => array('stripped_name')))
    );

    $this->widgetSchema->setNameFormat('sf_simple_forum_forum[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'sfSimpleForumForum';
  }


}

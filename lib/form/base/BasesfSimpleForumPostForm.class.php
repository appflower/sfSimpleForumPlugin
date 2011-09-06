<?php

/**
 * sfSimpleForumPost form base class.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 */
class BasesfSimpleForumPostForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'title'       => new sfWidgetFormInput(),
      'content'     => new sfWidgetFormTextarea(),
      'topic_id'    => new sfWidgetFormPropelChoice(array('model' => 'sfSimpleForumTopic', 'add_empty' => true)),
      'user_id'     => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => true)),
      'created_at'  => new sfWidgetFormDateTime(),
      'forum_id'    => new sfWidgetFormPropelChoice(array('model' => 'sfSimpleForumForum', 'add_empty' => true)),
      'author_name' => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorPropelChoice(array('model' => 'sfSimpleForumPost', 'column' => 'id', 'required' => false)),
      'title'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'content'     => new sfValidatorString(array('required' => false)),
      'topic_id'    => new sfValidatorPropelChoice(array('model' => 'sfSimpleForumTopic', 'column' => 'id', 'required' => false)),
      'user_id'     => new sfValidatorPropelChoice(array('model' => 'sfGuardUser', 'column' => 'id', 'required' => false)),
      'created_at'  => new sfValidatorDateTime(array('required' => false)),
      'forum_id'    => new sfValidatorPropelChoice(array('model' => 'sfSimpleForumForum', 'column' => 'id', 'required' => false)),
      'author_name' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('sf_simple_forum_post[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'sfSimpleForumPost';
  }


}

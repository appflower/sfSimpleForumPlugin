<?php

/**
 * sfSimpleForumTopic form base class.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 */
class BasesfSimpleForumTopicForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                              => new sfWidgetFormInputHidden(),
      'title'                           => new sfWidgetFormInput(),
      'is_sticked'                      => new sfWidgetFormInputCheckbox(),
      'is_locked'                       => new sfWidgetFormInputCheckbox(),
      'forum_id'                        => new sfWidgetFormPropelChoice(array('model' => 'sfSimpleForumForum', 'add_empty' => true)),
      'created_at'                      => new sfWidgetFormDateTime(),
      'updated_at'                      => new sfWidgetFormDateTime(),
      'latest_post_id'                  => new sfWidgetFormPropelChoice(array('model' => 'sfSimpleForumPost', 'add_empty' => true)),
      'user_id'                         => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => true)),
      'stripped_title'                  => new sfWidgetFormInput(),
      'nb_posts'                        => new sfWidgetFormInput(),
      'nb_views'                        => new sfWidgetFormInput(),
      'sf_simple_forum_topic_view_list' => new sfWidgetFormPropelChoiceMany(array('model' => 'sfGuardUser')),
    ));

    $this->setValidators(array(
      'id'                              => new sfValidatorPropelChoice(array('model' => 'sfSimpleForumTopic', 'column' => 'id', 'required' => false)),
      'title'                           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'is_sticked'                      => new sfValidatorBoolean(array('required' => false)),
      'is_locked'                       => new sfValidatorBoolean(array('required' => false)),
      'forum_id'                        => new sfValidatorPropelChoice(array('model' => 'sfSimpleForumForum', 'column' => 'id', 'required' => false)),
      'created_at'                      => new sfValidatorDateTime(array('required' => false)),
      'updated_at'                      => new sfValidatorDateTime(array('required' => false)),
      'latest_post_id'                  => new sfValidatorPropelChoice(array('model' => 'sfSimpleForumPost', 'column' => 'id', 'required' => false)),
      'user_id'                         => new sfValidatorPropelChoice(array('model' => 'sfGuardUser', 'column' => 'id', 'required' => false)),
      'stripped_title'                  => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'nb_posts'                        => new sfValidatorInteger(array('required' => false)),
      'nb_views'                        => new sfValidatorInteger(array('required' => false)),
      'sf_simple_forum_topic_view_list' => new sfValidatorPropelChoiceMany(array('model' => 'sfGuardUser', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('sf_simple_forum_topic[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'sfSimpleForumTopic';
  }


  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['sf_simple_forum_topic_view_list']))
    {
      $values = array();
      foreach ($this->object->getsfSimpleForumTopicViews() as $obj)
      {
        $values[] = $obj->getUserId();
      }

      $this->setDefault('sf_simple_forum_topic_view_list', $values);
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->savesfSimpleForumTopicViewList($con);
  }

  public function savesfSimpleForumTopicViewList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['sf_simple_forum_topic_view_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (is_null($con))
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(sfSimpleForumTopicViewPeer::TOPIC_ID, $this->object->getPrimaryKey());
    sfSimpleForumTopicViewPeer::doDelete($c, $con);

    $values = $this->getValue('sf_simple_forum_topic_view_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new sfSimpleForumTopicView();
        $obj->setTopicId($this->object->getPrimaryKey());
        $obj->setUserId($value);
        $obj->save();
      }
    }
  }

}

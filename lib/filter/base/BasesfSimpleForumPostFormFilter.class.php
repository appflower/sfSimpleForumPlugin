<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * sfSimpleForumPost filter form base class.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage filter
 * @author     ##AUTHOR_NAME##
 */
class BasesfSimpleForumPostFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'title'       => new sfWidgetFormFilterInput(),
      'content'     => new sfWidgetFormFilterInput(),
      'topic_id'    => new sfWidgetFormPropelChoice(array('model' => 'sfSimpleForumTopic', 'add_empty' => true)),
      'user_id'     => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => true)),
      'created_at'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'forum_id'    => new sfWidgetFormPropelChoice(array('model' => 'sfSimpleForumForum', 'add_empty' => true)),
      'author_name' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'title'       => new sfValidatorPass(array('required' => false)),
      'content'     => new sfValidatorPass(array('required' => false)),
      'topic_id'    => new sfValidatorPropelChoice(array('required' => false, 'model' => 'sfSimpleForumTopic', 'column' => 'id')),
      'user_id'     => new sfValidatorPropelChoice(array('required' => false, 'model' => 'sfGuardUser', 'column' => 'id')),
      'created_at'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'forum_id'    => new sfValidatorPropelChoice(array('required' => false, 'model' => 'sfSimpleForumForum', 'column' => 'id')),
      'author_name' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('sf_simple_forum_post_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'sfSimpleForumPost';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'title'       => 'Text',
      'content'     => 'Text',
      'topic_id'    => 'ForeignKey',
      'user_id'     => 'ForeignKey',
      'created_at'  => 'Date',
      'forum_id'    => 'ForeignKey',
      'author_name' => 'Text',
    );
  }
}

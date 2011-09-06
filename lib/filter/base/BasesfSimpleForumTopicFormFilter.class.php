<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * sfSimpleForumTopic filter form base class.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage filter
 * @author     ##AUTHOR_NAME##
 */
class BasesfSimpleForumTopicFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'title'                           => new sfWidgetFormFilterInput(),
      'is_sticked'                      => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'is_locked'                       => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'forum_id'                        => new sfWidgetFormPropelChoice(array('model' => 'sfSimpleForumForum', 'add_empty' => true)),
      'created_at'                      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'updated_at'                      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'latest_post_id'                  => new sfWidgetFormPropelChoice(array('model' => 'sfSimpleForumPost', 'add_empty' => true)),
      'user_id'                         => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => true)),
      'stripped_title'                  => new sfWidgetFormFilterInput(),
      'nb_posts'                        => new sfWidgetFormFilterInput(),
      'nb_views'                        => new sfWidgetFormFilterInput(),
      'sf_simple_forum_topic_view_list' => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'title'                           => new sfValidatorPass(array('required' => false)),
      'is_sticked'                      => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'is_locked'                       => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'forum_id'                        => new sfValidatorPropelChoice(array('required' => false, 'model' => 'sfSimpleForumForum', 'column' => 'id')),
      'created_at'                      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'                      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'latest_post_id'                  => new sfValidatorPropelChoice(array('required' => false, 'model' => 'sfSimpleForumPost', 'column' => 'id')),
      'user_id'                         => new sfValidatorPropelChoice(array('required' => false, 'model' => 'sfGuardUser', 'column' => 'id')),
      'stripped_title'                  => new sfValidatorPass(array('required' => false)),
      'nb_posts'                        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'nb_views'                        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'sf_simple_forum_topic_view_list' => new sfValidatorPropelChoice(array('model' => 'sfGuardUser', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('sf_simple_forum_topic_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function addsfSimpleForumTopicViewListColumnCriteria(Criteria $criteria, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $criteria->addJoin(sfSimpleForumTopicViewPeer::TOPIC_ID, sfSimpleForumTopicPeer::ID);

    $value = array_pop($values);
    $criterion = $criteria->getNewCriterion(sfSimpleForumTopicViewPeer::USER_ID, $value);

    foreach ($values as $value)
    {
      $criterion->addOr($criteria->getNewCriterion(sfSimpleForumTopicViewPeer::USER_ID, $value));
    }

    $criteria->add($criterion);
  }

  public function getModelName()
  {
    return 'sfSimpleForumTopic';
  }

  public function getFields()
  {
    return array(
      'id'                              => 'Number',
      'title'                           => 'Text',
      'is_sticked'                      => 'Boolean',
      'is_locked'                       => 'Boolean',
      'forum_id'                        => 'ForeignKey',
      'created_at'                      => 'Date',
      'updated_at'                      => 'Date',
      'latest_post_id'                  => 'ForeignKey',
      'user_id'                         => 'ForeignKey',
      'stripped_title'                  => 'Text',
      'nb_posts'                        => 'Number',
      'nb_views'                        => 'Number',
      'sf_simple_forum_topic_view_list' => 'ManyKey',
    );
  }
}

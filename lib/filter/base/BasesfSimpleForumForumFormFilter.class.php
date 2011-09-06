<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * sfSimpleForumForum filter form base class.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage filter
 * @author     ##AUTHOR_NAME##
 */
class BasesfSimpleForumForumFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'           => new sfWidgetFormFilterInput(),
      'description'    => new sfWidgetFormFilterInput(),
      'rank'           => new sfWidgetFormFilterInput(),
      'category_id'    => new sfWidgetFormPropelChoice(array('model' => 'sfSimpleForumCategory', 'add_empty' => true)),
      'created_at'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'updated_at'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'stripped_name'  => new sfWidgetFormFilterInput(),
      'latest_post_id' => new sfWidgetFormPropelChoice(array('model' => 'sfSimpleForumPost', 'add_empty' => true)),
      'nb_posts'       => new sfWidgetFormFilterInput(),
      'nb_topics'      => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'name'           => new sfValidatorPass(array('required' => false)),
      'description'    => new sfValidatorPass(array('required' => false)),
      'rank'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'category_id'    => new sfValidatorPropelChoice(array('required' => false, 'model' => 'sfSimpleForumCategory', 'column' => 'id')),
      'created_at'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'stripped_name'  => new sfValidatorPass(array('required' => false)),
      'latest_post_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'sfSimpleForumPost', 'column' => 'id')),
      'nb_posts'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'nb_topics'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('sf_simple_forum_forum_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'sfSimpleForumForum';
  }

  public function getFields()
  {
    return array(
      'id'             => 'Number',
      'name'           => 'Text',
      'description'    => 'Text',
      'rank'           => 'Number',
      'category_id'    => 'ForeignKey',
      'created_at'     => 'Date',
      'updated_at'     => 'Date',
      'stripped_name'  => 'Text',
      'latest_post_id' => 'ForeignKey',
      'nb_posts'       => 'Number',
      'nb_topics'      => 'Number',
    );
  }
}

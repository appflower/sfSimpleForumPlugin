<?php use_helper('I18N', 'Validation', 'sfSimpleForum') ?>

<?php if (sfConfig::get('app_sfSimpleForum_include_breadcrumb', true)): ?>
<?php slot('forum_navigation') ?>
<?php if ($forum): ?>
  <?php echo forum_breadcrumb(array(
    array(__(sfConfig::get('app_sfSimpleForumPlugin_forum_name', 'Forums'), null, 'sfSimpleForum'), 'sfSimpleForum/forumList'),
    array($forum->getName(), 'sfSimpleForum/forum?forum_name='.$forum->getStrippedName()),
    __('New topic', null, 'sfSimpleForum')
  )) ?>
<?php else: ?>
  <?php echo forum_breadcrumb(array(
    array(__(sfConfig::get('app_sfSimpleForumPlugin_forum_name', 'Forums')), 'sfSimpleForum/forumList'),
    __('New topic', null, 'sfSimpleForum')
  )) ?>
<?php endif; ?>
<?php end_slot() ?>
<?php endif; ?>

<div class="sfSimpleForum">

  <h1><?php echo __('Create a new topic', null, 'sfSimpleForum') ?></h1>

  <div class="breadcrumb_center">
      <?php include_slot('forum_navigation') ?>
  </div>

  <div style="clear:both"></div>

  <div class="sf_apply">
  <?php
    include_partial('sfSimpleForum/add_post_form', array(
            'forum'             => $forum,
            'author_name_error' => $author_name_error,
            'captcha_error'     => $captcha_error
        )
    );
  ?>
  </div>

</div>
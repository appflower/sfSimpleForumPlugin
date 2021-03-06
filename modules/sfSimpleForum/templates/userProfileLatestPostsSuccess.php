<?php use_helper('I18N', 'Pagination', 'sfSimpleForum') ?>
<?php $title = __('Messages by %user%', array('%user%' => get_partial('sfSimpleForum/author_name', array('author' => $user->getFullName(), 'sf_cache_key' => $username))), 'sfSimpleForum') ?>

<?php if (sfConfig::get('app_sfSimpleForum_include_breadcrumb', true)): ?>
<?php slot('forum_navigation') ?>
  <?php echo forum_breadcrumb(array(
    array(sfConfig::get('app_sfSimpleForumPlugin_forum_name', 'Forums'), 'sfSimpleForum/forumList'),
    $title
  )) ?>  
<?php end_slot() ?>
<?php endif; ?>

<div class="sfSimpleForum">
  
  <h1><?php echo $title ?></h1>

  <div class="breadcrumb_center">
      <?php include_slot('forum_navigation') ?>
  </div>

  <div class="forum_figures_center">
  <?php include_partial('sfSimpleForum/figures', array(
    'display_topic_link'  => true,
    'nb_topics'           => sfSimpleForumTopicPeer::countForUser($user->getUserId()),
    'topic_rule'          => 'sfSimpleForum/userLatestTopics?user_id='.$user->getUserId(),
    'display_post_link'   => false,
    'nb_posts'            => $post_pager->getNbResults(),
    'post_rule'           => '',
    'feed_rule'           => 'sfSimpleForum/userLatestPostsFeed?user_id='.$user->getUserId(),
    'feed_title'          => $feed_title
  )) ?>
  </div>
  
  <?php include_partial('sfSimpleForum/post_list', array('posts' => $post_pager->getResults(), 'include_topic' => true)) ?>
  
  <?php echo pager_navigation($post_pager, 'sfSimpleForum/userLatestPosts?user_id='.$user->getUserId()) ?>

</div>
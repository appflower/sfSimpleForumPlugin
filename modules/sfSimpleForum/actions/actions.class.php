<?php

/**
 *
 * @package    symfony
 * @subpackage plugin
 * @author     Nick Winfield <enquiries@superhaggis.com>              
 * @version    SVN: $Id$
 */

// autoloading for plugin lib actions is broken as at symfony-1.0.2
require_once(sfConfig::get('sf_plugins_dir'). '/sfSimpleForumPlugin/modules/sfSimpleForum/lib/BasesfSimpleForumActions.class.php');

class sfSimpleForumActions extends BasesfSimpleForumActions
{
  public function executeCreateTopic()
  {
    $this->author_name_error = $this->getRequestParameter('author_name_error', '');
    $this->captcha_error = $this->getRequestParameter('captcha_error', '');

    $this->forum = sfSimpleForumForumPeer::retrieveByStrippedName($this->getRequestParameter('forum_name'));
    if(!sfConfig::get('app_sfSimpleForumPlugin_allow_new_topic_outside_forum', true))
    {
      $this->forward404Unless($this->forum);
    }
  }

  public function executeAddTopic()
  {
    $this->handleAdditionalErrorAddTopic();

    $forum = sfSimpleForumForumPeer::retrieveByStrippedName($this->getRequestParameter('forum_name'));
    $this->forward404Unless($forum);

    $topic = new sfSimpleForumTopic();
    $topic->setsfSimpleForumForum($forum);
    $topic->setTitle($this->getRequestParameter('title'));
    $topic->setUserId(sfSimpleForumTools::getConnectedUserId());
    if ($this->getUser()->hasCredential('moderator'))
    {
      $topic->setIsSticked($this->getRequestParameter('is_sticked', 0));
      $topic->setIsLocked($this->getRequestParameter('is_locked', 0));
    }
    $topic->save();

    $post = new sfSimpleForumPost();
    $post->setContent($this->getRequestParameter('body'));
    $post->setUserId(sfSimpleForumTools::getConnectedUserId());
    $post->setsfSimpleForumTopic($topic);
    if(!sfContext::getInstance()->getUser()->isAuthenticated()) {
        $post->setAuthorName($this->getRequestParameter('author_name'));
        $post->setAuthorEmail(trim($this->getRequestParameter('author_email')));
    }
    $post->save();

    $this->saveFile('file', $post);
    
    // send email notifications 
    $post->sendEmailNotifications();
    
    $this->redirectToPost($post);
  }

  public function executeTopic()
  {
    $this->author_name_error = $this->getRequestParameter('author_name_error', '');
    $this->captcha_error = $this->getRequestParameter('captcha_error', '');

    $this->setTopicVars();
    $this->post_pager = $this->topic->getPostsPager(
      $this->getRequestParameter('page', 1),
      sfConfig::get('app_sfSimpleForumPlugin_max_per_page', 10)
    );
    $this->forward404Unless($this->post_pager);

    if (sfConfig::get('app_sfSimpleForumPlugin_count_views', true))
    {
      // lame protection against simple page refreshing
      if($this->getUser()->getAttribute('sf_simple_forum_latest_viewed_topic') != $this->topic->getId())
      {
        $this->topic->incrementViews();
        $this->getUser()->setAttribute('sf_simple_forum_latest_viewed_topic', $this->topic->getId());
      }
      if($this->getUser()->isAuthenticated())
      {
        $this->topic->addViewForUser(sfSimpleForumTools::getConnectedUserId());
      }
    }
  }


  public function executeAddPost()
  {
      //first is validated body from addPost.yml. We should get rid of validation yml files
      $this->handleAdditionalErrorAddPost();

    $topic = sfSimpleForumTopicPeer::retrieveByPK($this->getRequestParameter('topic_id'));
    $this->forward404Unless($topic);
    // We must check if the topic isn't locked
    $this->forward404If($topic->getIsLocked());

    $post = new sfSimpleForumPost();
    $post->setContent(strip_tags($this->getRequestParameter('body')));
    $post->setUserId(sfSimpleForumTools::getConnectedUserId());
    if(!sfContext::getInstance()->getUser()->isAuthenticated()) {
        $post->setAuthorName(trim($this->getRequestParameter('author_name')));
        $post->setAuthorEmail(trim($this->getRequestParameter('author_email')));
    }
    $post->setTopicId($topic->getId());
    $post->save();

    $this->saveFile('file', $post);
    
    // send email notifications 
    $post->sendEmailNotifications();

    $this->redirectToPost($post);
  }

  public function handleAdditionalErrorAddTopic()
  {
    if(!$this->getUser()->isAuthenticated()) {
        $error = $this->handleAdditionalErrorAddTopicOrPost();

        if($error) {
            $this->getRequest()->setAttribute('topic', sfSimpleForumPostPeer::retrieveByPk($this->getRequestParameter('topic_id')));
            $this->forward('sfSimpleForum', 'createTopic');
        }
    }
  }

  public function handleAdditionalErrorAddPost()
  {
      if(!$this->getUser()->isAuthenticated()) {
          $error = $this->handleAdditionalErrorAddTopicOrPost();

          if($error) {
              $this->getRequest()->setParameter('id', $this->getRequestParameter('topic_id'));
              $this->forward('sfSimpleForum', 'topic');
          }
      }
  }

  private function handleAdditionalErrorAddTopicOrPost()
  {
      $error = false;
      
      if( trim($this->getRequestParameter('author_name')) == '' ) {
          $this->getRequest()->setParameter('author_name_error', 'error');
          $error = true;
      }
      if( trim($this->getRequestParameter('captcha')) == '' )
      {
          $this->getRequest()->setParameter('captcha_error', 'Please enter the numbers in the captcha image');
          $error = true;
      }
      else if( !$this->validateCaptcha($this->getRequestParameter('captcha')) )
      {
          $this->getRequest()->setParameter('captcha_error', 'Incorrect code');
          $error = true;
      }
      
      $author_email = $this->getRequestParameter("author_email"); 
      if (!empty($author_email))
      {
		  $myValidator = new sfEmailValidator($this->getContext());
	      $errorMsg = "error";
	      if (!$myValidator->execute($author_email, $errorMsg)) 
	      {
	      	 $this->getRequest()->setError('author_email', 'Invalid email address.');
	      	 $error = true;
	      }
      }

      return $error;
  }

  private function validateCaptcha($value) {
    $g = new Captcha(sfContext::getInstance()->getUser()->getAttribute('captcha'));
    if ($g->verify($value))
      return true;
    else
      return false;
  }

  private function saveFile($requestFile, $post)
  {
    $fileName = $this->getRequest()->getFileName('file');
    if($fileName != '')
    {
    //    $fileExtension = $this->getRequest()->getFileExtension('file');

        $postDir = $post->getId();
        $uploadDir = sfConfig::get('sf_upload_dir').'/forum/'.$postDir;

        if(!file_exists($uploadDir)) {
            mkdir($uploadDir);
        }

        $this->getRequest()->moveFile('file', $uploadDir.'/'.$fileName);
    }
  }

  public function executeUserProfileLatestPosts()
  {
    $this->user_id = $this->getRequestParameter('user_id');
    $this->user = sfSimpleForumTools::getUserProfileByUserId($this->user_id);
    $this->forward404Unless($this->user);
    $this->username = $this->user->getFullName();

    $this->post_pager = sfSimpleForumPostPeer::getForUserPager(
      $this->user_id,
      $this->getRequestParameter('page', 1),
      sfConfig::get('app_sfSimpleForumPlugin_max_per_page', 10)
    );
    $this->feed_title = $this->getUserLatestPostsFeedTitle();
  }

  public function executeUserLatestPosts()
  {
    $this->user_id = $this->getRequestParameter('user_id');
    $this->user = sfSimpleForumTools::getUserProfileByUserId($this->user_id);
    $this->forward404Unless($this->user);
    $this->username = $this->user->getFullName();

    $this->post_pager = sfSimpleForumPostPeer::getForUserPager(
      $this->user_id,
      $this->getRequestParameter('page', 1),
      sfConfig::get('app_sfSimpleForumPlugin_max_per_page', 10)
    );
    $this->feed_title = $this->getUserLatestPostsFeedTitle();
  }

  public function executeUserLatestPostsFeed()
  {
    $this->user_id = $this->getRequestParameter('user_id');
    $this->user = sfSimpleForumTools::getUserProfileByUserId($this->user_id);
    $this->forward404Unless($this->user);
    $this->username = $this->user->getFullName();

    $this->posts = sfSimpleForumPostPeer::getForUser(
      $this->user_id,
      sfConfig::get('app_sfSimpleForumPlugin_feed_max', 10)
    );

    $this->rule = $this->getModuleName().'/userLatestPosts?user_id='.$this->user_id;
    $this->feed_title = $this->getUserLatestPostsFeedTitle();

    return $this->renderText($this->getFeedFromObjects($this->posts));
  }

  public function executeUserLatestTopics()
  {
    $this->user_id = $this->getRequestParameter('user_id');
    $this->user = sfSimpleForumTools::getUserProfileByUserId($this->user_id);
    $this->forward404Unless($this->user);
    $this->username = $this->user->getFullName();

    $this->topics_pager = sfSimpleForumTopicPeer::getForUserPager(
      $this->user_id,
      $this->getRequestParameter('page', 1),
      sfConfig::get('app_sfSimpleForumPlugin_max_per_page', 10)
    );

    $this->feed_title = $this->getUserLatestTopicsFeedTitle();
  }

  public function executeUserLatestTopicsFeed()
  {
    $this->user_id = $this->getRequestParameter('user_id');
    $this->user = sfSimpleForumTools::getUserProfileByUserId($this->user_id);
    $this->forward404Unless($this->user);
    $this->username = $this->user->getFullName();

    $this->topics = sfSimpleForumTopicPeer::getForUser(
      $this->user_id,
      sfConfig::get('app_sfSimpleForumPlugin_feed_max', 10)
    );
    $this->rule = $this->getModuleName().'/latestUserTopics?user_id='.$this->user_id;
    $this->feed_title = $this->getUserLatestTopicsFeedTitle();

    return $this->renderText($this->getFeedFromObjects($this->topics));
  }

  protected function getUserLatestPostsFeedTitle()
  {
    sfLoader::loadHelpers('I18N');
    return __('Latest messages from %forums% by %username%', array(
      '%forums%'   => sfConfig::get('app_sfSimpleForumPlugin_forum_name', 'Forums'),
      '%username%' => $this->user->getFullName(),
    ));
  }

  protected function getUserLatestTopicsFeedTitle()
  {
    sfLoader::loadHelpers('I18N');
    return __('Latest topics from %forums% by %username%', array(
      '%forums%'   => sfConfig::get('app_sfSimpleForumPlugin_forum_name', 'Forums'),
      '%username%' => $this->user->getFullName(),
    ));
  }
}

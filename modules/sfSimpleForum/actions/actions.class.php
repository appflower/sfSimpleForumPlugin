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
  public function executeAddTopic()
  {
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
    }
    $post->save();

    $this->saveFile('file', $post);

    $this->redirectToPost($post);
  }

  public function executeAddPost()
  {
    $topic = sfSimpleForumTopicPeer::retrieveByPK($this->getRequestParameter('topic_id'));
    $this->forward404Unless($topic);
    // We must check if the topic isn't locked
    $this->forward404If($topic->getIsLocked());

    $post = new sfSimpleForumPost();
    $post->setContent($this->getRequestParameter('body'));
    $post->setUserId(sfSimpleForumTools::getConnectedUserId());
    if(!sfContext::getInstance()->getUser()->isAuthenticated()) {
        $post->setAuthorName($this->getRequestParameter('author_name'));
    }
    $post->setTopicId($topic->getId());
    $post->save();

    $this->saveFile('file', $post);

    $this->redirectToPost($post);
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
}

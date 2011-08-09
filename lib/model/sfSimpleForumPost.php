<?php

/**
 * Subclass for representing a row from the 'sf_simple_forum_post' table.
 *
 * 
 *
 * @package plugins.sfSimpleForumPlugin.lib.model
 */ 
class sfSimpleForumPost extends PluginsfSimpleForumPost
{
    public function delete(PropelPDO $con = null, $preserveTopic = true)
    {
        $postDir = $this->getId();
        $uploadDir = sfConfig::get('sf_upload_dir').'/forum/'.$postDir;

        if(file_exists($uploadDir)) {
            sfSimpleForumTools::unlinkRecursive($uploadDir);
        }

        parent::delete($con, $preserveTopic);
    }
    
    public function sendEmailNotifications() 
    {
    	$user_emails = array();
    	$user_emails[] = sfConfig::get('app_appflower_forum_notification_email');
    	
    	$c = new Criteria();
    	$c->add(sfSimpleForumPostPeer::TOPIC_ID, $this->getTopicId());
    	$posts = sfSimpleForumPostPeer::doSelect($c);
    	
    	foreach ($posts as $post) 
    	{
    		if ($post->getUserId())
    		{
    			$user_emails[] = $post->getUser()->getUsername();
    		} else if ($post->getAuthorEmail()!='') {
    			$user_emails[] = $post->getAuthorEmail();
    		}
    	}
    	
    	$user_emails = array_unique($user_emails);
    	
    	$configuration = sfProjectConfiguration::getActive();
    	$configuration->loadHelpers('Partial'); 
    	foreach ($user_emails as $email)
    	{
            if ($email) {
            	$rand = md5(time());
            	
                $parameters = array(
                    'email'   => $email,
                    'subject' => 'Forum notification',
                    'from'    => 'Appflower Team',
                    'post'    => $this,
                    'rand'    => $rand
                );

                afAutomailer::saveMail('mail', 'forumNotification', $parameters);
            }
    	}
    	
    }
}
